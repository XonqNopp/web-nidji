<?php
/*** Created: Thu 2014-09-18 16:17:37 CEST
 * TODO: admin link
 ***
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/update.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();


if($page->CheckSessionLang($page->GetWolof())) {
	$title = "Nidji - souffle mandingue - l'association";
	$obj1 = "Sauvegarder la m&eacute;moire dans les pays de culture mandingue, par le biais d'enregistrements audiovisuels";
	$obj2 = "Donner aux villageois de Casamance les moyens de r&eacute;aliser des &eacute;v&egrave;nements culturels afin de p&eacute;renniser leurs traditions";
	$obj3 = "Mettre en valeur les paroles r&eacute;colt&eacute;es en les retranscrivant dans des ouvrages &eacute;crits, accessibles en Europe et en Afrique";
	$obj4 = "Promouvoir une culture de paix par le dialogue et l'&eacute;change d'id&eacute;es entre les deux continents";
	$guestbook = "Livre d'or";
	$invoices = "Cotisations";
	$gifts = "Dons";
	$contact = "Contact";
	$membre_title = "Infos Membres";
	$membre = "Les informations pratiques concernant l'association: tout ce que vous voulez savoir sur les membres, comment le devenir, qui est le comit&eacute;...";
	$activities_title = "Activiti&eacute;s";
	$activities = "Par ici vous trouverez nos activit&eacute;s futures et pass&eacute;es et diverses infos relatives";
	$tradition_title = "Culture Mandingue";
	$tradition = "Si vous voulez d&eacute;couvrir la culture mandingue et sa tradition orale, ou tout savoir sur le voyage d'Estelle et Lamine... c'est par ici!";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$title = "Nidji - souffle mandingue - l'association";
	$obj1 = "Sauvegarder la m&eacute;moire dans les pays de culture mandingue, par le biais d'enregistrements audiovisuels";
	$obj2 = "Donner aux villageois de Casamance les moyens de r&eacute;aliser des &eacute;v&egrave;nements culturels afin de p&eacute;renniser leurs traditions";
	$obj3 = "Mettre en valeur les paroles r&eacute;colt&eacute;es en les retranscrivant dans des ouvrages &eacute;crits, accessibles en Europe et en Afrique";
	$obj4 = "Promouvoir une culture de paix par le dialogue et l'&eacute;change d'id&eacute;es entre les deux continents";
	$guestbook = "Livre d'or";
	$invoices = "Cotisations";
	$gifts = "Dons";
	$contact = "Contact";
	$membre_title = "Infos Membres";
	$membre = "Les informations pratiques concernant l'association: tout ce que vous voulez savoir sur les membres, comment le devenir, qui est le comit&eacute;...";
	$activities_title = "Activiti&eacute;s";
	$activities = "Par ici vous trouverez nos activit&eacute;s futures et pass&eacute;es et diverses infos relatives";
	$tradition_title = "Culture Mandingue";
	$tradition = "Si vous voulez d&eacute;couvrir la culture mandingue et sa tradition orale, ou tout savoir sur le voyage d'Estelle et Lamine... c'est par ici!";
} else {
	$title = "Nidji - souffle mandingue - l'association";
	$obj1 = "Sauvegarder la m&eacute;moire dans les pays de culture mandingue, par le biais d'enregistrements audiovisuels";
	$obj2 = "Donner aux villageois de Casamance les moyens de r&eacute;aliser des &eacute;v&egrave;nements culturels afin de p&eacute;renniser leurs traditions";
	$obj3 = "Mettre en valeur les paroles r&eacute;colt&eacute;es en les retranscrivant dans des ouvrages &eacute;crits, accessibles en Europe et en Afrique";
	$obj4 = "Promouvoir une culture de paix par le dialogue et l'&eacute;change d'id&eacute;es entre les deux continents";
	$guestbook = "Livre d'or";
	$invoices = "Cotisations";
	$gifts = "Dons";
	$contact = "Contact";
	$membre_title = "Infos Membres";
	$membre = "Les informations pratiques concernant l'association: tout ce que vous voulez savoir sur les membres, comment le devenir, qui est le comit&eacute;...";
	$activities_title = "Activiti&eacute;s";
	$activities = "Par ici vous trouverez nos activit&eacute;s futures et pass&eacute;es et diverses infos relatives";
	$tradition_title = "Culture Mandingue";
	$tradition = "Si vous voulez d&eacute;couvrir la culture mandingue et sa tradition orale, ou tout savoir sur le voyage d'Estelle et Lamine... c'est par ici!";
}

/*** pics ***/
$charlie = "../pictures/languages/mandinka.png";

$guest_pic = $charlie;
$invoice_pic = $charlie;
$gifts_pic = $charlie;
$contact_pic = $charlie;

$membre_pic = "../pictures/assoc/membres.png";
$activities_pic = "../pictures/assoc/activites.png";
$tradition_pic = "../pictures/assoc/culture.png";


$page->CSS_ppJump();
$page->CSS_ppWing();

$body = "";
$args = new stdClass();
$args->page = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();
$body .= $page->SetTitle($title);
$page->HotBooty();


/*** objectives ***/
$body .= "<div class=\"csstab64_table indextop wide center\">\n";
$body .= "<div class=\"csstab64_row\">\n";
$body .= "<div class=\"csstab64_cell assocobj1\">$obj1</div>\n";
$body .= "<div class=\"csstab64_cell assocobj2\">$obj2</div>\n";
$body .= "<div class=\"csstab64_cell assocobj3\">$obj3</div>\n";
$body .= "<div class=\"csstab64_cell assocobj4\">$obj4</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
//
//// last update
$body .= update($page);
//


$body .= "<div class=\"indexbody\">\n";
$body .= "<div class=\"wide\">\n";
	/*** left links ***/
	$body .= "<div class=\"indexleft\">\n";// style=\"width:30%; display: inline-block;\">\n";
		/*** guestbook ***/
		$body .= "<div class=\"indexlink\">\n";
		$body .= "<div class=\"indexleftimg\"><a href=\"guestbook.php\" title=\"$guestbook\"><img class=\"indexleft\" src=\"$guest_pic\" alt=\"$guestbook\" title=\"$guestbook\" /></a></div>\n";
		$body .= "<div class=\"indexlinkbox\"><a class=\"indexleft\" href=\"guestbook.php\" title=\"$guestbook\">$guestbook</a></div>\n";
		$body .= "</div>\n";
	//
		/*** invoices ***/
		$body .= "<div class=\"indexlink\">\n";
		$body .= "<div class=\"indexlinkbox\"><a class=\"indexleft\" href=\"membres.php#moneymoney\" title=\"$invoices\">$invoices</a></div>\n";
		$body .= "<div class=\"indexleftimg\"><a href=\"membres.php#moneymoney\" title=\"$invoices\"><img class=\"indexleft\" src=\"$invoice_pic\" alt=\"$invoices\" title=\"$invoices\" /></a></div>\n";
		$body .= "</div>\n";
	//
		/*** gifts ***/
		$body .= "<div class=\"indexlink\">\n";
		$body .= "<div class=\"indexleftimg\"><a href=\"membres.php#bank\" title=\"$gifts\"><img class=\"indexleft\" src=\"$gifts_pic\" alt=\"$gifts\" title=\"$gifts\" /></a></div>\n";
		$body .= "<div class=\"indexlinkbox\"><a class=\"indexleft\" href=\"membres.php#bank\" title=\"$gifts\">$gifts</a></div>\n";
		$body .= "</div>\n";
	//
		/*** contact ***/
		$body .= "<div class=\"indexlink\">\n";
		$body .= "<div class=\"indexlinkbox\"><a class=\"indexleft\" href=\"membres.php#mail\" title=\"$contact\">$contact</a></div>\n";
		$body .= "<div class=\"indexleftimg\"><a href=\"membres.php#mail\" title=\"$contact\"><img class=\"indexleft\" src=\"$contact_pic\" alt=\"$contact\" title=\"$contact\" /></a></div>\n";
		$body .= "</div>\n";
	$body .= "</div>\n";
//
	/*** img links ***/
	$body .= "<div class=\"indextable\">\n";
		/*** membres ***/
		$body .= "<div class=\"assoc_big\">\n";
		$body .= "<div class=\"assoc_tab_head\"><a href=\"membres.php\" title=\"$membre\">$membre_title</a></div>\n";
		$body .= "<div class=\"assoc_tab_pic\"><a href=\"membres.php\" title=\"$membre\"><img alt=\"$membre\" title=\"$membre\" src=\"$membre_pic\" /></a></div>\n";
		$body .= "<div class=\"assoc_tab_txt\"><a href=\"membres.php\" title=\"$membre\">$membre</a></div>\n";
		$body .= "</div>\n";
	//
		/*** activities ***/
		$body .= "<div class=\"assoc_big\">\n";
		$body .= "<div class=\"assoc_tab_head\"><a href=\"activites/index.php\" title=\"$activities\">$activities_title</a></div>\n";
		$body .= "<div class=\"assoc_tab_pic\"><a href=\"activites/index.php\" title=\"$activities\"><img alt=\"$activities\" title=\"$activities\" src=\"$activities_pic\" /></a></div>\n";
		$body .= "<div class=\"assoc_tab_txt\"><a href=\"activites/index.php\">$activities</a></div>\n";
		$body .= "</div>\n";
	//
		/*** tradition ***/
		$body .= "<div class=\"assoc_big\">\n";
		$body .= "<div class=\"assoc_tab_head\"><a href=\"culture/index.php\" title=\"$tradition\">$tradition_title</a></div>\n";
		$body .= "<div class=\"assoc_tab_pic\"><a href=\"culture/index.php\" title=\"$tradition\"><img alt=\"$tradition\" title=\"$tradition\" src=\"$tradition_pic\" /></a></div>\n";
		$body .= "<div class=\"assoc_tab_txt\"><a href=\"culture/index.php\">$tradition</a></div>\n";
		$body .= "</div>\n";
	$body .= "</div>\n";
//
$body .= "</div>\n";
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
/*** admin link ***/
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
