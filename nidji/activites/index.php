<?php
/*** Created: Sat 2014-09-27 10:47:39 CEST
 * TODO:
 *
 */
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Nos activit&eacute;s";
	$sub = "Pour un aper&ccedil;u de nos activit&eacute;s... en Suisse et ailleurs&nbsp;!";
	$activitestxt = "<p>En Casamance, la parole est accueillie partout comme un h&ocirc;te respectable et digne de la meilleure &eacute;coute. A K&eacute;ra Kunda les contes s&#039;&eacute;veillent en m&ecirc;me temps que les premi&egrave;res &eacute;toiles. Nous avons-nous avons entendu de la bouche de Mama Seydi, de Wawa et d&#039;autres femmes du village les r&eacute;cits fantastiques des exploits des anc&ecirc;tres de la famille Kont&eacute;.  Nous connaissons certains secrets qui unissent les humains aux animaux de la brousse ainsi que les refrains qui motivent les guerriers ou interpellent les djinns (g&eacute;nies) cach&eacute;s au plus profond des baobabs.</p>\n";
	$activitestxt .= "<p>Pour vous rencontrer, nous nous parerons du souvenir de la cour du grand-p&egrave;re ou l&#039;on se rassemble pour &eacute;couter... ce que la nuit veut bien nous dire. Nous serions ravis de vous pr&eacute;senter le li&egrave;vre, la hy&egrave;ne, le courageux Sonko, Sounkar Bamaba la sorci&egrave;re et bien d&#039;autres personnages qui ne demandent que la parole pour vous charmer... au cours d&#039;un prochain spectacle.</p>\n";
	$agenda = "Notre agenda";
	$galerie = "Galerie";
	$pressbook = "Press-book";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Nos activit&eacute;s";
	$sub = "Pour un aper&ccedil;u de nos activit&eacute;s... en Suisse et ailleurs&nbsp;!";
	$activitestxt = "<p>En Casamance, la parole est accueillie partout comme un h&ocirc;te respectable et digne de la meilleure &eacute;coute. A K&eacute;ra Kunda les contes s&#039;&eacute;veillent en m&ecirc;me temps que les premi&egrave;res &eacute;toiles. Nous avons-nous avons entendu de la bouche de Mama Seydi, de Wawa et d&#039;autres femmes du village les r&eacute;cits fantastiques des exploits des anc&ecirc;tres de la famille Kont&eacute;.  Nous connaissons certains secrets qui unissent les humains aux animaux de la brousse ainsi que les refrains qui motivent les guerriers ou interpellent les djinns (g&eacute;nies) cach&eacute;s au plus profond des baobabs.</p>\n";
	$activitestxt .= "<p>Pour vous rencontrer, nous nous parerons du souvenir de la cour du grand-p&egrave;re ou l&#039;on se rassemble pour &eacute;couter... ce que la nuit veut bien nous dire. Nous serions ravis de vous pr&eacute;senter le li&egrave;vre, la hy&egrave;ne, le courageux Sonko, Sounkar Bamaba la sorci&egrave;re et bien d&#039;autres personnages qui ne demandent que la parole pour vous charmer... au cours d&#039;un prochain spectacle.</p>\n";
	$agenda = "Notre agenda";
	$galerie = "Galerie";
	$pressbook = "Press-book";
} else {
	$page_title = "Nos activit&eacute;s";
	$sub = "Pour un aper&ccedil;u de nos activit&eacute;s... en Suisse et ailleurs&nbsp;!";
	$activitestxt = "<p>En Casamance, la parole est accueillie partout comme un h&ocirc;te respectable et digne de la meilleure &eacute;coute. A K&eacute;ra Kunda les contes s&#039;&eacute;veillent en m&ecirc;me temps que les premi&egrave;res &eacute;toiles. Nous avons-nous avons entendu de la bouche de Mama Seydi, de Wawa et d&#039;autres femmes du village les r&eacute;cits fantastiques des exploits des anc&ecirc;tres de la famille Kont&eacute;.  Nous connaissons certains secrets qui unissent les humains aux animaux de la brousse ainsi que les refrains qui motivent les guerriers ou interpellent les djinns (g&eacute;nies) cach&eacute;s au plus profond des baobabs.</p>\n";
	$activitestxt .= "<p>Pour vous rencontrer, nous nous parerons du souvenir de la cour du grand-p&egrave;re ou l&#039;on se rassemble pour &eacute;couter... ce que la nuit veut bien nous dire. Nous serions ravis de vous pr&eacute;senter le li&egrave;vre, la hy&egrave;ne, le courageux Sonko, Sounkar Bamaba la sorci&egrave;re et bien d&#039;autres personnages qui ne demandent que la parole pour vous charmer... au cours d&#039;un prochain spectacle.</p>\n";
	$agenda = "Notre agenda";
	$galerie = "Galerie";
	$pressbook = "Press-book";
}


$page->SetTitle($page_title);
$page->CSS_ppJump(2);
$page->CSS_ppWing(2);

$body = "";
$page->HotBooty();

$gohome = new stdClass();
$gohome->page = "..";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();


	//// Header
	$body .= "<div class=\"headbanner\">\n";
	$body .= "<div class=\"imgheader\">\n";
	$body .= "<img src=\"../../pictures/divers/activitesHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
	$body .= "</div>\n";
	$body .= "<div class=\"headtxtarea\">\n";
	$body .= "<div class=\"headtxt\">\n";
	$body .= $sub;
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
//
	// Main body
	$body .= "<div class=\"mainactivites\">\n";
		// Text
		$body .= "<div class=\"activitestxt\">$activitestxt</div>\n";
	//
		// Links
		$body .= "<div class=\"csstab64_table activiteslinks\">\n";
		$body .= "<div class=\"csstab64_row\">\n";
			// Agenda
			$body .= "<div class=\"csstab64_cell activiteslink\">\n";
			$body .= "<div>\n";
			$body .= "$agenda\n";
			$body .= "</div>\n";
			$body .= "<div class=\"activiteslinkimg\">\n";
			$body .= "<a href=\"agenda.php\" title=\"$agenda\">\n";
			$body .= "<img src=\"../../pictures/divers/agenda.png\" alt=\"$agenda\" title=\"$agenda\" />\n";
			$body .= "</a>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		//
			// Galerie
			$body .= "<div class=\"csstab64_cell activiteslink\">\n";
			$body .= "<div>\n";
			$body .= "$galerie\n";
			$body .= "</div>\n";
			$body .= "<div class=\"activiteslinkimg\">\n";
			$body .= "<a href=\"galerie.php\" title=\"$galerie\">\n";
			$body .= "<img src=\"../../pictures/divers/galerie.png\" alt=\"$galerie\" title=\"$galerie\" />\n";
			$body .= "</a>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		//
			// Press-book
			$body .= "<div class=\"csstab64_cell activiteslink\">\n";
			$body .= "<div>\n";
			$body .= "$pressbook\n";
			$body .= "</div>\n";
			$body .= "<div class=\"activiteslinkimg\">\n";
			$body .= "<a href=\"pressbook.php\" title=\"$pressbook\">\n";
			$body .= "<img src=\"../../pictures/divers/pressbook.png\" alt=\"$pressbook\" title=\"$pressbook\" />\n";
			$body .= "</a>\n";
			$body .= "</div>\n";
			$body .= "</div>\n";
		$body .= "</div>\n";
		//
		$body .= "</div>\n";
	//
	$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
