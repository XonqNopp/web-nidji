<?php
/*** Created: Tue 2014-09-30 07:58:00 CEST
 ***
 *** TODO:
 ***
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
require("${funcpath}_local/findlang.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Proverbes";
	$sub = "Les &ldquo;koumakoto&rdquo; sont des paroles qui ont des dessous et qui &eacute;duquent";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Proverbes";
	$sub = "Les &ldquo;koumakoto&rdquo; sont des paroles qui ont des dessous et qui &eacute;duquent";
} else {
	$page_title = "Proverbes";
	$sub = "Les &ldquo;koumakoto&rdquo; sont des paroles qui ont des dessous et qui &eacute;duquent";
}

$UserIsAdmin = $page->UserIsAdmin();


$page->SetTitle($page_title);
$page->CSS_ppJump(2);
$page->CSS_ppWing(2);

$body = "";
$page->HotBooty();

$gohome = new stdClass();
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();




$body .= "<div class=\"headbanner\">\n";
$body .= "<div class=\"imgheader\">\n";
$body .= "<img src=\"../../pictures/divers/proverbesHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= "$sub\n";
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
if($UserIsAdmin) {
	$body .= "<div class=\"proverb_add\"><a href=\"proverbes_insert.php\" title=\"Nouveau\">Ajouter un proverbe</a></div>\n";
}
$body .= "<div class=\"proverb_collection\">\n";
$c = 0;
$collection = $page->DB_QueryManage("SELECT * FROM `proverbs` ORDER BY RAND()");
if($collection->num_rows == 0) {
	$body .= "D&eacute;sol&eacute;, il n'y a pas encore de proverbes...\n";
} else {
	while($p = $collection->fetch_object()) {
		$c++;
		$id = $p->id;
		$french  = $p->french;
		$wolof   = $p->wolof;
		$manding = $p->manding;
		$proverb = GetBestLang($page, $french, $wolof, $manding, "NODIV");
		$source_fr = $p->source_fr;
		$source_wo = $p->source_wo;
		$source_md = $p->source_md;
		$source = GetBestLang($page, $source_fr, $source_wo, $source_md, "NODIV");
		$body .= "<div class=\"proverb ";
		if($c % 2 == 0) {
			$body .= "proverb_even";
		} else {
			$body .= "proverb_odd";
		}
		$body .= "\">\n";
		$body .= "<div class=\"proverb_txt\">\n";
		if($UserIsAdmin) {
			$body .= "<span class=\"proverb_edit\"><a href=\"proverbes_insert.php?id=$id\" title=\"Modifier\">(Modifier)</a></span>\n";
		}
		$body .= "$proverb\n";
		$body .= "</div>\n";
		if($source != "") {
			$body .= "<div class=\"proverb_src\">$source</div>\n";
		}
		$body .= "</div>\n";
	}
}
$collection->close();

$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
