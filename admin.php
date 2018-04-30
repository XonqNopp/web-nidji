<?php
/*** Created: Fri 2014-12-05 07:43:16 CET
 ***
 *** TODO:
 ***
 ***/
require("functions/classPage.php");
$funcpath = "functions";
$page = new PhPage();
$page->NotAllowed();
//$page->initDB();
//$page->LogLevelUp(6);

$body = "";
$body .= $page->GoHome();
$body .= $page->SetTitle("Administration du site");
$page->HotBooty();

$body .= "<div>\n";
$body .= "<ul>\n";
$body .= "<li><a href=\"nobot.php\">Liste des questions anti-bot</a></li>\n";
if($page->UserIsSuper()) {
	$body .= "<li><a href=\"nobot_insert.php\">Ajouter une question anti-bot</a></li>\n";
	//$body .= "<li><a href=\"counter2stats.php\">counter2stats</a> (<a href=\"counter2stats.php?go=gadget\">run</a>)</li>\n";
}
$body .= "</ul>\n";
$body .= "</div>\n";


$page->show($body);
unset($page);
?>
