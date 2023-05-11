<?php
/*** Created: Mon 2014-09-29 21:34:46 CEST
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "La Tradition Orale";
	$subtitle = "Deux ans &agrave; l'&eacute;coute des anciens pour mettre en lumi&egrave;re les savoirs ancestraux";
	$contes = "Contes";
	$rencontres = "Rencontres";
	$proverbes = "Proverbes";
	$body_txt = "Arriver dans un village avec l&#039;intention d&#039;interroger les anciens sur leurs traditions sans noix de kola dans nos bagages&nbsp;?... Impensable&nbsp;! Les noix blanches ou ros&eacute;es sont peut-&ecirc;tre tr&egrave;s am&egrave;res mais elles ont pour les mandingues la saveur d&#039;une friandise. Selon eux, leur effet stimulant s&#039;applique aussi &agrave; la parole. Ainsi aucun message, aucune pri&egrave;re ni aucune d&eacute;cision importante ne se formule avant que l&#039;on n&#039;ait effectu&eacute; le partage de la kola.";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "La Tradition Orale";
	$subtitle = "Deux ans &agrave; l'&eacute;coute des anciens pour mettre en lumi&egrave;re les savoirs ancestraux";
	$contes = "Contes";
	$rencontres = "Rencontres";
	$proverbes = "Proverbes";
	$body_txt = "Arriver dans un village avec l&#039;intention d&#039;interroger les anciens sur leurs traditions sans noix de kola dans nos bagages&nbsp;?... Impensable&nbsp;! Les noix blanches ou ros&eacute;es sont peut-&ecirc;tre tr&egrave;s am&egrave;res mais elles ont pour les mandingues la saveur d&#039;une friandise. Selon eux, leur effet stimulant s&#039;applique aussi &agrave; la parole. Ainsi aucun message, aucune pri&egrave;re ni aucune d&eacute;cision importante ne se formule avant que l&#039;on n&#039;ait effectu&eacute; le partage de la kola.";
} else {
	$page_title = "La Tradition Orale";
	$subtitle = "Deux ans &agrave; l'&eacute;coute des anciens pour mettre en lumi&egrave;re les savoirs ancestraux";
	$contes = "Contes";
	$rencontres = "Rencontres";
	$proverbes = "Proverbes";
	$body_txt = "Arriver dans un village avec l&#039;intention d&#039;interroger les anciens sur leurs traditions sans noix de kola dans nos bagages&nbsp;?... Impensable&nbsp;! Les noix blanches ou ros&eacute;es sont peut-&ecirc;tre tr&egrave;s am&egrave;res mais elles ont pour les mandingues la saveur d&#039;une friandise. Selon eux, leur effet stimulant s&#039;applique aussi &agrave; la parole. Ainsi aucun message, aucune pri&egrave;re ni aucune d&eacute;cision importante ne se formule avant que l&#039;on n&#039;ait effectu&eacute; le partage de la kola.";
}


$page->SetTitle($page_title);
$page->CSS_ppJump(2);
$page->CSS_ppWing(2);

$body = "";
$page->HotBooty();

$gohome = new stdClass();
$gohome->page = "..";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();


	//// Header
	$body .= "<div class=\"headbanner\">\n";
	$body .= "<div class=\"imgheader\">\n";
	$body .= "<img class=\"traditionheader\" src=\"../../pictures/divers/traditionHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
	$body .= "</div>\n";
	$body .= "<div class=\"headtxtarea\">\n";
	$body .= "<div class=\"headtxt\">\n";
	$body .= "$subtitle\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
//
	// Main body
	$body .= "<div class=\"csstab64_table maintradition\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
		// Texte
		$body .= "<div class=\"csstab64_cell traditiontxt\">\n";
		$body .= "$body_txt\n";
		$body .= "</div>\n";
	//
		// Links
		$body .= "<div class=\"csstab64_cell traditionlinks\">\n";
		$body .= "<div class=\"csstab64_table\">\n";
			// Proverbes
			$body .= "<div class=\"csstab64_row\">\n";
			$body .= "<div class=\"csstab64_cell fillgap\"></div>\n";
			$body .= "<div class=\"csstab64_cell traditionlink traditionproverbes\">\n";
			$body .= "<a href=\"proverbes.php\" title=\"$proverbes\">$proverbes</a><br />\n";
			$body .= "<a href=\"proverbes.php\" title=\"$proverbes\"><img src=\"../../pictures/divers/proverbes.png\" alt=\"$proverbes\" title=\"$proverbes\" /></a>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		//
			// Rencontres
			$body .= "<div class=\"csstab64_row\">\n";
			$body .= "<div class=\"csstab64_cell traditionlink traditionrencontres\">\n";
			$body .= "<a href=\"rencontres_collection.php\" title=\"$rencontres\">$rencontres</a><br />\n";
			$body .= "<a href=\"rencontres_collection.php\" title=\"$rencontres\"><img src=\"../../pictures/divers/rencontres.png\" alt=\"$rencontres\" title=\"$rencontres\" /></a>\n";
			$body .= "</div>\n";
			$body .= "<div class=\"csstab64_cell fillgap\"></div>\n";
			$body .= "</div>\n";
		//
			// Contes
			$body .= "<div class=\"csstab64_row\">\n";
			$body .= "<div class=\"csstab64_cell fillgap\"></div>\n";
			$body .= "<div class=\"csstab64_cell traditionlink traditioncontes\">\n";
			$body .= "<a href=\"contes_collection.php\" title=\"$contes\">$contes</a><br />\n";
			$body .= "<a href=\"contes_collection.php\" title=\"$contes\"><img src=\"../../pictures/divers/contes.png\" alt=\"$contes\" title=\"$contes\" /></a>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
