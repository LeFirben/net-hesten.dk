<?php

class horse_trader
{

	public static function generate_count_cache($attr = [])
	{
		global $basepath;
		global $link_new;
		global $cached_races;
		global $ht_race_counts;

		foreach ($cached_races as $key => $row) {
			$race_names[$row['name']] = ['name' => $row['name'], 'id' => $row['id']];
		}

		ksort($race_names, SORT_ASC);

		$file_content = '<?php' . PHP_EOL;
		$file_content .= '/* This file is auto generated by "/app_core/object_handlers/horse_trader.php" */' . PHP_EOL;
		$file_content .= '$ht_race_counts = [];' . PHP_EOL;
		foreach ($race_names as $race) {

			$amount = $link_new->query("SELECT count(`id`) AS `amount` 
									FROM `{$GLOBALS['DB_NAME_OLD']}`.`Heste` WHERE `bruger` = 'hestehandleren' AND `status` <> 'død' AND `alder` < 18  AND `race` = '{$race['name']}'")->fetch_object()->amount;
			$file_content .= '$ht_race_counts["' . $race['id'] . '"] = ["name" => "' . $race['name'] . '","amount" => ' . $amount . '];' . PHP_EOL;
			$ht_race_counts[$race['id']] = ["name" => "{$race['name']}", "amount" => $amount];
		}
		file_put_contents("{$basepath}/files.net-hesten.dk/cache_data/ht_race_counts.php", $file_content);
	}

	public static function buy($attr = [])
	{
		global $link_new;

		$return_data = [];
		$defaults = [];

		foreach ($defaults as $key => $value) {
			isset($attr[$key]) ?: $attr[$key] = $value;
		}
		foreach ($attr as $key => $value) {
			$attr[$key] = $link_new->real_escape_string($value);
		}

		$bid_date = new DateTime('now');
		$sql = "SELECT `stutteri`, `penge` FROM `{$GLOBALS['DB_NAME_OLD']}`.`Brugere` WHERE `id` = {$_SESSION['user_id']} LIMIT 1";
		$result = $link_new->query($sql);
		if ($result) {
			$data = $result->fetch_assoc();
			$temp_user_data = ['money' => $data['penge'], 'username' => $data['stutteri']];
		} else {
			/* This should never be possible */
			return ['Kritisk fejl: Dit stutteri kunne ikke findes, prøv igen eller kontakt en admin evt. på tech@net-hesten.dk', 'error'];
		}


		$accepted_last_buy_date = new DateTime('NOW');
		$accepted_last_buy_date->sub(new DateInterval("P0DT15M"));
		$sql = "SELECT `value` FROM `user_data_timing` WHERE `parent_id` = {$_SESSION['user_id']} AND `name` = 'last_horse_trader_buy' LIMIT 1";
		$result = $link_new->query($sql);
		if ($result) {

			if ($data = ($result->fetch_object()->value ?? '0000-00-00 00:00:00')) {
				if ($data < $accepted_last_buy_date->format('Y-m-d H:i:s')) {
					/* all good */
				} else {
					return ["Du må højst købe en hest hver 15. minut", 'warning'];
				}
			}


			/* Ensure the horse exists and that it is owned by the trader */
			if (!$temp_horse_data = horses::get_one(['ID' => $attr['horse_id']])) {
				/* This should never be possible */
				return ["Kritisk fejl: Hesten med det angivne ID {{$attr['horse_id']}} findes ikke, prøv igen eller kontakt en admin evt. på tech@net-hesten.dk", 'error'];
			}
			if ($temp_horse_data->owner_name !== 'hestehandleren') {
				/* The horse is no longer for sale, return to prevent race condition errors */
				return ['Hesten du har forsøgt at købe, tilhører desværre ikke længere hestehandleren.', 'warning'];
			}


			/* Check user funds vs horse price */
			if ($temp_user_data['money'] >= $temp_horse_data->value) {
				$sql = "UPDATE `{$GLOBALS['DB_NAME_OLD']}`.`Heste` SET `bruger` = '{$temp_user_data['username']}' WHERE `id` = {$attr['horse_id']} AND `bruger` = 'hestehandleren'";
				$link_new->query($sql);
				accounting::add_entry(['amount' => $temp_horse_data->value, 'line_text' => "HH: Købt hest: [{$attr['horse_id']}]"]);

				$sql = "INSERT INTO `user_data_timing` (`parent_id`, `name`, `value`) VALUES ({$_SESSION['user_id']},'last_horse_trader_buy',NOW()) ON DUPLICATE KEY UPDATE `value` = NOW()";
				$link_new->query($sql);

				self::generate_count_cache();
				return ["Du lige købt denne hest for {$temp_horse_data->value} wkr, tillykke!", 'success'];
			} else {
				/* The user does not have the required funds */
				return ["Du har ikke penge nok til at købe denne hest, du har {$temp_user_data['money']}, men du skal bruge {$temp_horse_data->value}", 'warning'];
			}
		}
		return false;
	}

	public static function sell($attr = [])
	{
		global $link_new;
		$return_data = [];
		$defaults = [];
		foreach ($defaults as $key => $value) {
			isset($attr[$key]) ?: $attr[$key] = $value;
		}
		foreach ($attr as $key => $value) {
			$attr[$key] = $link_new->real_escape_string($value);
		}

		$bid_date = new DateTime('now');
		$sql = "SELECT `stutteri`, `penge` FROM `{$GLOBALS['DB_NAME_OLD']}`.`Brugere` WHERE `id` = {$attr['seller_id']} LIMIT 1";
		$result = $link_new->query($sql);
		if ($result) {
			$data = $result->fetch_assoc();
			$temp_user_data = ['money' => $data['penge'], 'username' => $data['stutteri']];
		} else {
			return ['Kritisk fejl: Dit stutteri kunne ikke findes, prøv igen eller kontakt en admin evt. på admin@net-hesten.dk', 'error'];
		}

		if (!$temp_horse_data = horses::get_one(['ID' => $attr['horse_id']])) {
			return ["Kritisk fejl: Hesten med det angivne ID {{$attr['horse_id']}} findes ikke, prøv igen eller kontakt en admin evt. på admin@net-hesten.dk", 'error'];
		}
		if (mb_strtolower($temp_horse_data->owner_name) !== mb_strtolower("{$temp_user_data['username']}")) {
			return ['Hesten du har forsøgt at sælge, tilhører desværre ikke dig.', 'warning'];
		}

		$sell_income = ($temp_horse_data->value * 0.9);

		accounting::add_entry(['amount' => $sell_income, 'line_text' => "HH: Solgt hest: [{$attr['horse_id']}]", 'mode' => '+']);

		$sql = "UPDATE `{$GLOBALS['DB_NAME_OLD']}`.`Heste` SET `bruger` = 'hestehandleren' WHERE `id` = {$attr['horse_id']} AND `bruger` = '{$temp_user_data['username']}'";
		$link_new->query($sql);

		self::generate_count_cache();
		return ["Du lige solgt din hest for {$sell_income} wkr, tillykke!", 'success'];

		return false;
	}
}
