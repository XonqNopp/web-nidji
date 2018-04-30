<?php
/*** Created: Sat 2014-09-27 10:57:01 CEST
 ***
 *** TODO:
 ***
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
require("${funcpath}_local/agendacatpub.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

$UserIsAdmin = $page->UserIsAdmin();

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Que font les Kont&eacute;&nbsp;?";
	$sub = "Si vous d&eacute;sirez d&eacute;couvrir Manding k&eacute;so en images, en musique ou en contes... &agrave; vos agendas!";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Que font les Kont&eacute;&nbsp;?";
	$sub = "Si vous d&eacute;sirez d&eacute;couvrir Manding k&eacute;so en images, en musique ou en contes... &agrave; vos agendas!";
} else {
	$page_title = "Que font les Kont&eacute;&nbsp;?";
	$sub = "Si vous d&eacute;sirez d&eacute;couvrir Manding k&eacute;so en images, en musique ou en contes... &agrave; vos agendas!";
}


function AgendaDisplay(PhPage $page, $agenda_events) {
	$back = "";
	$UserIsAdmin = $page->UserIsAdmin();
	$this_year = $page->GetNow()->year;
	while($a = $agenda_events->fetch_object()) {
		$id          = $a->id;
		$title       = $a->title;
		$date        = $page->ConvertDate($a->date);
		$location    = $a->location;
		$gloc = preg_replace("/ *\([^)]+\) */", "", $location);
		$gloc = preg_replace("/ /", "+", $gloc);
		$category    = $a->category;
		$public      = $a->audience;
		$description = $page->SQL2URL($a->description);
		$day = $date->day;
		$month = $page->Months($date->month);
		$year = "";
		if($date->year != $this_year) {
			$year = " " . $date->year;
		}
		$this_category = get_cat_full($category);
		$this_public = get_public_full($public);

		$back .= "<div class=\"agenda_entry agenda_$category agenda_$public\">\n";
		$back .= "<div class=\"agenda_title agenda_title_$category agenda_title_$public\">\n";
		$back .= "<div class=\"agenda_infos agenda_infos_$category agenda_infos_$public\">\n";
		$back .= "<div>$day $month$year</div>\n";
		$back .= "<div><a href=\"http://maps.google.com/?q=$gloc\" target=\"_blank\">$location</a></div>\n";
		if($UserIsAdmin) {
			$back .= "<div><span class=\"agenda_edit\"><a href=\"agenda_insert.php?id=$id\" title=\"modifier\">(modifier)</a></span></div>";
		}
		$back .= "</div>\n";
		$back .= "<div class=\"agendaH2\">\n";
		$back .= "<h2 class=\"agenda_entry agenda_$category agenda_$public\">$title</h2>\n";
		$back .= "</div>\n";
		$back .= "</div>\n";
		$back .= "<div class=\"agenda_entry_body\">\n";
		$back .= "<div class=\"agenda_catpub\">\n";
		$back .= " ($this_category, $this_public)\n";
		$back .= "</div>\n";
		if($description != "") {
			$back .= "<div class=\"agenda_description\">\n";
			$back .= "$description\n";
			$back .= "</div>\n";
		}
		$back .= "</div>\n";
		$back .= "</div>\n";
		unset($description,$title);
	}
	return $back;
}

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
$body .= "<img src=\"../../pictures/divers/agendaHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= "$sub\n";
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= "<div class=\"lhead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"chead\">\n";
$body .= "</div>\n";
$body .= "<div class=\"rhead\">\n";
if($UserIsAdmin) {
	$body .= "<a href=\"agenda_insert.php\" title=\"Ajouter\">Ajouter un &eacute;v&egrave;nement</a>\n";
}
$body .= "</div>\n";
$body .= "</div>\n";

$body .= "<div class=\"agenda_main\">\n";
$this_year = $page->GetNow()->year;
$agenda_next = $page->DB_QueryManage("SELECT * FROM `agenda` HAVING DATEDIFF(`date`,CURDATE()) >= 0 ORDER BY `date`  ASC, `id`  ASC");
$agenda_past = $page->DB_QueryManage("SELECT * FROM `agenda` HAVING DATEDIFF(`date`,CURDATE()) <  0 ORDER BY `date` DESC, `id` DESC");
if($agenda_next->num_rows == 0 && $agenda_past->num_rows == 0) {
	$body .= "D&eacute;sol&eacute;, il n'y a aucun &eacute;v&egrave;nement dans l'agenda pour le moment...\n";
} else {
	$body .= "<div class=\"agenda_body\">\n";
	if($agenda_next->num_rows > 0) {
		$body .= AgendaDisplay($page, $agenda_next);
		$body .= "</div>\n";
	}
	if($agenda_past->num_rows > 0) {
		$body .= "<h3>&Eacute;v&egrave;nements pass&eacute;s</h3>\n";
		$body .= "<div class=\"agenda_body\">\n";
		$body .= AgendaDisplay($page, $agenda_past);
		$body .= "</div>\n";
	}
	$body .= "</div>\n";
}
$agenda_next->close();
$agenda_past->close();
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
