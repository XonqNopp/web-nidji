<?php
/*** Created: Thu 2014-09-18 16:37:30 CEST
 ***
 *** TODO:
 ***
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);


//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
	$page_title = "Nidji - souffle mandingue: infos membres";
	$and = "et";
	$goto = "Aller &agrave;";
	$comite = "Comit&eacute;";
	$founders = "Membres fondateurs";
	$president = "Pr&eacute;sidente";
	$vice = "Vice-pr&eacute;sidente";
	$treasure = "Caissi&egrave;re";
	$scribe = "Secr&eacute;taire";
	$comiteother = "Membre";
	$master = "Webmaster";
	$membreship = "Devenir membre";
	$active_membre = "Membre actif";
	$support_membre = "Membre de soutien";
	$from = "d&egrave;s";
	$CHF = "CHF&nbsp;";
	$peryear = "par ann&eacute;e";
	$WLHFMF = "et des coups de main lors des &eacute;v&egrave;nements";
	$dwarfs = "apprenti, &eacute;tudiants, AVS";
	$gifts = "Dons";
	$ebanking = "Virement";
	$falls = "Versement";
	$for = "Pour";
	$favorto = "En faveur de";
	$contacts = "Contacts";
	$Switzerland = "Suisse";
	$statuts = "Statuts";
	$statuts_pdf = "En pdf ici";
//}

$comite_founders = "<b>$founders:</b>&nbsp;";
$comite_president = "<b>$president:</b>&nbsp;";
$comite_vice = "<b>$vice:</b>&nbsp;";
$comite_treasure = "<b>$treasure:</b>&nbsp;";
$comite_scribe = "<b>$scribe:</b>&nbsp;";
$comite_other = "<b>$comiteother:</b>&nbsp;";

$who_founders  = "Estelle $and Lamine Kont&eacute;";
$who_president = "Jo&euml;lle Carron";
$who_vice      = "Sophie Bender";
$who_treasure  = "Anne-Laure Induni";
$who_scribe    = "Lorianne Sassi";
$who_others    = array("St&eacute;phanie Reichenbach", "Micheline Gillioz", "Jean-Bernard Gillioz");

$contact_master = "<b>$master:</b>&nbsp;";
$who_master = "Ga&euml;l Induni";

$active_display = "<b>$active_membre:</b>&nbsp;";
$support_display = "<b>$support_membre:</b>&nbsp;";

$IBAN = "CH59&nbsp;8057&nbsp;2000&nbsp;0100&nbsp;2715&nbsp;9";


$page->CSS_ppJump();
$page->CSS_ppWing();
$page->CSS_Push("index");

$body = "";
$body .= "<div class=\"AlmostWidth\">\n";
$args = new stdClass();
$args->rootpage = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();


$body .= "<div class=\"wide\">\n";
//
	/*** Left column ***/
	$body .= "<div class=\"membre_col\">\n";
		/*** Comite ***/
		$body .= "<h2 id=\"comite\">$comite</h2>\n";
		$body .= "<div><ul>\n";
		$body .= "<li>$comite_founders$who_founders</li>\n";
		$body .= "<li>$comite_president$who_president</li>\n";
		$body .= "<li>$comite_vice$who_vice</li>\n";
		$body .= "<li>$comite_treasure$who_treasure</li>\n";
		$body .= "<li>$comite_scribe$who_scribe</li>\n";
		foreach($who_others as $other) {
			$body .= "<li>$comite_other$other</li>\n";
		}
		$body .= "</ul></div>\n";
	//
		/*** Statuts ***/
		$body .= "<h2 id=\"statuts\">$statuts</h2>\n";
		$body .= "<a target=\"_blank\" href=\"../pdfs/statuts.pdf\">$statuts_pdf</a>.\n";
	//
		/*** Contacts ***/
		$body .= "<h2 id=\"mail\">$contacts</h2>\n";
		$body .= "<div>Nidji - souffle mandingue<br/>\n";
		$body .= "St&eacute;phanie Reichenbach-Milone<br/>\n";
		$body .= "Rue de la Cotzette 1<br/>\n";
		$body .= "CH-1950 Sion<br/>\n";
		$body .= "$Switzerland</div>\n";
		$body .= "<div><span>nidji.mandingue</span><span>&nbsp;at&nbsp;</span><span>gmail.com</span></div>\n";
		$body .= "<div>$contact_master$who_master</div>\n";
	$body .= "</div>\n";
//
	/*** Right column ***/
	$body .= "<div class=\"membre_col\">\n";
		/*** Membreship ***/
		$body .= "<h2 id=\"moneymoney\">$membreship</h2>\n";
		$body .= "<div><ul>\n";
		$body .= "<li>$active_display$from ${CHF}20.- $peryear $WLHFMF</li>\n";
		$body .= "<li>$support_display$from ${CHF}40.- $peryear<br/>\n";
		$body .= "($dwarfs&nbsp;: ${CHF}20.- $peryear)</li>\n";
		$body .= "</ul></div>\n";
	//
		/*** Gifts ***/
		$body .= "<h2 id=\"bank\">$gifts</h2>\n";
		$body .= "<h3>$ebanking</h3>\n";
		$body .= "<div>IBAN: $IBAN</div>\n";
		$body .= "<h3>$falls</h3>\n";
		$body .= "<div><p><b>$for</b><br/>\n";
		$body .= "19-82-4<br/>\n";
		$body .= "Banque Raiffeisen Sion et R&eacute;gion<br/>\n";
		$body .= "1950 Sion</p>\n";
		$body .= "<p><b>$favorto</b><br/>\n";
		$body .= "Association \"NIDJI - Souffle mandingue\"<br/>\n";
		$body .= "Route Champ Bonjard 1<br/>\n";
		$body .= "1782 Belfaux<br/>\n";
		$body .= "IBAN&nbsp;: $IBAN</p>\n";
		$body .= "</div>\n";
	$body .= "</div>\n";
//
$body .= "</div>\n";
$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
