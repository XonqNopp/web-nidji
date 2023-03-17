<?php
/*** Created: Mon 2014-09-29 09:31:55 CEST
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
	$page_title = "Press-book";
//}

$UserIsAdmin = $page->UserIsAdmin();


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);

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
if($UserIsAdmin) {
	$body .= "<a href=\"pressbook_insert.php\" title=\"ajouter un article\">ajouter un article</a>\n";
}
$body .= "</div>\n";
$body .= "</div>\n";

$body .= "<div class=\"pressbook_main\">\n";

$articles = $page->DB_QueryManage("SELECT * FROM `pressbook` ORDER BY `date` DESC, `id` DESC");
if($articles->num_rows == 0) {
	$body .= "D&eacute;sol&eacute;, il n'y a encore rien dans le pressbook...";
} else {
	$body .= "<div class=\"csstab64_table\">\n";
	while($a = $articles->fetch_object()) {
			// Fetch DB infos
			$id = $a->id;
			$date = $page->ConvertDate($a->date);
			$filename = $a->file;
			if($filename != "") {
				$file = "../../pictures/pressbook/$filename";
			}
			$text = $page->SQL2URL($a->text);
		//
			// Display
			$body .= "<div class=\"csstab64_row\">\n";
			$body .= "<div class=\"csstab64_cell\">\n";
			if($UserIsAdmin) {
				$body .= "<span class=\"pressbook_edit\"><a href=\"pressbook_insert.php?id=$id\" title=\"Modifier\">(Modifier)</a></span> \n";
			}
			$body .= "<span class=\"pressbook_date\">$date->dateCHtxt</span>\n";
			if($text != "") {
				$body .= "<p>$text</p>\n";
			}
			$body .= "<p><a target=\"_blank\" href=\"$file\" title=\"$filename\">$filename</a></p>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
	}
	$body .= "</div>\n";
}
$articles->close();

$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
