<?php

$basepath = '../..';
require_once "$basepath/app_core/db_conf.php";
require_once "$basepath/app_core/object_loader.php";
require_once "$basepath/app_core/user_validate.php";

if (isset($_SESSION['user_id'])) {
	user::register_timing(['user_id' => $_SESSION['user_id'], 'key' => 'last_active']);
	user::register_session(['user_id' => $_SESSION['user_id']]);
}

$admin = false;
$force_banner_off = true;
$public_page = true;
require_once("{$basepath}/global_modules/header.php"); ?>

<section>

	<style>
		#rules {
			color: transparent;
		}

		#rules h1,
		#rules h2,
		#rules h3,
		#rules p {
			color: black !important;
		}

		#rules h1,
		#rules h2,
		#rules h3 {
			padding-top: 1em;
		}

		#rules p {
			font-size: 16px !important;
			line-height: 1.2;
			margin: 0;
		}

		#rules p+p {
			margin-top: 1em;
		}

		#rules li {
			font-size: 16px !important;
			line-height: 1.2;
		}

		#rules li:before {
			content: "•";
			display: inline-block;
			color: black;
			padding-right: 5px;
		}

		#rules ul {
			padding: 10px 0;
		}

		#rules a {
			color: cornflowerblue !important;
		}
	</style>

	<div id="rules" style="max-width: 600px;margin: 0 auto;">
		<h1 style="padding-top:0;">Net-Hesten - Persondata politik </h1>
		<h2>Gældende siden 9. November 2018</h2>
		<h3><a href="/infosheets/data_regulative-03-2020.php">Gammel fra 9. November 2018 -> 17. Marts 2020</a></h3>
		<h2>Forord</h2>
		<p>Teknisk set falder den data vi gemmer på net-hesten ikke længere ind under GDPR</p>
		<p>Men da spillet primæret henvender sig til unge mennesker, og vi går meget op i vores brugeres rettigheder på nettet, har vi valgt at beholde nedenstående</p>
		<p>Helt kort, har vi reelt kun gemt, IP "til almindeligt teknisk behov" samt jeres e-mail</p>
		<p>Opdateringen pr 9. November er alene til informationen omkring ejere dataen deles med, for at reflekterer lukning af firma PraktiskWeb</p>
		<p>Da PraktiskWeb alligevel var et PMV, har det ingen reel betydning for jeres data</p>
		<h2>Oversigt</h2>

		<h3>Dine rettigheder</h3>
		<ul>
			<li><a href="#access">Adgang til vores oplysninger på dig</a></li>
			<li><a href="#correction">Få rettet forkerte oplysninger</a></li>
			<li><a href="#deletion">Få slettet oplysninger om dig</a></li>
			<li><a href="#objection">Gør indsigelse mod behandling af dine data</a></li>
			<li><a href="#migration">Migrær dine personlige data</a></li>

		</ul>

		<h3>Hvilke data har vi på dig</h3>
		<ul>
			<li><a href="#your_mail">Din mail</a></li>
			<li><a href="#your_name">Dit navn (hvis du har oplyst det)</a></li>
			<li><a href="#chat_messages">Dine beskeder, til andre brugere samt i chatten</a></li>
			<li><a href="#saved_sessions">Dine onlinetider + IP i spillet, seneste 6 måneder</a></li>
		</ul>

		<h3>Hvordan / hvorfor bruger vi de data vi har på dig</h3>
		<ul>
			<li><a href="#why_your_mail">Din mail</a></li>
			<li><a href="#why_your_name">Dit navn (hvis du har oplyst det)</a></li>
			<li><a href="#why_chat_messages">Dine beskeder, til andre brugere samt i chatten</a></li>
			<li><a href="#why_saved_sessions">Dine onlinetider + IP i spillet, seneste 6 måneder</a></li>
		</ul>

		<h3>Hvordan sikre vi dine data</h3>
		<ul>
			<li><a href="#nothing_is_secure">Ingenting er 100% sikkert</a></li>
			<li><a href="#hashing">Password hashing</a></li>
		</ul>

		<h3>Hvem deler vi dine data med</h3>
		<ul>
			<li><a href="#hosting_provider">Hosting udbyder</a></li>
			<li><a href="#owners">Ejerne</a></li>
			<li><a href="#police">Politiet</a></li>
			<li><a href="#share_facebook">Facebook</a></li>
		</ul>


		<h1>Dine rettigheder</h1>

		<h2 id="access">Adgang til vores oplysninger på dig</h2>

		<p>Du har krav på, at få adgang til, de oplysninger vi har på dig.</p>
		<p>Dette gøres helt konkret ved at gå ind på "mit stutteri" og trykke "indstillinger" trykke "advancerede" og herefter klikke "tilsend kopi af persondata"</p>
		<p>Du vil nu modtage en mail, med en kopi af alt hvad vi har på din brugers ID, processen er fuldt automatisk, og der er ikke noget der udelades.</p>
		<p>Vi bliver ikke adviceret om din anmodning, da du alligevel altid har ret til at få alt, så der er ingen grund til, at vi skal gennemgå det manuelt.</p>
		<p>Så hvis du ikke har modtaget mailen inden for anstændig tid, så prøv gerne igen, eller send en mail til tech@net-hesten.dk så kigger vi på hvad der kan være galt.</p>

		<h2 id="correction">Få rettet forkerte oplysninger</h2>
		<p>Hvis noget data er ukorrekt, har du krav på at få det ændret, langt det meste, vil du kunne ændre selv.</p>
		<p>Dette gør du ved at gå ind på "mit stutteri" og trykke "rediger".</p>
		<p>Hvis du vil have ændret noget, der ikke kan rettes her, så henvend dig pr mail til tech@net-hesten.dk</p>

		<h2 id="deletion">Få slettet oplysninger om dig</h2>
		<p>Du har ret til at få slette oplysninger om din person, som du ikke ønsker vi har.</p>
		<p>Du kan selv slette f.eks. dit navn, ved at rette det på din profil.</p>
		<p>Men alt data vi opbevarer, opbevares af en <a href="#reasons">specifik grund</a>, hvorfor langt de fleste ting, kun kan slette i forbindelse med, at vi så også sletter din bruger.</p>
		<p>Det er naturligvis din fulde ret. Hvis du ønsker det, skal du blot sende en mail til tech@net-hesten.dk, og orrienterer om, at du ikke længere ønsker at være bruger på net-hesten.</p>
		<p>Herefter, vil vi hurtigst muligt, få slettet alt data om dig, og du vil modtage en endelig bekræftelse på at dette er sket.</p>
		<p>I forbindelse med en sletning, vil en kopi blive opbevaret særskilt fra spillet, i 1 måned, dette sker af hensyn til, at passe på vores andre brugere, hvis det skulle nå at vise sig <a href="#necessary">nødvendigt</a>.</p>

		<h2 id="objection">Gør indsigelse mod behandling af dine data</h2>
		<p>På samme måde som nævnt ovenfor, vedr. sletning af oplysninger, vil der ikke være nogen steder hvor det rigtig giver mening, at gøre indsigelse mod en specifik data, vi behandler om dig.</p>
		<p>Hvis du har problemer med vores behandling af din data, er du velkommen til at skrive til tech@net-hesten.dk, men du bør istedet anmode om at blive slettet.</p>

		<h2 id="migration">Migrær dine personlige data</h2>
		<p>Net-Hesten er et specialudviklet spil, under copyright, hvorfor ingen af din profils personlige data, hos net-hesten, vil være af nogen særskilt værdi, andet steds.</p>


		<h1 id="what_data">Hvilke data har vi på dig</h1>

		<h2 id="your_mail">Din mail</h2>
		<p>Vi gemmer din mail tilknyttet til din bruger</p>

		<h2 id="your_name">Dit navn (hvis du har oplyst det)</h2>
		<p>Der er mulighed for at tilknyttet et navn til sin profil, hvis du har gjort dette, er det naturligvis gemt i vores data</p>

		<h2 id="chat_messages">Dine beskeder, til andre brugere samt i chatten</h2>
		<p>Alt hvad der skrives i chat beskeder, og i private beskeder, gemmes naturligvis på serveren, hvorfor vi af gode grunde har adgang til det.</p>
		<p>Især værd at notere er, at hvis du sletter en PB, vil den anden bruger, ikke miste sin kopi, og selv hvis i begge sletter jeres udgaver, har vi stadig en kopi i systemet</p>
		<p>Hvis begger parter har slettet beskeden vil den blive ryddet fra vores server efter 1 år</p>

		<h2 id="saved_sessions">Dine onlinetider + IP i spillet, seneste 6 måneder</h2>
		<p>Eksempel på hvordan denne data ser ud, den går kun 6 måneder tilbage<br />
			{bruger id} - {start tid} - {slut tid} - {ip} <br />
			52194 2018-05-13 18:36:12 2018-05-13 19:09:43 ***.***.***.***<br />
			52194 2018-05-13 12:16:20 2018-05-13 12:16:21 ***.***.***.***<br />
			52194 2018-05-13 11:42:04 2018-05-13 11:42:05 ***.***.***.***<br />
			52194 2018-05-13 09:01:45 2018-05-13 09:07:04 ***.***.***.***<br />
		</p>



		<h1 id="reasons">Hvordan / hvorfor bruges disse data</h1>

		<h2 id="why_your_mail">Din mail</h2>
		<p>Det er nødvendigt at vi kender din mail, for at vi kan tilbyde dig mulighed for, at nulstille din kode</p>
		<p>Din mail bruges også til, at vi kan sende dig vigtige informationer vedr. din bruger</p>
		<p>Det er svært at definerer præcis hvad, vi ville betegne som en vigtig information, men vi sender dig aldrig noget vi ikke ved du ønsker, uden at det er strengt nødvendigt</p>
		<p>Hvis du ikke har logget ind, i mere end én måned, vil du få en mail en gang om måneden, der minder dig om, at du har en bruger på net-hesten, for at give dig mulighed for, at tage stilling til, om vi fortsat må behandle dine data</p>
		<p>Den tilknyttede mail, anvendes også som den endelige verificering, af ejerskab over stutteriet, hvis der opstår stridigheder om dette</p>
		<p>Din mail vil blive anvent til evt. nyhedsbreve, såfremt du har tilmeldt disse under dine konto indstillinger</p>
		<p>Endelig er det nødvendigt, at en bruger har en mail tilknyttet, for at vi kan identificerer rigtigheden af henvendelser sent til tech@net-hesten.dk og admin@net-hesten.dk</p>

		<h2 id="why_your_name">Dit navn (hvis du har oplyst det)</h2>
		<p>I spillet tilbyder vi mulighed for, at man kan skrive sit navn, som vises til andre brugere, udover sit stutteri navn</p>
		<p>Vi bruger det endvidere til at personligøre eventuelle nyhedsbreve, hvis du er tilmeldt disse</p>
		<p>Endelig vil vi anvende dit navn til at personligøre relevante direkte henvendelser pr mail</p>

		<h2 id="why_chat_messages">Dine beskeder, til andre brugere samt i chatten</h2>
		<p>Rent teknisk er det nødvendigt at gemme beskederne på vores server, for at kunne vise dem til jer</p>
		<p>Vi tilgår uden undtagelse, KUN en brugers privat beskeder hvis:</p>
		<p>- Vi bliver anmodet om at hjælpe, i forbindelse med evt. mobning</p>
		<p>- Det er strengt nødvendigt for at sikre spillets drift</p>
		<p>- Vi bliver påbudt det af politiet</p>
		<p>Når man har en platform på internettet, der henvender sig til unge mennesker, kan det desværre potentielt blive relevant, at involverer politiet</p>
		<p>For at sikre vores brugeres trivsel så godt som vi nu kan, beholder vi derfor alle chat beskeder, i minimum 1 år, også efter sletning af brugeren</p>

		<h2 id="why_saved_sessions">Dine onlinetider + IP i spillet, seneste 6 måneder</h2>
		<p>Mange af spillets funktioner kræver at vi har adgang til disse data, de deles aldrig med 3. parter, og er hostet internt i spillet</p>
		<p>Hvor mange platforme ville benytte sig af ex. google analytics, har vi af hensyn til vores brugeres privatliv, valgt at udarbejde vores egen målrettede løsning</p>
		<p>Det tillader os, at samle kun den mest nødvendige data, dertil kan vi beholde den lokalt på vores server, og behøver ikke sende den til google el lign.</p>



		<h1>Hvordan sikre vi dine data.</h1>

		<h2 id="nothing_is_secure">Ingenting er 100% sikkert.</h2>
		<p>Det er teknisk umuligt, at sikre sig 100% imod hacking, i hvert fald så længe man er forbundet til internettet.</p>
		<p>Enhver der siger anderledes, ved ikke hvad de snakker om.</p>
		<p>MEN! det man kan gøre, er at følge alle retningslinjer, og såkaldt best-practice.</p>
		<p>Heriblandt, at sikre sig, at kun <a href="#hosting_provider">kompentente mennesker</a> betjener serveren direkte.</p>
		<p>Man kan sikre sig, at alting altid er korrekt opdateret, og at man ikke gør noget uansvarligt.</p>
		<p>Alt koden bag net-hesten, følger strenge kvalitets standarder, når det kommer til sikkerhed, og er sat op efter best practice.</p>
		<p>Vi har desuden, en række 'logs' på plads, der vil gøre det muligt for os, at opdage, hvis vi har grund til at tro, at vi er blevet hacket.</p>
		<p>Hvis vi skulle blive hacket, vil vi kontakte datastyrrelsen og politiet, og når vi kender omfanget, vil vi orrienterer de evt. berørte brugere direkte.</p>

		<h2 id="hashing">Password hashing</h2>
		<p>Hvis nogen skulle få fat i vores bruger tabeller</p>
		<p>Så er alle passwords i tabellen, hashed efter alle kunstens regler</p>
		<p>En hashing funktion er en envejskryptering, der tillader at bekræfte, at to ting var ens, men ikke at finde ud af hvad den først var.</p>
		<p>Derfor skulle det være praktisk uladesiggøreligt, at aflede jeres egentlig passwords ud af vores data.</p>
		<p>Når man opretter en bruger på net-hesten, gemmer vi en hashed udgave af jeres password.</p>
		<p>Når man så logger ind senere, så laver vi en hashed udgave, af det der blev skrevet som kode, og sammenligner de to.</p>
		<p>På den måde gemmer vi aldrig jeres rigtige kode nogen steder.</p>



		<h1>Hvem deler vi dine data med</h1>

		<h2 id="hosting_provider">Hosting udbyder</h2>
		<p>Alt data der findes på net-hesten.dk og dens undersider samt mailkonti, er hostet ved <a href="https://hosting4real.net/">Hosting4Real</a> som er fuldt <a href="https://hosting4real.net/datapolitik">GDPR-kompatible</a></p>
		<p>Vi har valgt at outsource vores hosting, da det er et fag helt for sig selv, at holde en server sikker, og korrekt håndtering af data, ligger os meget nært</p>
		<p>Hosting4Real, er valgt for deres kompetancer, og faglige excellence. De er endvidere Europæisk funderet og derfor under samme strenge love og regler som os.</p>
		<p>Så vi og I kan være trykke ved, at alt data er håndteret af anstændige mennesker.</p>
		<p>Vi deler ikke din persondata med andre firmaer.</p>
		<p>Vi benytter f.eks. IKKE google analytics og lignende statistic programmer.</p>

		<h2 id="owners">Ejerne</h2>
		<p>Stutteri TækHesten styres af Chris Olesen: <br /> &bullet;&nbsp;<a href="https://www.facebook.com/chris.olesen1">Facebook</a> &bullet;&nbsp;<a href="https://www.linkedin.com/in/chrisolesen1/">LinkedIN</a></p>
		<p>Stutteri Net-Hesten styres af Line Jensen:<br /> &bullet;&nbsp;<a href="https://www.facebook.com/LineBineBone">Facebook</a></p>
		<p>I samarbejde driver vi net-hesten.dk som et privat projekt</p>
		<p>Begge parter har som værende de officielle ejere af sitet, ubeskåret adgang til alle oplysninger.</p>

		<h2 id="police">Politiet</h2>
		<p>Net-Hesten er et spil, der henvender sig til en relativt bred målgruppe, men især henvender vi os også til helt unge brugere</p>
		<p>I den forbindelse, kan der trods vores bedste intentioner, og indsats, potentielt opstå situationer, hvor det vil være nødvendigt at involvere politiet</p>
		<p>I så fald, vil vi dele alt relevant info, på de involverede brugere med ordensmagten</p>

		<h2 id="share_facebook">Facebook</h2>
		<p>Når du skriver til vores profil inde på Facebook, så gør du det, i henhold til Facebooks vilkår.</p>
		<p>Vi har ingen magt over, hvordan Facebook behandler, eller opbevarer data, vi kan sørge for, at det kun er Net-Hestens Admins der har adgang til vores udgave af dine data.</p>
		<p>Når du vælger at kontakte os via Facebook, vælger du derfor samtidig, at være underlagt deres data politikker.</p>
		<p>Helt konkret, går vi ind og sletter gamle beskeder, sendt til vores Facebook profil, efter ~ 1 måned, så vi ikke opbevarer dem unødvendigt.</p>
		<p>Hvis ovenstående ikke er acceptabelt for dig, bør du istedet kontakte os dirkete i spillet, eller på mail tech@net-hesten.dk eller admin@net-hesten.dk</p>
		<p>Vi deler INGEN data med Facebook, der er fremskaffet udenfor Facebook.</p>
		<p>Det vil f.eks. sige at når du klikker på et link til net-hesten fra Facebook.</p>
		<p>Så ved de at du klikkede på linket, men vi fortæller dem ikke noget om, hvad du så foretog dig på siden.</p>
		<br />
		<br />
		<br />
	</div>

</section>

<?php

require_once("{$basepath}/global_modules/footer.php");
