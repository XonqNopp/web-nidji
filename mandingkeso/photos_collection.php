<?php
/*** Created: Sun 2014-09-21 15:15:39 CEST
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/GetComments.php");
require("{$funcpath}_local/findlang.php");

if(!isset($_GET["id"])) {
	header("Location: photos_albums.php");
	exit;
}

$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$sorry = "D&eacute;sol&eacute;, il n&#039;y a pas encore de photos dans cet album.";
	$addcom = "Dolli yobbante";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$sorry = "D&eacute;sol&eacute;, il n&#039;y a pas encore de photos dans cet album.";
	$addcom = "Kuno kafu";
} else {
	$sorry = "D&eacute;sol&eacute;, il n&#039;y a pas encore de photos dans cet album.";
	$addcom = "Ajouter un commentaire";
}


$gohome = new stdClass();
$gohome->page = "photos_albums";
$gohome->rootpage = "..";
$gohome->next_title = "";


$id = $_GET["id"];
$zero = false;
if( $id == 0 ) {
	notallowed();
	$zero = true;
}
$check = $page->DB_QueryManage("SELECT * FROM `albums` ORDER BY `id` ASC");
$test = true;
while($c = $check->fetch_object() ) {
	if($id != 0) {
		if($c->id == $id) {
			$test = false;
		}
		if($c->id != $id && $test) {
			$gohome->previous_id = $c->id;
			$gohome->previous_title = $c->title;
		} elseif($gohome->next_title == "" && $c->id != $id && !$test) {
			$gohome->next_id = $c->id;
			$gohome->next_title = $c->title;
		}
	} else {
		$gohome->previous_id = $c->id;
		$gohome->previous_title = $c->title;
	}
}
/*
if(!$test && $plus == "" && $page->UserIsAdmin()) {
	$gohome->next_id = 0;
	$gohome->next_title = "Quelques nouvelles de Suisse";
}
 */
$check -> close();
/*
if($zero) {
	$alid = "0";
	$altitle = "Quelques nouvelles de Suisse";
	$french = "Voici quelques nouvelles de Suisse, du Valais, des amis et des Xonq Nopp...";
} else {
 */
	$thealbum = $page->DB_IdManage("SELECT * FROM `albums` WHERE `id` = ?", $id);
	$thealbum->bind_result($id, $altitle, $picid, $french, $wolof, $manding);
	$thealbum->fetch();
	$thealbum->close();
	$alid = $id;
	$page_title = $altitle;
//}
$sort = "ASC";
if($alid == "0") {
	$query = "SELECT * FROM `swissalbum` ORDER BY `date` $sort, `time` $sort";
} else {
	$query = "SELECT * FROM `photos` WHERE `album` = '$alid' ORDER BY `date` $sort, `time` $sort";
}
$album = $page->DB_QueryManage($query);



$page->CSS_ppJump();
$page->CSS_ppWing();
$page->CSS_Push("photos");

$body = "";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



/* admin */
/*
if(($page->UserIsAdmin() && $alid != 0) || $page->UserIsSuper()) {
	$body .= "<div class=\"albumadmin\">\n";
	$body .= "<a href=\"album_insert.php?id=$id\" title=\"Modifier les informations de cet album\">Modifier les informations de cet album</a><br />\n";
	$body .= "<a href=\"album_insert.php\" title=\"Ajouter un album\">Ajouter un album</a>\n";
	$body .= "</div>\n";
	$body .= "<div class=\"photoadmin\"><a href=\"photos_insert.php?album=$alid\" title=\"Ajouter une photo\">Ajouter une photo</a></div>\n";
}
 */
/* about */
if($alid == "0") {
	$wolof = "";
	$manding = "";
}
$body .= GetBestLang($page, $french, $wolof, $manding, "about");
/* display */
$k = 0;
$max = 5;
if($album->num_rows == 0) {
	$body .= "<div class=\"warning\">$sorry</div>\n";
} else {
	$body .= "<div class=\"album\">\n";
	$body .= "<div class=\"csstab64_table\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
	while($tof = $album->fetch_object()) {
		$id = $tof->id;
		$pic = $tof->name;
		$title = $tof->title;
		$swiss = "";
		/*
		if($zero) {
			$swiss = "&amp;ch";
		}
		 */
		$body .= "<div class=\"csstab64_cell albumcell\">\n";
		$body .= "<div class=\"albumthumb\">\n";
		$body .= "<a href=\"photos_display.php?id=$id$swiss\">";
		$picpath = "pictures/album$alid/$pic";
		// Be careful, here the images will be sent to the browser !!! You must already have sent the previous content.
		$body .= "<img class=\"albumthumb\" title=\"$title\" alt=\"$title\" src=\"../functions_local/thumb.php?picpath=$picpath\" />";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "<div class=\"thumbname\"><a href=\"photos_display.php?id=$id$swiss\" title=\"$title\">$title</a></div>\n";
		$body .= "</div>\n";
		if($k < $max) {
			++$k;
		} else {
			$k = 0;
			$body .= "</div>\n";
			$body .= "<div class=\"csstab64_row\">\n";
		}
	}
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
}
$album -> close();

/* comments */
$com = new stdClass();
$com->css = "album";
$com->path = "..";
$body .= GetComments($page, $alid, "album", $com);

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
