<?php
/*** Created: Mon 2014-09-22 12:36:05 CEST
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/findlang.php");
require("{$funcpath}_local/GetComments.php");

if(!isset($_GET["id"])) {
	header("Location: photos_albums.php");
	exit;
}

$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

$gohome = new stdClass();
$gohome->rootpage = "..";
$gohome->page = "photos_collection";


$id = $_GET["id"];
$zero = false;
$table_name = "photos";
//if(isset($_GET["ch"])) {
	//$NAargs = new stdClass();
	//$NAargs->url = "photos_collection.php";
	//$page->NotAllowed($NAargs);
	//$zero = true;
	//$table_name = "swissalbum";
//}
$query = "SELECT * FROM `$table_name` WHERE `id` = ?";
$q = $page->DB_IdManage($query, $id);
$q->bind_result($id, $date, $time, $place, $album, $name, $title, $french, $wolof, $manding);
$q->fetch();
$q->close();
//if($zero) {
	//$album = 0;
//}
$gohome->id = $album;
$getalbum = $page->DB_QueryManage("SELECT `title` FROM `albums` WHERE `id` = $album");
$albumname = $getalbum->fetch_object();
$getalbum->close();
$gohome->title = $albumname->title;

$picname = "../pictures/album$album/$name";

$css = "";
if(file_exists($picname)) {
	$size = getimagesize($picname);
	$width = $size[0];
	$height = $size[1];
	$ratio = $width / $height;
	if($ratio < 1) {
		$css = "portrait";
	} else {
		$css = "landscape";
	}
}

// date and time
$datetime = $page->ConvertDate("$date $time", true, true);
$year     = $datetime->year;
$month    = $page->Months($datetime->month);
$day      = $datetime->day;
$hour     = $datetime->hour;
$minute   = $datetime->minute;
/** next and previous **/
$sort = "ASC";
if($zero) {
	$gocheck = "SELECT * FROM `swissalbum` ORDER BY `date` $sort, `time` $sort";
} else {
	$gocheck = "SELECT * FROM `photos` WHERE `album` = '$album' ORDER BY `date` $sort, `time` $sort";
}
$check = $page->DB_QueryManage($gocheck);
$gohome->next_id = 0;
$test = true;
while($c = $check->fetch_object() ) {
	if($c->id == $id) {
		$test = false;
	}
	if($c->id != $id && $test) {
		$gohome->previous_id = $c->id;
		$gohome->previous_title = $c->title;
	} elseif($gohome->next_id == 0 && $c->id != $id && !$test) {
		$gohome->next_id = $c->id;
		$gohome->next_title = $c->title;
		break;
	}
}
$check->close();


$page->CSS_ppJump();
$page->CSS_ppWing();
$page->CSS_Push("photos");

$body = "";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= "<div id=\"thebody\">\n";
$ta = new stdClass();
$ta->id = "disp";
$body .= $page->SetTitle($title, $ta);
$page->HotBooty();



/* admin */
/*
if(($page->UserIsAdmin() && !$zero) || $page->UserIsSuper()) {
	$body .= "<div id=\"albumadmin\">\n";
	$body .= "<a href=\"album_insert.php?id=$album\" title=\"Modifier les informations de cet album\">Modifier les informations de cet album</a><br />\n";
	$body .= "<a href=\"album_insert.php\" title=\"Ajouter un album\">Ajouter un album</a>\n";
	$body .= "</div>\n";
	$body .= "<div id=\"photoadmin\">\n";
	$ed = "";
	if($zero) {
		$ed = "&amp;ch";
	}
	$body .= "<a href=\"photos_insert.php?id=$id$ed\" title=\"Modifier les informations de cette photo\">Modifier les informations de cette photo</a><br />\n";
	$body .= "<a href=\"photos_insert.php?album=$album\" title=\"Ajouter une photo\">Ajouter une photo</a>\n";
	$body .= "</div>\n";
}
 */
/* title */
$body .= "<div class=\"csstab64_table\">\n";
$body .= "<div class=\"csstab64_row\">\n";
/*** TABLE 124 128 136 138 171 ***/
$body .= "<div class=\"csstab64_cell dispimgleft\">\n";
$body .= "<a href=\"$picname\">\n";
$body .= "<img class=\"dispimg\" title=\"$title\" alt=\"$title\" src=\"$picname\" />\n";
$body .= "</a>\n";
$body .= "</div>\n";
$body .= "<div class=\"csstab64_cell dispimgright\">\n";
/* date and time */
$body .= "<div class=\"disptime\">\n";
$body .= "{$hour}h$minute, le $day $month $year\n";
$body .= "</div>\n";
/* place */
if($place != "") {
	$body .= "<div class=\"dispplace\">\n";
	$body .= "$place\n";
	$body .= "</div>\n";
}
/* legend */
$body .= GetBestLang($page, $french, $wolof, $manding, "displegend");
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
/* comments */
$body .= "<div class=\"thedispcom\">\n";
$ttyp = "photo";
if($zero) {
	$ttyp .= "ch";
}
$com = new stdClass();
$com->path = "..";
$com->css = "disp";
$body .= GetComments($page, $id, $ttyp, $com);
$body .= "</div>\n";
$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
