<?php
/*** Created: Sun 2014-09-21 14:44:11 CEST
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
$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Su&ntilde;uy portale";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Nna portale lu";
} else {
	$page_title = "Albums photos";
}

$albums = $page->DB_QueryManage("SELECT * FROM `albums` ORDER BY `id` ASC");


$page->CSS_ppJump();
$page->CSS_ppWing();
$page->CSS_Push("photos");

$body = "";
$args = new stdClass();
$args->rootpage = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



/* table */
$body .= "<div class=\"albums\">\n";
$body .= "<div class=\"csstab64_table\">\n";
$body .= "<div class=\"csstab64_row\">\n";
$k = 0;
$max = 6;
while($entry = $albums->fetch_object()) {
	$albid = $entry->id;
	$albtitle = $entry->title;
	$body .= "<div class=\"csstab64_cell\">\n";
	if($entry->picid != "NULL" && $entry->picid != "") {
		$pics = $page->DB_QueryManage("SELECT * FROM `photos` WHERE `id` = " . $entry->picid);
		if($pics->num_rows > 0) {
			$pic = $pics->fetch_object();
			$picname = $pic->name;
			$picpath = "pictures/album$albid/$picname";
			$body .= "<div class=\"thumb\">\n";
			$body .= "<a href=\"photos_collection.php?id=$albid\">\n";
			$body .= "<img class=\"thumb\" title=\"$albtitle\" alt=\"$albtitle\" src=\"../functions_local/thumb.php?picpath=$picpath\" />\n";
			$body .= "</a>\n";
			$body .= "</div>\n";
		}
		$pics->close();
	}
	$body .= "<div class=\"name\"><a href=\"photos_collection.php?id=$albid\" title=\"$albtitle\">$albtitle</a></div>\n";
	$body .= "</div>\n";
	if($k == $max-1) {
		$k = 0;
		$body .= "</div>\n";
		$body .= "<div class=\"csstab64_row\">\n";
	} else {
		++$k;
	}
}
$albums->close();
$body .= "</div>\n";
/*if($page->UserIsAdmin()) {
	$body .= "<div class=\"csstab64_row\">\n";
	$body .= "<div class=\"csstab64_cell special\">\n";
	$body .= "<a href=\"photos_collection.php?id=0\" title=\"Quelques nouvelles de Suisse\">Quelques nouvelles<br />de Suisse</a>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
} */
$body .= "</div>\n";
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
