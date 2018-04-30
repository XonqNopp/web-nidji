<?php
/*** Created: Sat 2014-09-20 19:31:21 CEST
 ***
 *** TODO:
 ***
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
require("${funcpath}_local/findlang.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = "Xiibar yi";
	$sub = "Quelques &eacute;chos de la brousse... envoy&eacute;s en cours de route.";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = "Kibaaro lu";
	$sub = "Quelques &eacute;chos de la brousse... envoy&eacute;s en cours de route.";
} else {
	$page_title = "Les news";
	$sub = "Quelques &eacute;chos de la brousse... envoy&eacute;s en cours de route.";
}

$page->SetTitle($page_title);
$page->CSS_ppJump();
$page->CSS_ppWing();

$body = "";
$page->HotBooty();

$args = new stdClass();
$args->rootpage = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();

$news = $page->DB_QueryManage("SELECT * FROM `news` ORDER BY `date` DESC, `time` DESC, `id` DESC");


$body .= "<div class=\"headbanner\">\n";
$body .= "<div class=\"imgheader\">\n";
$body .= "<img src=\"../pictures/divers/newsHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= $sub;
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";


$body .= "<div class=\"news_main\">\n";
$body .= "<div class=\"news\">\n";
$body .= "<div class=\"csstab64_table\">\n";
while($entry = $news->fetch_object()) {
	$id = $entry->id;
	$body .= "<div class=\"csstab64_row\">\n";
	$body .= "<div class=\"csstab64_cell newsphoto\">\n";
	$picid = $entry->photo;
	$french  = $entry->french;
	$wolof   = $entry->wolof;
	$manding = $entry->manding;
	if($picid != "") {
		$photo = $page->DB_QueryManage("SELECT * FROM `photos` WHERE `id` = $picid");
		if($photo->num_rows > 0) {
			$tof = $photo -> fetch_object();
			$toftitle = $tof->title;
			$picpath = "pictures/album" . $tof->album . "/" . $page->SQL2field($tof->name);
			$body .= "<a href=\"photos_display.php?id=$picid\">\n";
			$body .= "<img class=\"newspic\" title=\"$toftitle\" alt=\"$toftitle\" src=\"../functions_local/thumb.php?picpath=$picpath\" />\n";
			$body .= "</a>\n";
		} else {
			$body .= "Image not found\n";
		}
		$photo->close();
	}
	$body .= "</div>\n";
	$body .= "<div class=\"csstab64_cell news\">\n";
	$body .= "<div class=\"newsdate\">$entry->date " . substr($entry->time, 0, -3) . "</div>\n";
	$theplace = "";
	$theplace = $entry->place;
	if($entry->country != "") {
		$co = $page->DB_QueryManage("SELECT * FROM `countries` WHERE `id` = " . $entry->country);
		if($co->num_rows > 0) {
			$theco = $co->fetch_object();
			$country = $theco->name;
			$prep = $theco->prep;
			if($theplace != "") {
				$theplace .= " ($country)";
			} else {
				if($page->CheckSessionLang($page->GetWolof())) {
					$theplace = "Ci $country";
				} elseif($page->CheckSessionLang($page->GetMandinka())) {
					$theplace = "$country konon";
				} else {
					$theplace = "Quelque part $prep $country";
				}
			}
		}
		$co->close();
	}
	if($theplace != "") {
		$body .= "<div class=\"newsplace\">$theplace</div>\n";
	}
	$body .= GetBestLang($page, $french, $wolof, $manding, "newscomment");
	$body .= "</div>\n";
	$body .= "</div>\n"; 
}
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
//$body .= "</div>\n";
$news->close();


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
