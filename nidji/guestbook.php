<?php
/*** Created: Sat 2014-09-27 09:04:54 CEST
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
	$page_title = "Livre d&#039;or";
	$new = "Dolli yobbante";
	$sub = "Vos impressions, vos suggestions ainsi que vos messages d'encouragements sont les bienvenus ici&nbsp;!";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Livre d&#039;or";
	$new = "Kuno kafu";
	$sub = "Vos impressions, vos suggestions ainsi que vos messages d'encouragements sont les bienvenus ici&nbsp;!";
} else {
	$page_title = "Livre d&#039;or";
	$new = "Ajouter un message";
	$sub = "Vos impressions, vos suggestions ainsi que vos messages d'encouragements sont les bienvenus ici&nbsp;!";
}

$page->CSS_ppJump();
$page->CSS_ppWing();
$page->CSS_Push("index");
$page->SetTitle($page_title);

$body = "";
$page->HotBooty();

$gohome = new stdClass();
$gohome->rootpage = "..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();



$body .= "<div class=\"headbanner\">\n";
$body .= "<div class=\"imgheader\">\n";
$body .= "<img src=\"../pictures/divers/guestbookHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= $sub;
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "<div id=\"newguest\"><a href=\"guestbook_insert.php\" title=\"$new\">$new</a></div>\n";
// Display the guestbook
$results = $page->DB_QueryManage("SELECT * FROM `guestbook` ORDER BY `id` DESC");
$body .= "<div class=\"book\">\n";
if($results->num_rows == 0) {
	$body .= "D&eacute;sol&eacute;, personne n&#039;a encore laiss&eacute; de message...";
} else {
	$body .= "<div class=\"csstab64_table\">\n";
	while($entry = $results->fetch_object()) {
		$al = false;
		$id = $entry->id;
		$author  = $entry->author;
		$place   = $entry->place;
		$comment = $entry->comment;
		$date    = $entry->date;
		$time = substr($entry->time, 0, -3);
		$timestamp = "$date $time";
		$body .= "<div class=\"csstab64_row\">\n";
		$body .= "<div class=\"csstab64_cell book_cell\">\n";
		if($page->UserIsAdmin()) {
			$body .= "<div class=\"guestmodif\"><a href=\"guestbook_insert.php?id=$id\" title=\"Modifier\">Modifier</a></div>\n";
		}
		$body .= "<div class=\"guestauthor\">$author</div>\n";
		if($place != "") {
			$body .= "<div class=\"guestplace\">$place</div>\n";
		}
		$body .= "<div class=\"guestdate\">$timestamp</div>\n";
		$body .= "<div class=\"guestcomment\">$comment</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	}
	$body .= "</div>\n";
}
$results -> close();
$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
