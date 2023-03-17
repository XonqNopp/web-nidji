<?php
/*** Created: Tue 2014-09-30 17:15:27 CEST
 * TODO: Add previous and next in gohome
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/findlang.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

if(!isset($_GET["person"])) {
	$page->HeaderLocation("rencontres_collection.php");
}
$person = $_GET["person"];

if($page->CheckSessionLang($page->GetWolof())) {
} elseif($page->CheckSessionLang($page->GetMandinka())) {
} else {
}

$UserIsAdmin = $page->UserIsAdmin();

$gohome = new stdClass();
$gohome->page = "rencontres_collection";
$gohome->rootpage = "../..";


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("rencontres");

$body = "";

$body .= $page->GoHome($gohome);
$body .= $page->Languages();


$getpic = $page->DB_IdManage("SELECT * FROM `meetings` WHERE `id` = ?", $person);
$getpic->bind_result($person, $date, $author, $place, $picid, $french, $wolof, $manding);
$getpic->fetch();
$getpic->close();
if($place != "") {
	$place = " ($place)";
}
$page_title = "$author$place";
$body .= $page->SetTitle($page_title);

if($UserIsAdmin) {
	$body .= "<div class=\"wide\">\n";
	$body .= "<div class=\"lhead\"></div>\n";
	$body .= "<div class=\"chead\"></div>\n";
	$body .= "<div class=\"rhead\">\n";
	$body .= "<a href=\"rencontres_insert.php?person=$person\" title=\"Nouvelle rencontre\">";
	$body .= "Ajouter une rencontre";
	$body .= "</a>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
}

$page->HotBooty();

/*** PICID ***/
if($picid != "") {
	$picbody = "";
	$photo = $page->DB_IdManage("SELECT * FROM `photos` WHERE `id` = ?", $picid);
	$photo->store_result();
	if($photo->num_rows > 0) {
		$photo->bind_result($picid, $tofdate, $toftime, $tofplace, $tofalbum, $tofname, $toftitle, $toffrench, $tofwolof, $tofmanding);
		$photo->fetch();
		$tofname = $page->SQL2field($tofname);
		$picpath = "pictures/album$tofalbum/$tofname";
		$body .= "<div class=\"unerencontrephoto\">\n";
		$body .= "<a href=\"../../mandingkeso/photos_display.php?id=$picid\">\n";
		$body .= "<img class=\"rencontrespic\" title=\"$toftitle\" alt=\"$toftitle\" src=\"../../functions_local/thumb.php?picpath=$picpath\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
	}
	$photo->close();
}
$meetings = $page->DB_QueryManage("SELECT * FROM `meetings` WHERE `author` = '$author' ORDER BY `id` DESC");
$mbody = "<div class=\"unerencontretable\">\n";;
while($one = $meetings->fetch_object()) {
	$id = $one->id;
	$french  = $one->french;
	$wolof   = $one->wolof;
	$manding = $one->manding;
	$date = $one->date;
	$mbody .= "<div class=\"uneunerencontre\">\n";
	$mbody .= "<div class=\"unerencontredate\">\n";
	if($UserIsAdmin) {
		$mbody .= "<a href=\"rencontres_insert.php?id=$id\" title=\"modifier\">\n";
		$mbody .= "(modifier)\n";
		$mbody .= "</a>\n";
	}
	$mbody .= "$date\n";
	$mbody .= "</div>\n";
	$mbody .= GetBestLang($page, $french, $wolof, $manding, "unerencontrecomment");
	$mbody .= "</div>\n";
}
$meetings->close();
$body .= $mbody;
$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
