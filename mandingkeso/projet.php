<?php
/*** Created: Sat 2014-09-20 19:10:56 CEST
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);


$page->CSS_ppJump();
$page->CSS_ppWing();
//$page->CSS_Push("index");

$body = "";
$page_title = "Manding K&eacute;so";
$page->SetTitle($page_title);
$page->HotBooty();

$args = new stdClass();
$args->rootpage = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();



	/* HEADER */
	$body .= "<div class=\"headbanner\">\n";
	$body .= "<div class=\"imgheader\">\n";
	$body .= "<img src=\"../pictures/divers/projetHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
	$body .= "</div>\n";
	$body .= "<div class=\"headtxtarea\">\n";
	$body .= "<div class=\"headtxt\">\n";
	$body .= "&ldquo;Graines de parole mandingue&rdquo;, pour la mise en valeur de la tradition orale\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
//
	// Main body
		//// contenu
		$body .= "<div id=\"main_body wide\">\n";
		$body .= "<div class=\"csstab64_table\">\n";
		$body .= "<div class=\"csstab64_row\">\n";
			/* CONTENU */
			$body .= "<div class=\"csstab64_cell\">\n";
			$body .= "<div class=\"contenu\">\n";
			$body .= "<div class=\"contenutitle\">Contenu</div>\n";
			$body .= "<div class=\"contenubody\">\n";
			$body .= "<ol>\n";
			$body .= "<li><a href=\"#manding\" title=\"Le Grand Empire du Manding\">Le Grand Empire du Manding</a></li>\n";
			$body .= "<li><a href=\"#realisation\" title=\"La r&eacute;alisation du projet\">La r&eacute;alisation du projet</a></li>\n";
			$body .= "<li><a href=\"#fruits\" title=\"Les fruits de Manding K&eacute;so\">Les fruits de Manding K&eacute;so</a></li>\n";
			$body .= "</ol>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		//
			/* VILLAGE DESSIN */
			$body .= "<div class=\"csstab64_cell\">\n";
			$body .= "<div class=\"dossiervillagedessin\">\n";
			$body .= "<img alt=\"village\" title=\"village\" src=\"../pictures/divers/village.jpg\" />\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		/* ABSTRACT */
		$body .= "<div class=\"dossierabstract\">\n";
		$body .= "<div class=\"dossierabstracttitle\">Un enrichissement moral pour l&#039;Europe,<br />un tr&eacute;sor pr&eacute;serv&eacute; pour l&#039;Afrique&nbsp;!</div>\n";
		$body .= "<div class=\"dossierabstractbody\">Ce projet se veut centr&eacute; sur la tradition orale mandingue, qui v&eacute;hicule depuis des si&egrave;cles des valeurs, des id&eacute;ologies, des connaissances et des sagesses dont l&#039;Europe ignore presque tout.  Le but fondamental de Manding K&eacute;so est de faire conna&icirc;tre au monde les vertus de l&#039;enseignement mandingue qui nourrit aujourd&#039;hui encore des milliers de vies. Durant deux ans, nous allons parcourir &agrave; pied les terres de l&#039;Ancien Empire du Manding pour recueillir les paroles de ses habitants et les mettre en lumi&egrave;re.</div>\n";
		$body .= "</div>\n";
	//
		/* FEMME RIZ */
		$body .= "<div class=\"csstab64_table\">\n";
		$body .= "<div class=\"csstab64_row\">\n";
		$body .= "<div class=\"csstab64_cell femmeriz\">\n";
		$body .= "<img alt=\"Femme portant du riz\" title=\"Femme portant du riz\" src=\"../pictures/divers/femmeRiz.jpg\" />\n";
		$body .= "</div>\n";
		$body .= "<div class=\"csstab64_cell\">\n";
		$body .= "<div class=\"dossierabstractbody2\">Dans la langue Mandinka de Casamance, &laquo;K&eacute;so&raquo; signifie graine ou semence.</div>\n";
		$body .= "<div class=\"dossierabstractbody3\">Ce mot peut &eacute;galement &ecirc;tre utilis&eacute; pour d&eacute;signer une parole vraie. Le symbole de la graine correspond &agrave; merveille &agrave; notre projet. Tout comme la parole, elle se partage, perp&eacute;tue la vie et assure ainsi une continuit&eacute; &agrave; travers les &acirc;ges.</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		/*** GRAND EMPIRE MANDING ***/
		$body .= "<h2 id=\"manding\" class=\"projet\">Le Grand Empire du Manding</h2>\n";
		$body .= "<p class=\"projet\">Le Grand Empire du Manding, appel&eacute; aussi Empire du Mali, s&#039;&eacute;tendait de l&#039;Oc&eacute;an Atlantique jusqu&#039;&agrave; la boucle du Niger, sur un territoire d&eacute;ploy&eacute; entre le Sahara au Nord et la for&ecirc;t &eacute;quatoriale au Sud. Les pays concern&eacute;s par ce royaume sont les actuels S&eacute;n&eacute;gal, Gambie, Guin&eacute;e, Guin&eacute;e Bissau, Mali, Burkina Faso ainsi qu&#039;une partie de la Mauritanie et de la C&ocirc;te d&#039;Ivoire.</p>\n";
		//
			/* Histoire Manding */
			$body .= "<h3 class=\"projet\">L&#039;histoire du Manding</h3>\n";
			$body .= "<p class=\"projet\">L&#039;Empire mandingue a &eacute;t&eacute; constitu&eacute; en 1235 par un roi du nom de Soundiata K&eacute;&iuml;ta, proclam&eacute; &laquo;<a title=\"Note de bas de page\" class=\"footnote\" id=\"mansa\">Mansa</a><sup><a href=\"#note1\">1</a></sup>&raquo; pour avoir lib&eacute;r&eacute; la r&eacute;gion de l&#039;actuel Mali de son oppresseur, le roi Soumaoro Kant&eacute;. Le r&egrave;gne de Soundiata est r&eacute;put&eacute; pour avoir &eacute;t&eacute; un r&egrave;gne de paix et de prosp&eacute;rit&eacute;. Depuis le XIII<sup>e</sup> si&egrave;cle, les &laquo;Mansa&raquo; se sont succ&eacute;d&eacute;s. Ils s&#039;accompagnaient de griots charg&eacute;s de rapporter fid&egrave;lement les &eacute;v&egrave;nements v&eacute;cus par les dynasties au sein des royaumes. Avant l&#039;apparition de l&#039;&eacute;criture, les griots &eacute;taient les seuls garants des faits historiques accomplis dans le pass&eacute; et de la g&eacute;n&eacute;alogie des familles en Afrique de l&#039;Ouest.</p>\n";
		//
			/* Importance de la tradition orale */
			$body .= "<h3 class=\"projet\">L&#039;importance de la tradition orale chez les mandingues</h3>\n";
			$body .= "<p class=\"projet\">Dans une grande partie du continent africain, les populations privil&eacute;gient la culture de la parole &agrave; celle de l&#039;&eacute;crit. La tradition orale a permis &agrave; l&#039;histoire de survivre &agrave; travers les &acirc;ges, malgr&eacute; les al&eacute;as de l&#039;histoire (traite n&eacute;gri&egrave;re, guerres civiles, colonisation...). Jusqu&#039;&agrave; nos jours, les &laquo;ma&icirc;tres de la parole&raquo; entretiennent la m&eacute;moire mandingue et tentent de la pr&eacute;server.</p>\n";
			$body .= "<p class=\"projet\">En Casamance, les anciens ont lutt&eacute; longtemps contre l&#039;implantation d&#039;&eacute;coles sur leurs terres car elles imposaient aux enfants un enseignement &eacute;crit. Leur motif &eacute;tait que le fait d&#039;&eacute;crire rendait l&#039;esprit paresseux et emp&ecirc;chait l&#039;effort et la pratique du souvenir. Chez les mandingues, la transmission de la parole est tr&egrave;s ritualis&eacute;e. Ainsi l&#039;annonce d&#039;une nouvelle d&#039;importance doit se faire selon un ordre logique, en respectant le rang social et l&#039;anciennet&eacute; des membres de la communaut&eacute; &agrave; laquelle le message est adress&eacute;.</p>\n";
		//
			/* VILLAGE PHOTO */
			$body .= "<div class=\"villagephoto\"><img alt=\"village\" title=\"village\" src=\"../pictures/divers/villagePhoto.jpg\" /></div>\n";
		//
			/* Preservation de la culture mandingue */
			$body .= "<h3 class=\"projet\">La pr&eacute;servation de la culture mandingue&nbsp;: une urgence</h3>\n";
			$body .= "<p class=\"projet\">Comme l&#039;a dit Amadou Ampath&eacute; B&acirc; : &laquo;En Afrique, un vieillard qui meurt c&#039;est une biblioth&egrave;que qui br&ucirc;le&raquo;.</p>\n";
			$body .= "<p class=\"projet\">Aujourd&#039;hui, avec les d&eacute;parts de plus en plus fr&eacute;quents des villageois vers les villes, la m&eacute;moire mandingue est menac&eacute;e. Les contes et les enseignements oraux quittent le quotidien pour devenir des distractions occasionnelles. Les rites de passage sont eux aussi r&eacute;duits et transform&eacute;s car la modernisation ne favorise pas l&#039;&eacute;panouissement des traditions. L&#039;initiation des jeunes dans la for&ecirc;t, qui s&#039;av&egrave;re &ecirc;tre une &eacute;tape cruciale pour la transmission des savoirs, se voit malheureusement diminuer dans la dur&eacute;e en raison de la scolarit&eacute; des jeunes.</p>\n";
		//
		//
	//
		/*** REALISATION DU PROJET ***/
		$body .= "<h2 class=\"projet\" id=\"realisation\">La r&eacute;alisation du projet</h2>\n";
		$body .= "<p class=\"projet\">Notre objectif global est de pr&eacute;server et de valoriser les richesses culturelles et humaines des communaut&eacute;s mandingues d&#039;Afrique de l&#039;Ouest. Pour r&eacute;aliser cet objectif, nous allons parcourir &agrave; pied durant deux ans diff&eacute;rents pays situ&eacute;s sur les terres de l&#039;Ancien Empire du Manding et nous mettre &agrave; l&#039;&eacute;coute des populations, en particulier des anciens et des &laquo;ma&icirc;tres de la parole&raquo;.</p>\n";
		//
			/* Objectifs operationnels */
			$body .= "<h3 class=\"projet\">Les objectifs op&eacute;rationnels</h3>\n";
			$body .= "<p class=\"projet\">Ils se divisent en deux volets&nbsp;: la collecte et la diffusion des paroles mandingues.</p>\n";
				/* 1er */
				$body .= "<h4 class=\"projet\">Objectif premier&nbsp;: r&eacute;colter des graines de paroles mandingues</h4>\n";
				$body .= "<p class=\"projet\">Nous voulons r&eacute;aliser une base de donn&eacute;es qui contienne des textes &eacute;crits, des photographies et des documentaires audiovisuels.</p>\n";
				$body .= "<p class=\"projet\">Avec le consentement des personnes, nous recueillerons &agrave; l&#039;aide d&#039;un appareil d&#039;enregistrement :</p>\n";
				$body .= "<ul class=\"projet\">\n";
				$body .= "<li>des t&eacute;moignages de personnes influentes parlant de leur v&eacute;cu et partageant leur vision du monde</li>\n";
				$body .= "<li>des contes mandingues, avec explication sur leur origine et leur sens profond</li>\n";
				$body .= "<li>des chants traditionnels, avec explication sur leur origine et leur sens profond</li>\n";
				$body .= "</ul>\n";
				$body .= "<p class=\"projet\">Les photographies permettront de mettre un visage sur les personnes qui s&#039;expriment et de les laisser uniques ma&icirc;tres de leurs propos. Les documentaires audiovisuels seront focalis&eacute;s sur un th&egrave;me d&eacute;fini et travaill&eacute; au pr&eacute;alable, le principal sujet vis&eacute; &eacute;tant celui de l&#039;initiation dans la for&ecirc;t et les enseignements qui entourent ce rite de passage.</p>\n";
			//
				/* 2e */
				$body .= "<h4 class=\"projet\">Objectif second&nbsp;: cultiver les graines de paroles mandingues</h4>\n";
				$body .= "<p class=\"projet\">Les documents audiovisuels et litt&eacute;raires produits pourront &ecirc;tre expos&eacute;s lors de manifestations culturelles, donner lieu &agrave; des conf&eacute;rences ou &ecirc;tre vendus par les initiateurs du projet. Sous certaines conditions, ils pourront &eacute;galement &ecirc;tre mis &agrave; la disposition d&#039;organes oeuvrant pour la valorisation du patrimoine culturel des pays concern&eacute;s.</p>\n";
			//
			//
		//
			/* Itineraire */
			$body .= "<h3 class=\"projet\">Notre itin&eacute;raire</h3>\n";
			$body .= "<div class=\"csstab64_table\">\n";
			$body .= "<div class=\"csstab64_row\">\n";
			$body .= "<div class=\"csstab64_cell projetitineraireleft\">\n";
			$body .= "<p class=\"projet\">Nous avons choisi la marche afin de rester proches du mode de vie des habitants des villages et libres du choix de nos destinations.</p>\n";
			$body .= "<p class=\"projet\"><b>Point de d&eacute;part&nbsp;:</b>&nbsp;K&eacute;ra Kunda, le village d&#039;origine de Lamine Kont&eacute;, situ&eacute; dans le Pakao en Casamance.</p>\n";
			$body .= "<p class=\"projet\"><b>Pays &agrave; parcourir&nbsp;:</b>&nbsp;S&eacute;n&eacute;gal (Casamance), Gambie, Guin&eacute;e Bissau, Guin&eacute;e Conakry, Mali et Burkina Faso.</p>\n";
			$body .= "</div>\n";
			$body .= "<div class=\"csstab64_cell projetitineraireright\">\n";
			$body .= "<img class=\"projetitineraireright\" alt=\"itin&eacute;raire\" title=\"itin&eacute;raire\" src=\"../pictures/divers/itineraire.jpg\" />\n";
			$body .= "</td></tr></table>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		//
			/* Processus de realisation */
			$body .= "<h3 class=\"projet\">Le processus de r&eacute;alisation</h3>\n";
			$body .= "<p class=\"projet\">Notre voyage comprendra des &eacute;tapes dans les villes des pays parcourus, o&ugrave; nous profiterons des structures adapt&eacute;es pour le traitement des donn&eacute;es informatiques et vid&eacute;ographiques. Nous enverrons au fur et &agrave; mesure les &eacute;chantillons d&#039;images film&eacute;es ainsi que nos transcriptions d&#039;entretiens &agrave; l&#039;&eacute;quipe de coordination bas&eacute;e en Suisse. Ces donn&eacute;es seront stock&eacute;es jusqu&#039;&agrave; notre retour. Dans la mesure du possible certains montages seront effectu&eacute;s directement sur place afin d&#039;&ecirc;tre rapidement exploitables.</p>\n";
			$body .= "<p class=\"projet\">L&#039;approche des populations se fera dans une attitude de respect, selon les principes &eacute;nonc&eacute;s dans la <a href=\"voyage_charte.php\">charte de voyage</a>. Sur le terrain, nous nous efforcerons de nous conformer aux codes de l&#039;hospitalit&eacute;, en nous adressant en priorit&eacute; aux chefs des villages. Nous demanderons l&#039;accord des anciens avant d&#039;acqu&eacute;rir des images et de proc&eacute;der aux interviews. Les propos recueillis seront restitu&eacute;s avec le plus de fid&eacute;lit&eacute; possible et les participants seront tenus au courant du r&eacute;sultat final.</p>\n";
		//
			/* Suivi du projet */
			$body .= "<h3 class=\"projet\">Le suivi du projet</h3>\n";
			$body .= "<p class=\"projet\">Une &eacute;quipe de coordination veillera au bon fonctionnement du projet durant toute sa dur&eacute;e et g&egrave;rera les secteurs suivants&nbsp;:</p>\n";
			$body .= "<ul class=\"projet\">\n";
			$body .= "<li><b>Comptabilit&eacute;&nbsp;:</b> mise &agrave; jour des finances en lien avec les donateurs.</li>\n";
			$body .= "<li><b>Communication&nbsp;:</b> transmission d&#039;informations entre l&#039;&eacute;quipe bas&eacute;e en Suisse et le terrain. Le num&eacute;ro de t&eacute;l&eacute;phone d&#039;une personne de contact sera donn&eacute; en r&eacute;f&eacute;rence aux personnes int&eacute;ress&eacute;es par le projet.</li>\n";
			$body .= "<li><b>Site internet et blog&nbsp;:</b> Entretien du site Internet&nbsp;: insertion des nouveaux articles, photos ou reportages envoy&eacute;s.</li>\n";
			$body .= "</ul>\n";
		//
		//
	//
		/*** BUDGET ***/
		//$dossier .= "<h2 class=\"projet\">Le budget</h2>\n";
		//$dossier .= "<p class=\"projet\">Les frais inscrits dans ce budget ont &eacute;t&eacute; r&eacute;duits au minimum et les chiffres indiqu&eacute;s couvrent toute la dur&eacute;e du projet sur le terrain, soit deux ans &agrave; partir de mai 2009. Certains n&eacute;cessitant des pr&eacute;cisions ont &eacute;t&eacute; d&eacute;taill&eacute;s dans les sous-chapitres qui suivent.</p>\n";
		/*
		$body .= "<div class=\"projettable\">\n";
		$body .= "<table class=\"projet\">\n";
		$body .= "<tr>\n";
		$body .= "<th class=\"projetleft\">Objet</th>\n";
		$body .= "<th class=\"projetright\"><div>Co&ucirc;t (en francs suisses)</div><div class=\"projettabletiny\">(1CHF vaut environ 400CFA)</div></th>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettableleft\">Frais de voyage</td>\n";
		$body .= "<td class=\"projettableright\">4&#039;000.-</td>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettableleft\">Sant&eacute;</td>\n";
		$body .= "<td class=\"projettableright\">12&#039;000.-</td>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettableleft\">Subsistance</td>\n";
		$body .= "<td class=\"projettableright\">7&#039;000.-</td>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettableleft\">Communication</td>\n";
		$body .= "<td class=\"projettableright\">1&#039;500.-</td>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettableleft\">Nuit&eacute;es en ville</td>\n";
		$body .= "<td class=\"projettableright\">1&#039;500.-</td>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettableleft\">Mat&eacute;riel de randonn&eacute;e</td>\n";
		$body .= "<td class=\"projettableright\">1&#039;000.-</td>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettableleft\">Mat&eacute;riel audiovisuel</td>\n";
		$body .= "<td class=\"projettableright\">8&#039;000.-</td>\n";
		$body .= "</tr>\n";
		$body .= "<tr>\n";
		$body .= "<td class=\"projettablelefttotal\">Total</td>\n";
		$body .= "<td class=\"projettablerighttotal\">35&#039;000.-</td>\n";
		$body .= "</tr>\n";
		$body .= "</table>\n";
		$body .= "</div>\n";
		*/
			/* Sante */
			//$dossier .= "<h3 class=\"projet\">La sant&eacute;</h3>\n";
			//$dossier .= "<p class=\"projet\">L&#039;importance de ce montant est li&eacute;e au fait que nous conserverons nos papiers en Suisse et continuerons par cons&eacute;quent &agrave; payer l&#039;assurance maladie obligatoire. En cas de maladie ou d&#039;accident sans gravit&eacute;, nous nous soignerons et ach&egrave;terons les m&eacute;dicaments n&eacute;cessaires sur place. Si un probl&egrave;me important devait survenir, nous aurions recours au rapatriement.</p>\n";
		//
			/* Logement et subsistance */
			//$dossier .= "<h3 class=\"projet\">Le logement et la subsistance</h3>\n";
			//$dossier .= "<p class=\"projet\">Puisque nous ferons appel &agrave; l&#039;hospitalit&eacute; des communaut&eacute;s rurales, nous avons pr&eacute;vu une somme qui sera donn&eacute;e en remerciement aux chefs des villages ou aux personnes qui nous accueilleront personnellement. Ce montant variera en fonction de la dur&eacute;e du s&eacute;jour. Les d&eacute;penses seront plus importantes lors des &eacute;tapes pr&eacute;vues en ville. Lorsque nous ne logerons pas chez l&#039;habitant, nous chercherons des chambres d&#039;h&ocirc;tes ou des auberges bon march&eacute; o&ugrave; passer la nuit.</p>\n";
		//
			/* Matos */
			//$dossier .= "<h3 class=\"projet\">Mat&eacute;riel de randonn&eacute;e et audiovisuel</h3>\n";
			//$dossier .= "<p class=\"projet\">Avant notre d&eacute;part, nous devrons nous &eacute;quiper d&#039;un mat&eacute;riel qui soit &agrave; la fois l&eacute;ger, pratique et r&eacute;sistant. Ce point comprend essentiellement:</p>\n";
			//$dossier .= "<ul class=\"projet\">\n";
			//$dossier .= "<li>sacs et chaussures de randonn&eacute;es</li>\n";
			//$dossier .= "<li>v&ecirc;tements adapt&eacute;s &agrave; la chaleur et aux caprices du ciel</li>\n";
			//$dossier .= "<li>petits sacs de couchage</li>\n";
			//$dossier .= "<li>cam&eacute;ra et appareil-photo num&eacute;riques</li>\n";
			//$dossier .= "<li>microphone et batteries</li>\n";
			//$dossier .= "<li>enregistreur minidisque</li>\n";
			//$dossier .= "</ul>\n";
		//
		//
	//
		/*** FRUITS DE MANDING KESO ***/
		$body .= "<h2 class=\"projet\" id=\"fruits\">Les fruits de Manding K&eacute;so</h2>\n";
		$body .= "<p class=\"projet\">Les fruits de ce projet prendront plusieurs formes. La premi&egrave;re sera litt&eacute;raire, avec un ouvrage anthropologique et un recueil de contes &agrave; la cl&eacute;. La seconde sera imag&eacute;e et comprendra des reportages, ainsi qu&#039;une biblioth&egrave;que photographique. Une forme orale serait aussi int&eacute;ressante, puisque ce projet a pour but de mettre en avant les richesses v&eacute;hicul&eacute;es par la tradition orale. Des conf&eacute;rences pourraient &ecirc;tre men&eacute;es dans le cadre d&#039;&eacute;v&eacute;nements culturels pour partager les tr&eacute;sors de la parole observ&eacute;s dans les villages Ouest africains.</p>\n";
		$body .= "<div class=\"csstab64_table\">\n";
		$body .= "<div class=\"csstab64_row\">\n";
		$body .= "<div class=\"csstab64_cell projetlastpic\">\n";
		$body .= "<img alt=\"kora\" title=\"kora\" src=\"../pictures/divers/kora.png\" />\n";
		$body .= "</div>\n";
		$body .= "<div class=\"csstab64_cell projetlasttxt\">\n";
		$body .= "<h5 class=\"projet\">Fruits du projet</h5>\n";
		$body .= "<ul class=\"projet\">\n";
		$body .= "<li>transcription de t&eacute;moignages sur les femmes et les hommes qui marquent l&#039;histoire des villages en raison de dons h&eacute;rit&eacute;s</li>\n";
		$body .= "<li>recueil de contes et de chants traditionnels (langue locale et traduction)</li>\n";
		$body .= "<li>reportage audiovisuel sur les enseignements qui entourent l&#039;initiation dans les villages de Casamance</li>\n";
		$body .= "<li>biblioth&egrave;que photographique&nbsp;: portraits et citations qui pourraient faire l&#039;objet d&#039;une exposition sur les sagesses mandingues</li>\n";
		$body .= "</ul>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		/* NOTES */
		$body .= "<div class=\"projetnotes\">\n";
		$body .= "<h5 class=\"projetnotes\">Notes&nbsp;:</h5>\n";
		$body .= "<ol>\n";
		$body .= "<li class=\"footnote\" id=\"note1\">En mandingue, le mot &laquo;Mansa&raquo; signifie Grand Roi. Il d&eacute;signe aujourd&#039;hui encore une personne investie d&#039;un pouvoir discr&eacute;tionnaire. (<a title=\"retour\" href=\"#mansa\">retour</a>)</li>\n";
		$body .= "</ol>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
//

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
