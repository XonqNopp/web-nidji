<?php
/*** Created: Sun 2014-09-21 12:52:43 CEST ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Fu &ntilde;u nekk";
	$sub = "Combien de kilom&egrave;tres parcourus &agrave; pied&nbsp;? Calculez vous-m&ecirc;mes en suivant les drapeaux&nbsp;!";
	$weather = "M&eacute;t&eacute;o";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Mb&eacute; daaming";
	$sub = "Combien de kilom&egrave;tres parcourus &agrave; pied&nbsp;? Calculez vous-m&ecirc;mes en suivant les drapeaux&nbsp;!";
	$weather = "M&eacute;t&eacute;o";
} else {
	$page_title = "Carte du voyage d&#039;Estelle et Lamine";
	$sub = "Combien de kilom&egrave;tres parcourus &agrave; pied&nbsp;? Calculez vous-m&ecirc;mes en suivant les drapeaux&nbsp;!";
	$weather = "M&eacute;t&eacute;o";
}

$gmapsFrame = '<iframe src="https://www.google.com/maps/d/u/0/embed?mid=1VRO-wa5dWmwKDelrQMtFywhcyc0&ehbc=2E312F" width="640" height="480"></iframe>';

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
$body .= "<img src=\"../pictures/divers/voyageHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= $sub;
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
// Main body
$body .= "<div class=\"map_body\">\n";
$body .= "<div class=\"gmap\">\n$gmapsFrame\n</div>\n";
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
