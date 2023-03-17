<?php
/*** Created: Sun 2014-09-21 12:43:04 CEST
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Mots d'encouragements";
	$sub = "Vos messages et vos pens&eacute;es ont port&eacute; nos pas.";
	$new = "Dolli yobbante";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Mots d'encouragements";
	$sub = "Vos messages et vos pens&eacute;es ont port&eacute; nos pas.";
	$new = "Kuno kafu";
} else {
	$page_title = "Mots d'encouragements";
	$sub = "Vos messages et vos pens&eacute;es ont port&eacute; nos pas.";
	$new = "Ajouter un message";
}

$results = $page->DB_QueryManage("SELECT * FROM `cheers` ORDER BY `id` DESC");

$page->SetTitle($page_title);
$page->CSS_ppJump();
$page->CSS_ppWing();

$body = "";
$page->HotBooty();

$args = new stdClass();
$args->rootpage = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();



$body .= "<div class=\"headbanner\">\n";
$body .= "<div class=\"imgheader\">\n";
$body .= "<img src=\"../pictures/divers/cheersHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= $sub;
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
$body .= '<div class="book">' . "\n";
if($results->num_rows == 0) {
	$body .= "D&eacute;sol&eacute;, personne n&#039;a encore laiss&eacute; de message...";
} else {
	$body .= "<div class=\"csstab64_table\">\n";
	while($entry = $results->fetch_object()) {
		$id = $entry->id;
		$author = $entry->author;
		$body .= "<div class=\"csstab64_row\">\n";
		$body .= "<div class=\"csstab64_cell\">\n";
		$body .= "<div class=\"guestauthor\">$author</div>\n";
		if($entry->place != "") {
			$body .= "<div class=\"guestplace\">$entry->place</div>\n";
		}
		$body .= "<div class=\"guestdate\">$entry->date " . substr($entry->time, 0, -3) . "</div>\n";
		$body .= "<div class=\"guestcomment\">$entry->comment</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n"; 
	}
	$body .= "</div>\n";
}
$results->close();
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
