<?php
/*** Created: Tue 2014-09-30 11:32:19 CEST
 ***
 *** TODO:
 ***
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Quelques rencontres";
	$sub = "Chaque rencontre ouvre un nouvel horizon.";
	$sorry = "D&eacute;sol&eacute;, il n&#039;y a pas encore de rencontres...";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Quelques rencontres";
	$sub = "Chaque rencontre ouvre un nouvel horizon.";
	$sorry = "D&eacute;sol&eacute;, il n&#039;y a pas encore de rencontres...";
} else {
	$page_title = "Quelques rencontres";
	$sub = "Chaque rencontre ouvre un nouvel horizon.";
	$sorry = "D&eacute;sol&eacute;, il n&#039;y a pas encore de rencontres...";
}


$page->SetTitle($page_title);
$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("rencontres");

$body = "";
$page->HotBooty();

$gohome = new stdClass();
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();


$body .= "<div class=\"headbanner\">\n";
$body .= "<div class=\"imgheader\">\n";
$body .= "<img src=\"../../pictures/divers/rencontresHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= $sub;
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= "<div class=\"lhead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"chead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"rhead\">\n";
if($page->UserIsAdmin()) {
	$body .= "<a href=\"rencontres_insert.php\" title=\"Nouvelle rencontre\">Ajouter une rencontre</a>\n";
}
$body .= "</div>\n";
$body .= "</div>\n";

/*** Lister les auteurs ***/
$getemall = $page->DB_QueryManage("SELECT * FROM `meetings` ORDER BY `id` ASC");

$authors = array();
$places = array();
$pics = array();
$erson = array();

while($one = $getemall->fetch_object()) {
	$author = $one->author;
	if(!in_array($author, $authors)) {
		array_push($authors, $author);
		$person[$author] = $one->id;
		$places[$author] = $one->place;
		$pics[$author] = $one->picid;
	} else {
		if($pics[$author] == "" && $one->picid != "") {
			$pics[$author] = $one->picid;
		}
	}
}
$getemall->close();

/*** Display all the authors ***/
$body .= "<div class=\"lesrencontrestable\">\n";
$body .= "<div class=\"csstab64_table lesrencontres\">\n";
$body .= "<div class=\"csstab64_row\">\n";
$i = 0;
foreach($authors as $a) {
	if( $i == 5 ) {
		$body .= "</div>\n";
		$body .= "<div class=\"csstab64_row\">\n";
		$i = 0;
	}
	$body .= "<div class=\"csstab64_cell\">\n";
	if($pics[$a] != "") {
		$picid = $pics[$a];
		$photo = $page->DB_QueryManage("SELECT * FROM `photos` WHERE `id` = $picid");
		if($photo->num_rows > 0) {
			$tof = $photo->fetch_object();
			$toftitle = $tof->title;
			$picpath = "pictures/album$tof->album/" . $page->SQL2field($tof->name);
			$body .= "<div class=\"lesrencontresphoto\"><a href=\"rencontres_display.php?person=" . $person[$a] . "\"><img class=\"rencontrespic\" title=\"$toftitle\" alt=\"$toftitle\" src=\"../../functions_local/thumb.php?picpath=$picpath\" /></a></div>\n";
		}
		$photo->close();
	}
	$body .= "<div class=\"lesrencontresauthor\">\n";
	$body .= "<a href=\"rencontres_display.php?person=" . $person[$a] . "\" title=\"$a\">$a</a>\n";
	$body .= "</div>\n";
	if($places[$a] != "") {
		$body .= "<div class=\"lesrencontresplace\">\n";
		$body .= "<a href=\"rencontres_display.php?person=" . $person[$a] . "\" title=\"$a\">(" . $places[$a] . ")</a>\n";
		$body .= "</div>\n";
	}
	$body .= "</div>\n";
	$i++;
}
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
