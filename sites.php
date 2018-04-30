<?php
/*** Created: Wed 2014-09-17 20:44:18 CEST
 ***
 *** TODO:
 ***
 ***/
require("functions/classPage.php");
$funcpath = "functions";
$page = new PhPage();
//$page->LogLevelUp(6);

$page->CSS_Push("index");

$body = "";
$body .= $page->GoHome();
$body .= $page->SetTitle("Sites amis");
$page->HotBooty();

$body .= "<div>\n";
$body .= "<p>Si l'envie vous prend, voici quelques liens vers nos amis:</p>\n";
$body .= "<ul>\n";
//$body .= "<li><a href=\"#\">Djelya Cafo</a></li>\n";
//$body .= "<li><a href=\"#\">Toubacouta</a></li>\n";
$body .= "<li><a href=\"http://www.xonqnopp.ch/\">Xonq Nopp</a></li>\n";
$body .= "</ul>\n";
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
