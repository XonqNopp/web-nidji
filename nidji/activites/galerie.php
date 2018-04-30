<?php
/*** Created: Sun 2014-09-28 17:51:55 CEST
 ***
 *** TODO:
 ***
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
	$page_title = "Galerie";
//}

$UserIsAdmin = $page->UserIsAdmin();

$previous_year = 0;
$per_year = 0;


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);

$body = "";
$gohome = new stdClass();
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



$lhead = "<div class=\"lhead\">\n";
$body_main = "";
$pics = $page->DB_QueryManage("SELECT * FROM `galerie` ORDER BY `date` DESC, `id` DESC");
if($pics->num_rows == 0) {
	$body_main .= "D&eacute;sol&eacute;, il n'y a pas encore de photos dans la galerie...";
} else {
	$body_main .= "<div class=\"csstab64_table\">\n";
	$c = 0;
	while($p = $pics->fetch_object()) {
			$c++;
			// Fetch DB infos
			$id        = $p->id;
			$file      = "../../pictures/galerie/" . $p->file;
			$date      = $page->ConvertDate($p->date);
			$this_date = $date->day . " " . $page->Months($date->month) . " " . $date->year;
			$this_year = $date->year;
			$location  = $p->location;
			$legend    = $page->SQL2URL($p->legend);
		//
			// Display
			if($this_year != $previous_year) {
				$body_main .= "<div class=\"csstab64_row\">\n";
				$body_main .= "<h2 id=\"g$this_year\" title=\"$this_year\">$this_year</h2>\n";
				$body_main .= "</div>\n";
				$lhead .= "<a href=\"#g$this_year\" title=\"$this_year\">$this_year</a><br />\n";
				$previous_year = $this_year;
			}
			$body_main .= "<div class=\"csstab64_row\">\n";
				// Picture
				$body_pic = "";
				$body_pic .= "<div class=\"csstab64_cell\">\n";
				$body_pic .= "<div class=\"picwidth\">\n";
				$body_pic .= "<a class=\"img\" target=\"_blank\" href=\"$file\">\n";
				$body_pic .= "<img src=\"$file\" alt=\"$file\" />\n";
				$body_pic .= "</a>\n";
				$body_pic .= "</div>\n";
				$body_pic .= "</div>\n";
			//
				// Legend
				$body_txt = "";
				$body_txt .= "<div class=\"csstab64_cell\">\n";
				if($UserIsAdmin) {
					$body_txt .= "<span class=\"galerie_edit\"><a href=\"galerie_insert.php?id=$id\" title=\"Modifier\">(Modifier)</a></span> \n";
				}
				$body_txt .= "<span class=\"galerie_date\">$this_date</span>\n";
				if($location != "") {
					$body_txt .= "<span class=\"galerie_location\">$location</span> - ";
				}
				if($legend != "") {
					$body_txt .= "$legend\n";
				}
				$body_txt .= "</div>\n";
			//
			if($c % 2 == 0) {
				// Even
				$body_main .= $body_txt;
				$body_main .= $body_pic;
			} else {
				// Odd
				$body_main .= $body_pic;
				$body_main .= $body_txt;
			}
			$body_main .= "</div>\n";
	}
	$body_main .= "</div>\n";
}
$pics->close();

$lhead .= "</div>\n";

$rhead .= "<div class=\"rhead\">\n";
if($UserIsAdmin) {
	$rhead .= "<a href=\"galerie_insert.php\" title=\"Ajouter une photo\">Ajouter une photo</a>\n";
}
$rhead .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= $lhead;
$body .= "<div class=\"chead\"></div>\n";
$body .= $rhead;
$body .= "</div>\n";

$body .= "<div class=\"galerie_main\">\n";
$body .= $body_main;
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
