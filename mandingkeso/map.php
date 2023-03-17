<?php
/*** Created: Sun 2014-09-21 12:52:43 CEST
 ***/
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

$msa = "0";
$msid = "113978371120270303627.0004635cb6b13e37900e5";
$ll = "11.856599,-12.678223";
$spn = "6.984619,11.008301";
$z = "7";
$url = "http://maps.google.com/maps/ms?ie=UTF8&amp;hl=fr&amp;t=h&amp;source=embed&amp;msa=$msa&amp;msid=$msid&amp;ll=$ll&amp;spn=$spn&amp;output=embed";
//$goto = "http://maps.google.com/maps/ms?ie=UTF8&amp;hl=fr&amp;t=h&amp;source=embed&amp;msa=$msa&amp;msid=$msid&amp;ll=$ll&amp;spn=$spn";
$weatherLink = "http://www.wunderground.com/wundermap/?lat=12.31854&amp;lon=-7.33887&amp;zoom=6&amp;type=mixte&amp;units=metric&amp;rad=1&amp;rad.num=1&amp;rad.spd=25&amp;rad.opa=70&amp;rad.stm=0&amp;rad.type=N0R&amp;rad.smo=1&amp;rad.mrg=0&amp;wxsn=1&amp;wxsn.mode=tw&amp;svr=0&amp;cams=0&amp;sat=0&amp;riv=0&amp;mm=0&amp;hur=0&amp;fire=0&amp;tor=0&amp;ndfd=0";

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
$body .= "<div class=\"glegend\">\n";
$body .= "<a title=\"$weather\" href=\"$weatherLink\">$weather</a>\n";
$body .= "</div>\n";
$body .= "<div class=\"gmap\">\n";
$body .= "<object class=\"gmap\" data=\"$url\" type=\"text/html\" />\n";
$body .= "</div>\n";
//$body .= "<div class=\"mapweather\">\n";
//$body .= "<a title=\"$weather\" href=\"$weatherLink\">$weather</a>\n";
//$body .= "</div>\n";
$body .= "</div>\n";



$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
