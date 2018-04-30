<?php
/*** Created: Tue 2014-08-12 12:21:32 CEST
 ***
 *** TODO:
 ***
 ***/
require("functions/classPage.php");
$funcpath = "functions";
require("${funcpath}_local/copyright.php");
require("${funcpath}_local/update.php");
$page = new PhPage();
//$page->logLevelUp(6);
$page->check_www();

$args = new stdClass();
$args->redirect = "";
$page->LoginCookie($args);

$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	// Wolof
	$title = "Nidji - souffle mandingue";
	$subtitle = "Un enfant perch&eacute; sur un arbre ne voit pas aussi loin qu'un vieillard assis sur le sol";
	$EL = "Estelle et Lamine";
	$friends = "Sites amis";
	$mk = "Manding K&eacute;so";
	$mk_txt = "Deux ans de marche dans cinq pays d'Afrique de l'Ouest&bnsp;: Vivez l'aventure en parcourant nos albums et en d&eacute;couvrant la carte de notre voyage.";
	$assoc = "L'Association";
	$assoc_txt = "La parole est un pilier de la culture mandingue. Elle &eacute;duque, elle inspire, elle &eacute;quilibre, elle t&eacute;moigne, elle tisse des liens entre hier, aujourd'hui et demain...";
	$visit = "visites &agrave; ce jour";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	// Manding
	$title = "Nidji - souffle mandingue";
	$subtitle = "Un enfant perch&eacute; sur un arbre ne voit pas aussi loin qu'un vieillard assis sur le sol";
	$EL = "Estelle et Lamine";
	$friends = "Sites amis";
	$mk = "Manding K&eacute;so";
	$mk_txt = "Deux ans de marche dans cinq pays d'Afrique de l'Ouest&bnsp;: Vivez l'aventure en parcourant nos albums et en d&eacute;couvrant la carte de notre voyage.";
	$assoc = "L'Association";
	$assoc_txt = "La parole est un pilier de la culture mandingue. Elle &eacute;duque, elle inspire, elle &eacute;quilibre, elle t&eacute;moigne, elle tisse des liens entre hier, aujourd'hui et demain...";
	$visit = "visites &agrave; ce jour";
} else {
	// Francais
	$title = "Nidji - souffle mandingue";
	$subtitle = "Un enfant perch&eacute; sur un arbre ne voit pas aussi loin qu'un vieillard assis sur le sol";
	$EL = "Estelle et Lamine";
	$friends = "Sites amis";
	$mk = "Manding K&eacute;so";
	$mk_txt = "Deux ans de marche dans cinq pays d'Afrique de l'Ouest&nbsp;: Vivez l'aventure en parcourant nos albums et en d&eacute;couvrant la carte de notre voyage.";
	$assoc = "L'Association";
	$assoc_txt = "La parole est un pilier de la culture mandingue. Elle &eacute;duque, elle inspire, elle &eacute;quilibre, elle t&eacute;moigne, elle tisse des liens entre hier, aujourd'hui et demain...";
	$visit = "visites &agrave; ce jour";
}

$page->SetTitle("Nidji souffle mandingue");
	/*** HTML headers ***/
	$keywords = "Nidji, souffle, souffle mandingue, Nidji souffle mandingue, Estelle, Karlen, Lamine, Kont&eacute;, Konte, Manding, K&eacute;so, Keso, Suisse, Valais, Bramois, Sion, S&eacute;n&eacute;gal, Senegal, K&eacute;ra Kunda, Kera Kunda, Kerakunda, wolof, mandingue, mandinka, empire, Afrique, Gael, Ga&euml;l, Induni, Gael Induni, Ga&euml;l Induni";
	$description = "Nidji - souffle mandingue: l'association pour faire fructifier Manding Keso, le voyage d&#039;Estelle et Lamine dans l&#039;ancien Grand Empire Mandingue pour recolter la tradition orale avant qu&#039;elle ne soit perdue.";
	$page->SetKeywords($keywords);
	$page->SetDescription($description);
//
$body = "";
$page->HotBooty();


	/*** Black banner ***/
	$body .= "<div class=\"indexblackbanner\">\n";
		/*** MAIN PICTURE ***/
		$body .= "<div class=\"indexmain\">";
		//$body .= "<img class=\"ix\" alt=\"$title\" title=\"$title\" src=\"pictures/welcome_banner.png\" />";
		$body .= "<img class=\"ix1\" alt=\"$title\" title=\"$title\" src=\"pictures/welcome_banner1.png\" />";
		$body .= "<img class=\"ix2\" alt=\"$title\" title=\"$title\" src=\"pictures/welcome_banner2.png\" />";
		$body .= "<img class=\"ix3\" alt=\"$title\" title=\"$title\" src=\"pictures/welcome_banner3.png\" />";
		$body .= "<img class=\"ix4\" alt=\"$title\" title=\"$title\" src=\"pictures/welcome_banner4.png\" />";
		$body .= "</div>\n";
	//
		/* SUBTITLE */
		$body .= "<div class=\"indexsubtitle\">";
		$body .= "$subtitle\n";
		$body .= "</div>\n";
	//
		/* TITLE */
		$body .= "<div class=\"indextitle\">";
		$body .= $title;
		$body .= "</div>\n";
	$body .= "</div>\n";
$body .= "<div class=\"indexbody\">\n";
/*** language ***/
$body .= $page->Languages();
//
$body .= "<div class=\"wide\">\n";
//// last update
$body .= update($page);
//
	/* Left links */
	$body .= "<div class=\"indexleft\">\n";
		// Estelle et Lamine
		$body .= "<div class=\"indexlink\">\n";
		$body .= "<div class=\"indexleftimg indexEL\"><a href=\"estellelamine.php\" title=\"$EL\"><img class=\"indexleft\" src=\"pictures/divers/stilamine.png\" alt=\"$EL\" title=\"$EL\" /></a></div>\n";
		$body .= "<div class=\"indexlinkbox\"><a class=\"indexleft\" href=\"estellelamine.php\" title=\"$EL\">$EL</a></div>\n";
		$body .= "</div>\n";
	//
		// Sites amis
		$body .= "<div class=\"indexlink\">\n";
		$body .= "<div class=\"indexlinkbox\"><a class=\"indexleft\" href=\"sites.php\" title=\"$friends\">$friends</a></div>\n";
		$body .= "<div class=\"indexleftimg indexprojet\"><a href=\"sites.php\" title=\"$friends\"><img class=\"indexleft\" src=\"pictures/divers/projet.png\" alt=\"$friends\" title=\"$friends\" /></a></div>\n";
		$body .= "</div>\n";
	//
		//// Admin stuff
		if($page->UserIsAdmin()) {
			$body .= "<div class=\"indexlink\">\n";
			$body .= "<div class=\"indexleftimg indexprojet\"><a href=\"admin.php\" title=\"admin\"><img class=\"indexleft\" src=\"pictures/divers/projet.png\" alt=\"admin\" title=\"admin\" /></a></div>\n";
			$body .= "<div class=\"indexlinkbox\"><a class=\"indexleft\" href=\"admin.php\" title=\"admin\">admin</a></div>\n";
			$body .= "</div>\n";
		}
	//
	$body .= "</div>\n";
//
	//// Main table
	$body .= "<div class=\"index4table\">\n";
	$body .= "<div class=\"indextable\">\n";
		//// nidji
		$body .= "<div class=\"indexcol\">\n";
			//// title
			$body .= "<div class=\"indexh3\">\n";
			$body .= "<a href=\"nidji/index.php\" title=\"$assoc\">$assoc</a>\n";
			$body .= "</div>\n";
		//
			//// img
			$body .= "<div class=\"indeximg\">\n";
			$body .= "<a href=\"nidji/index.php\" title=\"$assoc\"><img src=\"pictures/divers/tradition.png\" alt=\"$assoc\" title=\"$assoc\" /></a>\n";
			$body .= "</div>\n";
		//
			//// txt
			$body .= "<div class=\"indextxt\">\n";
			$body .= "$assoc_txt\n";
			$body .= "</div>\n";
		$body .= "</div>\n";
	//
		//// manding keso
		$body .= "<div class=\"indexcol\">\n";
			//// title
			$body .= "<div class=\"indexh3\">\n";
			$body .= "<a href=\"mandingkeso/index.php\" title=\"$mk\">$mk</a>\n";
			$body .= "</div>\n";
		//
			//// img
			$body .= "<div class=\"indeximg\">\n";
			$body .= "<a href=\"mandingkeso/index.php\" title=\"$mk\"><img src=\"pictures/divers/voyage.png\" alt=\"$mk\" title=\"$mk\" /></a>\n";
			$body .= "</div>\n";
		//
			//// txt
			$body .= "<div class=\"indextxt\">\n";
			$body .= "$mk_txt\n";
			$body .= "</div>\n";
		$body .= "</div>\n";
	////
	$body .= "</div>\n";
	$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";

//// copyright
$body .= copyright();

//// admin link
$body .= $page->AdminLink();

$body .= "</div>\n";

//// counter
$args = new stdClass();
$args->after = " $visit";
$body .= $page->PrintVisits("nidji", $args);


$page->show($body);
unset($page);
?>
