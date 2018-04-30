<?php
/*** Created: Fri 2014-09-19 11:44:49 CEST
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

if($page->CheckSessionLang($page->GetWolof())) {
	// Wolof
	$page_title = "L'aventure d'Estelle et Lamine Kont&eacute;";
	$subtitle = "2 ans de marche en Afrique de l'Ouest pour pr&eacute;server et mettre en valeur la tradition orale";
	$EL = "Estelle et Lamine";
	$projet = "PROJET";
	$contacts = "CONTACTS";
	$guestbook = "Livre d'or";
	$voyage = "LE VOYAGE";
	$voyage_txt = "Deux ans de marche dans cinq pays d'Afrique de l'Ouest&bnsp;: Vivez l'aventure en parcourant nos albums et en d&eacute;couvrant la carte de notre voyage.";
	$tradition = "LA TRA&shy;DI&shy;TION ORALE";
	$tradition_txt = "La parole est un pilier de la culture mandingue. Elle &eacute;duque, elle inspire, elle &eacute;quilibre, elle t&eacute;moigne, elle tisse des liens entre hier, aujourd'hui et demain...";
	$activites = "NOS A&shy;CTI&shy;VI&shy;T&Eacute;S";
	$activites_txt = "Nous disposons d'un vaste champ de sagesses, de contes et de l&eacute;gendes, de &laquo;&nbsp;paroles-qui-ont-des-dessous&nbsp;&raquo;... &agrave; cultiver&nbsp;: un enrichissement moral pour l'Europe, un tr&eacute;sor pr&eacute;serv&eacute; pour l'Afrique&nbsp;!";
	//
	$map = "Itin&eacute;raire";
	$photos = "Photos";
	$videos = "Vid&eacute;os";
	$projet = "Projet";
	$charte = "Charte de voyage";
	$equipe = "L'&eacute;quipe";
	$news = "News";
	$guestbook = "Vos messages";
	$legend = "Notre voyage avait pour objectif de mettre en lumi&egrave;re les richesses de la tradition orale mandingue. De mai 2009 &agrave; mars 2011, nous avons sillonn&eacute; &agrave; pied une partie de l&#039;Ancien Empire du Manding pour r&eacute;colter des contes, des l&eacute;gendes, des savoirs et des sagesses, afin de faire conna&icirc;tre au monde les vertus d&#039;un enseignement ancestral qui nourrit aujourd&#039;hui encore des milliers de vies. Si le c&oelig;ur vous en dit, nous d&eacute;sirons partager l&#039;aventure avec vous en vous faisant d&eacute;couvrir des photos prises en cours de route ainsi que quelques paroles qui nous ont &eacute;t&eacute; confi&eacute;es.";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	// Manding
	$page_title = "L'aventure d'Estelle et Lamine Kont&eacute;";
	$subtitle = "2 ans de marche en Afrique de l'Ouest pour pr&eacute;server et mettre en valeur la tradition orale";
	$EL = "Estelle et Lamine";
	$projet = "PROJET";
	$contacts = "CONTACTS";
	$guestbook = "Livre d'or";
	$voyage = "LE VOYAGE";
	$voyage_txt = "Deux ans de marche dans cinq pays d'Afrique de l'Ouest&bnsp;: Vivez l'aventure en parcourant nos albums et en d&eacute;couvrant la carte de notre voyage.";
	$tradition = "LA TRA&shy;DI&shy;TION ORALE";
	$tradition_txt = "La parole est un pilier de la culture mandingue. Elle &eacute;duque, elle inspire, elle &eacute;quilibre, elle t&eacute;moigne, elle tisse des liens entre hier, aujourd'hui et demain...";
	$activites = "NOS A&shy;CTI&shy;VI&shy;T&Eacute;S";
	$activites_txt = "Nous disposons d'un vaste champ de sagesses, de contes et de l&eacute;gendes, de &laquo;&nbsp;paroles-qui-ont-des-dessous&nbsp;&raquo;... &agrave; cultiver&nbsp;: un enrichissement moral pour l'Europe, un tr&eacute;sor pr&eacute;serv&eacute; pour l'Afrique&nbsp;!";
	//
	$map = "Itin&eacute;raire";
	$photos = "Photos";
	$videos = "Vid&eacute;os";
	$projet = "Projet";
	$charte = "Charte de voyage";
	$equipe = "L'&eacute;quipe";
	$news = "News";
	$guestbook = "Vos messages";
	$legend = "Notre voyage avait pour objectif de mettre en lumi&egrave;re les richesses de la tradition orale mandingue. De mai 2009 &agrave; mars 2011, nous avons sillonn&eacute; &agrave; pied une partie de l&#039;Ancien Empire du Manding pour r&eacute;colter des contes, des l&eacute;gendes, des savoirs et des sagesses, afin de faire conna&icirc;tre au monde les vertus d&#039;un enseignement ancestral qui nourrit aujourd&#039;hui encore des milliers de vies. Si le c&oelig;ur vous en dit, nous d&eacute;sirons partager l&#039;aventure avec vous en vous faisant d&eacute;couvrir des photos prises en cours de route ainsi que quelques paroles qui nous ont &eacute;t&eacute; confi&eacute;es.";
} else {
	// Francais
	$page_title = "L'aventure d'Estelle et Lamine Kont&eacute;";
	$subtitle = "2 ans de marche en Afrique de l'Ouest pour pr&eacute;server et mettre en valeur la tradition orale";
	$EL = "Estelle et Lamine";
	$contacts = "CONTACTS";
	$guestbook = "Livre d'or";
	$voyage = "LE VOYAGE";
	$voyage_txt = "Deux ans de marche dans cinq pays d'Afrique de l'Ouest&nbsp;: Vivez l'aventure en parcourant nos albums et en d&eacute;couvrant la carte de notre voyage.";
	$tradition = "LA TRA&shy;DI&shy;TION ORALE";
	$tradition_txt = "La parole est un pilier de la culture mandingue. Elle &eacute;duque, elle inspire, elle &eacute;quilibre, elle t&eacute;moigne, elle tisse des liens entre hier, aujourd'hui et demain...";
	$activites = "NOS A&shy;CTI&shy;VI&shy;T&Eacute;S";
	$activites_txt = "Nous disposons d'un vaste champ de sagesses, de contes et de l&eacute;gendes, de &laquo;&nbsp;paroles-qui-ont-des-dessous&nbsp;&raquo;... &agrave; cultiver&nbsp;: un enrichissement moral pour l'Europe, un tr&eacute;sor pr&eacute;serv&eacute; pour l'Afrique&nbsp;!";
	//
	$map = "Itin&eacute;raire";
	$photos = "Photos";
	$videos = "Vid&eacute;os";
	$projet = "Projet";
	$charte = "Charte de voyage";
	$equipe = "L'&eacute;quipe";
	$news = "News";
	$guestbook = "Vos messages";
	$legend = "Notre voyage avait pour objectif de mettre en lumi&egrave;re les richesses de la tradition orale mandingue. De mai 2009 &agrave; mars 2011, nous avons sillonn&eacute; &agrave; pied une partie de l&#039;Ancien Empire du Manding pour r&eacute;colter des contes, des l&eacute;gendes, des savoirs et des sagesses, afin de faire conna&icirc;tre au monde les vertus d&#039;un enseignement ancestral qui nourrit aujourd&#039;hui encore des milliers de vies. Si le c&oelig;ur vous en dit, nous d&eacute;sirons partager l&#039;aventure avec vous en vous faisant d&eacute;couvrir des photos prises en cours de route ainsi que quelques paroles qui nous ont &eacute;t&eacute; confi&eacute;es.";
}


$page->SetTitle($page_title);
$page->CSS_ppJump();
$page->CSS_ppWing();

$body = "";
$page->HotBooty();

$args = new stdClass();
$args->page = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();



	/* TITLE */
	$body .= "<div class=\"mktitle\">";
	$body .= $legend;
	$body .= "</div>\n";

//$body .= "<div class=\"indexbody\">\n";
//
$body .= "<div class=\"mkboth\">\n";
	/* Left links */
	$body .= "<div class=\"mkleft\">\n";
		// Projet
		$body .= "<div class=\"mklink\">\n";
		$body .= "<div class=\"mkleftimg mkprojet\">\n";
		$body .= "<a href=\"projet.php\" title=\"$projet\">\n";
		$body .= "<img class=\"mkleft\" src=\"../pictures/divers/projet.png\" alt=\"$projet\" title=\"$projet\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "<div class=\"mklinkbox\">\n";
		$body .= "<a class=\"mkleft\" href=\"projet.php\" title=\"$projet\">$projet</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		// Charte
		$body .= "<div class=\"mklink\">\n";
		$body .= "<div class=\"mklinkbox\">\n";
		$body .= "<a href=\"charte.php\" title=\"$charte\">$charte</a>\n";
		$body .= "</div>\n";
		$body .= "<div class=\"mkleftimg mkcharte\">\n";
		$body .= "<a href=\"charte.php\" title=\"$charte\">\n";
		$body .= "<img src=\"../pictures/divers/charte.png\" alt=\"$charte\" title=\"$charte\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		/*** Equipe ***/
		$body .= "<div class=\"mklink\">\n";
		$body .= "<div class=\"mkleftimg mkequipe\">\n";
		$body .= "<a href=\"equipe.php\" title=\"$equipe\">\n";
		$body .= "<img src=\"../pictures/divers/equipe.png\" alt=\"$equipe\" title=\"$equipe\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "<div class=\"mklinkbox\">\n";
		$body .= "<a href=\"equipe.php\" title=\"$equipe\">$equipe</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		/*** News ***/
		$body .= "<div class=\"mklink\">\n";
		$body .= "<div class=\"mklinkbox\">\n";
		$body .= "<a href=\"news.php\" title=\"$news\">$news</a>\n";
		$body .= "</div>\n";
		$body .= "<div class=\"mkleftimg mknews\">\n";
		$body .= "<a href=\"news.php\" title=\"$news\">\n";
		$body .= "<img src=\"../pictures/divers/news.png\" alt=\"$news\" title=\"$news\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		/*** Livre d'or ***/
		$body .= "<div class=\"mklink\">\n";
		$body .= "<div class=\"mkleftimg mkguestbook\">\n";
		$body .= "<a href=\"cheers.php\" title=\"$guestbook\">\n";
		$body .= "<img src=\"../pictures/divers/messages.png\" alt=\"$guestbook\" title=\"$guestbook\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "<div class=\"mklinkbox\">\n";
		$body .= "<a href=\"cheers.php\" title=\"$guestbook\">$guestbook</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
	//
	$body .= "</div>\n";
//
	/* Main table */
	$body .= "<div class=\"mktable\">\n";
	$body .= "<div class=\"csstab64_table\">\n";
	$body .= "<div class=\"csstab64_row\">\n";
		//// Map
		$body .= "<div class=\"csstab64_cell\">\n";
		$body .= "<div class=\"mkh3\"><a href=\"map.php\" title=\"$map\">$map</a></div>\n";
		$body .= "<div class=\"mkimg\">\n";
		$body .= "<a href=\"map.php\">\n";
		$body .= "<img src=\"../pictures/divers/voyage.png\" alt=\"$map\" title=\"$map\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
		//// Photos
		$body .= "<div class=\"csstab64_cell\">\n";
		$body .= "<div class=\"mkh3\"><a href=\"photos_albums.php\" title=\"$photos\">$photos</a></div>\n";
		$body .= "<div class=\"mkimg\">\n";
		$body .= "<a href=\"photos_albums.php\">\n";
		$body .= "<img src=\"../pictures/divers/tradition.png\" alt=\"$photos\" title=\"$photos\" />\n";
		$body .= "</a>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	//
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
$body .= "</div>\n";
//$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
