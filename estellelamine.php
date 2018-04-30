<?php
/*** Created: Wed 2014-09-17 20:49:42 CEST
 ***
 *** TODO:
 ***
 ***/
require("functions/classPage.php");
$funcpath = "functions";
require("${funcpath}_local/copyright.php");
$page = new PhPage();
//$page->LogLevelUp(6);

$page->CSS_Push("index");

$body = "";
//$body .= "<div id=\"thebody\">\n";
$body .= $page->GoHome();
$body .= $page->SetTitle("Estelle et Lamine Kont&eacute;");
$page->HotBooty();

//
	//// define texts
	$eux = "Lamine et Estelle Kont&eacute;";
	$qui = "Qui sommes-nous ?";
	$mariageCH = "Mariage en Suisse";
	$mariageCasamance = "Mariage en Casamance";
	$abstract = "Le projet &laquo;&nbsp;Manding k&eacute;so&nbsp;&raquo; est le fruit d&#039;un amour grandissant... amour port&eacute; &agrave; la terre, &agrave; la vie de ses habitants, aux cultures d&#039;Afrique enracin&eacute;es dans les villages.";
	$estelle = "N&eacute;e en Suisse en 1979, je me suis int&eacute;ress&eacute;e tr&egrave;s t&ocirc;t aux communaut&eacute;s &eacute;trang&egrave;res &eacute;tablies en Valais.";
	$cvestelle = "<ul>\n";
	$cvestelle .= "<li>1996&nbsp;: Echange culturel d&#039;une ann&eacute;e au Zimbabwe</li>\n";
	$cvestelle .= "<li>1999&nbsp;: Maturit&eacute; en langues modernes</li>\n";
	$cvestelle .= "<li>1999 &agrave; 2001&nbsp;: Exp&eacute;rience de dix-huit mois dans un quartier populaire de Dakar au S&eacute;n&eacute;gal avec l&#039;association Points-Coeur</li>\n";
	$cvestelle .= "<li>2001 &agrave; 2002&nbsp;: Stage puis coresponsabilit&eacute; du secteur enfants au centre culturel RLC, Sion</li>\n";
	$cvestelle .= "<li>2003&nbsp;: Stage de six mois &agrave; La Maison de Terre des hommes</li>\n";
	$cvestelle .= "<li>2004&nbsp;: Exp&eacute;rience de neuf mois &agrave; Enda Tiers Monde Dakar</li>\n";
	$cvestelle .= "<li>2005&nbsp;: Dipl&ocirc;me en travail social, fili&egrave;re animation socioculturelle</li>\n";
	$cvestelle .= "<li>2005 &agrave; 2009&nbsp;: Engagement &agrave; La Maison de Terre des hommes en tant qu&#039;&eacute;ducatrice</li>\n";
	$cvestelle .= "</ul>\n";
	$lamine = "N&eacute; au S&eacute;n&eacute;gal en 1980, j&#039;ai v&eacute;cu entre le monde de la ville et celui du village mandingue dont je suis originaire. Issu de la famille fondatrice de Kera Kunda, en Casamance et en tant qu&#039;a&icirc;n&eacute; de famille, j&#039;ai appris &agrave; r&eacute;fl&eacute;chir et &agrave; agir en responsable de toute une communaut&eacute;. J&#039;ai accueilli les conseils de mon grand-p&egrave;re comme des biens pr&eacute;cieux afin de g&eacute;rer au mieux ce qui m&#039;a &eacute;t&eacute; transmis.";
	$cvlamine = "<ul>\n";
	$cvlamine .= "<li>D&egrave;s 1985&nbsp;: Pratique des arts martiaux puis de l&#039;athl&eacute;tisme</li>\n";
	$cvlamine .= "<li>1999&nbsp;: M&eacute;daille d&#039;or aux championnats du S&eacute;n&eacute;gal de Kung Fu et dipl&ocirc;me international donnant droit d&#039;enseigner les arts martiaux</li>\n";
	$cvlamine .= "<li>1999 &agrave; 2004&nbsp;: Entra&icirc;neur de Kung Fu &agrave; l&#039;&eacute;quipe nationale </li>\n";
	$cvlamine .= "<li>2004 &agrave; 2005&nbsp;: D&eacute;but d&#039;apprentissage en menuiserie chez Astori Fr&egrave;res &agrave; Bramois</li>\n";
	$cvlamine .= "<li>2006 &agrave; 2008&nbsp;: Manoeuvre en menuiserie chez &laquo;&nbsp;Debons Tout en Boi&nbsp;&raquo; &agrave; Savi&egrave;se </li>\n";
	$cvlamine .= "<li>2008 &agrave; 2009&nbsp;: Manoeuvre chez &laquo;&nbsp;D&eacute;l&egrave;ze Fen&ecirc;tres&nbsp;&raquo;</li>\n";
	$cvlamine .= "<li>D&egrave;s janvier 2005&nbsp;: Instructeur de Kung Fu au centre culturel RLC &agrave; Sion </li>\n";
	$cvlamine .= "<li>D&egrave;s 2004&nbsp;: conteur (veill&eacute;es, festivals, manifestations culturelles en tous genres...)</li>\n";
	$cvlamine .= "</ul>\n";
	$mCas1 = "Le 12 octobre 2004, les anciens se sont r&eacute;unis pr&egrave;s de la mosqu&eacute;e au centre du village, pour b&eacute;nir et c&eacute;l&eacute;brer notre mariage selon la tradition. Ils ont partag&eacute; devant nous du sel et des noix de kola avec toute la communaut&eacute; et ils ont r&eacute;cit&eacute; des pri&egrave;res. L&#039;Imam a prononc&eacute; des paroles de tol&eacute;rance, qui nous invitaient &agrave; respecter nos choix religieux et &agrave; nous aimer avec nos diff&eacute;rences. Lamine est le premier parmi les habitants de K&eacute;ra Kunda &agrave; s&#039;&ecirc;tre mari&eacute; au village avec une europ&eacute;enne. Ba Falang, notre grand-p&egrave;re, a tu&eacute; une ch&egrave;vre en notre honneur et nous avons partag&eacute; un repas avec toute la communaut&eacute;.";
	$mCas2 = "Ce jour-l&agrave;, nous avons eu le grand honneur de b&eacute;n&eacute;ficier de la pr&eacute;sence d&#039;un griot &laquo;&nbsp;Fina&nbsp;&raquo;. Il connaissait la g&eacute;n&eacute;alogie des Kont&eacute; et nous a suivis du lieu de la c&eacute;r&eacute;monie &agrave; la maison en clamant d&#039;une voix r&eacute;sonnante l&#039;histoire de notre famille.";
	$mCH1 = "Le 21 ao&ucirc;t 2005, nous nous sommes mari&eacute;s dans l&#039;&eacute;glise de Bramois, en pr&eacute;sence de notre famille et de nos amis valaisans.";
	$mCH2 = "La c&eacute;r&eacute;monie a &eacute;t&eacute; riche en couleurs et en sourires. Nous nous sommes promis que notre maison resterait ouverte et accueillante.";
	$proverbe = "Pour que le foyer soit stable et supporte la marmite, il faut toujours trois pierres&nbsp;: l&#039;homme, la femme et Dieu";
	$legende = "Proverbe des trois pierres, bien connu en Casamance";
//


	//// TOC
	$body .= "<div class=\"contenu\">\n";
	$body .= "<div class=\"csstab64_table contenutable\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
	$body .= "<div class=\"csstab64_cell contenuleft\">\n";
	$body .= "<img class=\"eux\" alt=\"$eux\" title=\"$eux\" src=\"pictures/divers/LamineEstelle.jpg\" />\n";
	$body .= "</div>\n";
	$body .= "<div class=\"csstab64_cell contenuright\">\n";
	$body .= "<div class=\"qui\">$qui</div>\n";
	$body .= "<div class=\"qui\"><a title=\"Estelle\" href=\"#estelle\">Estelle</a></div>\n";
	$body .= "<div class=\"qui\"><a title=\"Lamine\" href=\"#lamine\">Lamine</a></div>\n";
	$body .= "<div class=\"qui\"><a title=\"$mariageCasamance\" href=\"#mariageCasamance\">$mariageCasamance</a></div>\n";
	$body .= "<div class=\"qui\"><a title=\"$mariageCH\" href=\"#mariageCH\">$mariageCH</a></div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "<div class=\"abstract\">$abstract</div>\n";
//
	//// ESTELLE
	$body .= "<h2 id=\"estelle\" class=\"el\">Estelle</h2>\n";
	$body .= "<p class=\"el\">$estelle</p>\n";
	$body .= "<div class=\"csstab64_table\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= "<img class=\"estelle\" alt=\"Estelle\" title=\"Estelle\" src=\"pictures/divers/Estelle.jpg\" />\n";
	$body .= "</div>\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= $cvestelle;
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
//
	//// LAMINE
	$body .= "<h2 id=\"lamine\" class=\"el\">Lamine</h2>\n";
	$body .= "<p class=\"el\">$lamine</p>\n";
	$body .= "<div class=\"csstab64_table\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= $cvlamine;
	$body .= "</div>\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= "<img class=\"lamine\" alt=\"Lamine\" title=\"Lamine\" src=\"pictures/divers/Lamine.jpg\" />\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
//
	//// CASAMANCE
	$body .= "<h2 id=\"mariageCasamance\" class=\"el\">$mariageCasamance</h2>\n";
	$body .= "<p class=\"el\">$mCas1</p>\n";
	$body .= "<p class=\"el\">$mCas2</p>\n";
	$body .= "<div class=\"mCas\">\n";
	$body .= "<div class=\"csstab64_table\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= "<img class=\"mCas\" alt=\"$mariageCasamance\" title=\"$mariageCasamance\" src=\"pictures/divers/mariage1.jpg\" />\n";
	$body .= "</div>\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= "<img class=\"mCas\" alt=\"$mariageCasamance\" title=\"$mariageCasamance\" src=\"pictures/divers/mariage2.jpg\" />\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
//
	//// SUISSE
	$body .= "<h2 id=\"mariageCH\" class=\"el\">$mariageCH</h2>\n";
	$body .= "<div class=\"mCH\">\n";
	$body .= "<div class=\"csstab64_table\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= "<img class=\"mCH1\" alt=\"$mariageCH\" title=\"$mariageCH\" src=\"pictures/divers/mariage3.jpg\" />\n";
	$body .= "</div>\n";
	$body .= "<div class=\"csstab64_cell\">\n";
	$body .= "<p class=\"el\">$mCH1</p>\n";
	$body .= "<p class=\"el\">$mCH2</p>\n";
	$body .= "<div class=\"center\">\n";
	$body .= "<img class=\"mCH2\" alt=\"$mariageCH\" title=\"$mariageCH\" src=\"pictures/divers/mariage4.jpg\" />\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "<p class=\"el bol\">&laquo;&nbsp;${proverbe}&nbsp;&raquo;</p>\n";
	$body .= "<p class=\"el rgh\">$legende</p>\n";
//


//$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";


$page->show($body);
unset($page);
?>
