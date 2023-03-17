<?php
/*** Created: Wed 2014-10-01 11:51:53 CEST
 * TODO: add previous and next
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/GetComments.php");
require("{$funcpath}_local/findlang.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);

if(!isset($_GET["id"])) {
	$page->HeaderLocation("contes_collection.php");
}
$id = $_GET["id"];
$page->initDB();
$unconte = $page->DB_IdManage("SELECT * FROM `tales` WHERE `id` = ?", $id);
$unconte->bind_result($id, $date, $picture, $titlefrench, $titlewolof, $titlemanding, $french, $wolof, $manding);
$unconte->fetch();
$unconte->close();
$title = GetBestLang($page, $titlefrench, $titlewolof, $titlemanding, "NODIV");
$conte = GetBestLang($page, $french, $wolof, $manding, "NODIV");



//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
//}



$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("contes");

$body = "";

$gohome = new stdClass();
$gohome->page = "contes_collection";
$gohome->rootpage = "../..";
$check = $page->DB_QueryManage("SELECT * FROM `tales` ORDER BY `id` ASC");
$test = true;
$gohome->next_title = "";
while($c = $check->fetch_object()) {
	if($c->id == $id) {
		$test = false;
	}
	if($c->id != $id && $test) {
		$gohome->previous_id = $c->id;
		$previousfrench  = $c->titlefrench;
		$previouswolof   = $c->titlewolof;
		$previousmanding = $c->titlemanding;
		$previoustitle = GetBestLang($page, $previousfrench, $previouswolof, $previousmanding, "NODIV");
		$gohome->previous_title = $previoustitle;
	} elseif($gohome->next_title == "" && $c->id != $id && !$test) {
		$gohome->next_id = $c->id;
		$nextfrench  = $c->titlefrench;
		$nextwolof   = $c->titlewolof;
		$nextmanding = $c->titlemanding;
		$nexttitle = GetBestLang($page, $nextfrench, $nextwolof, $nextmanding, "NODIV");
		$gohome->next_title = $nexttitle;
	}
}
$check->close();

$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$ta = new stdClass();
$ta->class = "unconte";
$body .= $page->SetTitle($title, $ta);
$page->HotBooty();


$body .= "<div class=\"wide\">\n";
$body .= "<div class=\"lhead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"chead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"rhead\">\n";
if($page->UserIsAdmin()) {
	$adminedit = "Modifier ce conte";
	$adminnew = "Ajouter un conte";
	$body .= "<a href=\"contes_insert.php?id=$id\" title=\"$adminedit\">$adminedit</a><br />\n";
	$body .= "<a href=\"contes_insert.php\" title=\"$adminnew\">$adminnew</a>\n";
}
$body .= "</div>\n";
$body .= "</div>\n";



$body .= "<div class=\"mainconte\">\n";
$body .= "<div class=\"csstab64_table unconte\">\n";
$body .= "<div class=\"csstab64_row\">\n";
$body .= "<div class=\"csstab64_cell\">\n";
if($picture != "" ) {
	$picname = $picture;
	$body .= "<img class=\"conte\" alt=\"$title\" title=\"$title\" src=\"../../pictures/contes/$picname\" />\n";
}
$body .= "</div>\n";
$body .= "<div class=\"csstab64_cell\">$conte</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
/* comments */
$com = new stdClass();
$com->path = "../..";
$body .= GetComments($page, $id, "conte", $com);
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";


$page->show($body);
unset($page);
?>
