<?php
/*** Created: Tue 2014-09-30 14:07:26 CEST
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/findlang.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();


if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Leeb";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Talingho";
} else {
	$page_title = "Contes";
}



$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("contes");

$body = "";
$gohome = new stdClass();
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



$body .= "<div class=\"wide\">\n";
$body .= "<div class=\"lhead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"chead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"rhead\">\n";
if($page->UserIsAdmin()) {
	$body .= "<a href=\"contes_insert.php\" title=\"Ajouter un conte\">Ajouter un conte</a>\n";
}
$body .= "</div>\n";
$body .= "</div>\n";

$query = $page->DB_QueryManage("SELECT * FROM `tales` ORDER BY `id` ASC");
if($query->num_rows > 0) {
	$body .= "<div class=\"csstab64_table contes\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
	//
	$max = 5;
	$n = 0;
	while($un = $query->fetch_object()) {
		$id = $un->id;
		$body .= "<div class=\"csstab64_cell\">\n";
		$titlefrench  = $un->titlefrench;
		$titlewolof   = $un->titlewolof;
		$titlemanding = $un->titlemanding;
		$title = GetBestLang($page, $titlefrench, $titlewolof, $titlemanding, "NODIV");
		$pic = $un->picture;
		if($pic != "") {
			$picpath = "pictures/contes/$pic";
			$body .= "<div class=\"contespic\">\n";
			$body .= "<a href=\"contes_display.php?id=$id\">\n";
			$body .= "<img alt=\"$title\" title=\"$title\" src=\"../../functions_local/thumb.php?picpath=$picpath\" />\n";
			$body .= "</a>\n";
			$body .= "</div>\n";
		}
		$body .= "<div class=\"contestitle\">\n";
		$body .= "<a href=\"contes_display.php?id=$id\" title=\"$title\">\n";
		$body .= "$title\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
		if($n < $max) {
			$n++;
		} else {
			$n = 0;
			$body .= "</div>\n";
			$body .= "<div class=\"csstab64_row\">\n";
		}
	}
	$body .= "</div>\n";
	$body .= "</div>\n";
} else {
	$body .= "<div id=\"warning\">D&eacute;sol&eacute;, il n&#039;y a pas encore de contes...</div>\n";
}
$query->close();


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
