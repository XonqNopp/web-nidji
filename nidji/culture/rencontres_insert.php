<?php
/*** Created: Wed 2014-10-01 09:32:59 CEST
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
//$page->initHTML();

$na = new stdClass();
$na->url = "rencontres_collection.php";
$page->NotAllowed($na);

$page->initDB();


$placefield = "Localisation (facultatif)";
$photofield = "Photo (facultatif)";
$page_title = "Ajouter une rencontre";
$now = $page->GetNow();
$year = $now->year;
$month = $now->month;
$day = $now->day;
$dateStruct = new stdClass();
$dateStruct->year = $year;
$dateStruct->month = $month;
$dateStruct->day = $day;
$date = $page->ConvertDate($dateStruct)->date;

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
//}

$id = 0;
$author = "";
$place = "";
$photo = "";
$french = "";
$wolof = "";
$manding = "";

if(isset($_POST["erase"])) {
	$id = $_POST["id"];
	$erase = $page->DB_IdManage("DELETE FROM `" . $page->ddb->DBname . "`.`meetings` WHERE `meetings`.`id` = ? LIMIT 1;", $id);
	$page->HeaderLocation("rencontres_collection.php");
} elseif(isset($_POST["submit"])) {
	$author = $page->field2SQL($_POST["author"]);
	$place = $page->field2SQL($_POST["place"]);
	$photo = $_POST["photo"];
	$french = $page->paragraph2SQL($_POST["french"]);
	$wolof = $page->paragraph2SQL($_POST["wolof"]);
	$manding = $page->paragraph2SQL($_POST["manding"]);
	$year = $_POST["rencontre_year"];
	$month = $_POST["rencontre_month"];
	$day = $_POST["rencontre_day"];
	$cd = new stdClass();
	$cd->year = $year;
	$cd->month = $month;
	$cd->day = $day;
	$date = $page->ConvertDate($cd);
	$date_sql = $date->date;
	$query = null;
	if(isset($_POST["id"])) {
		$id = $_POST["id"];
		$query = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`meetings` SET `date` = ?, `author` = ?, `place` = ?, `picid` = ?, `french` = ?, `wolof` = ?, `manding` = ? WHERE `meetings`.`id` = ? LIMIT 1;");
		$query->bind_param("sssssssi", $date_sql, $author, $place, $photo, $french, $wolof, $manding, $id);
	} else {
		$query = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`meetings` (`date`, `author`, `place`, `picid`, `french`, `wolof`, `manding`) VALUES(?, ?, ?, ?, ?, ?, ?);");
		$query->bind_param("sssssss", $date_sql, $author, $place, $photo, $french, $wolof, $manding);
	}
	$page->DB_ExecuteManage($query);
	if(!isset($_POST["id"])) {
		$id = $query->insert_id;
	}
	$query->close();
	$page->HeaderLocation("rencontres_collection.php");
} elseif(isset($_GET["id"])) {
	$id = $_GET["id"];
	$page_title = "&Eacute;diter une rencontre";
	$meeting = $page->DB_IdManage("SELECT * FROM `meetings` WHERE `id` = ?", $id);
	$meeting->bind_result($id, $date, $author, $place, $photo, $french, $wolof, $manding);
	$meeting->fetch();
	$meeting->close();
	$date = $page->ConvertDate($date);
	$year  = $date->year;
	$month = $date->month;
	$day   = $date->day;
	$author      = $page->SQL2field($author);
	$place       = $page->SQL2field($place);
	$french  = $page->SQL2paragraph($french);
	$wolof   = $page->SQL2paragraph($wolof);
	$manding = $page->SQL2paragraph($manding);
} elseif(isset($_GET["person"])) {
	$person = $_GET["person"];
	$getsql = $page->DB_IdManage("SELECT `id`,`author` FROM `meetings` WHERE `id` = ?", $person);
	$getsql->bind_result($person, $author);
	$getsql->fetch();
	$getsql->close();
	$author = $page->SQL2field($author);
}


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("rencontres");
$page->js_Form();

$body = "";
$gohome = new stdClass();
$gohome->page = "rencontres_collection";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



$body .= $page->FormTag();

if($id > 0) {
	$args = new stdClass();
	$args->type = "hidden";
	$args->name = "id";
	$args->value = $id;
	$args->css = "hidden";
	$body .= $page->FormField($args);
}

// DATE
$args = new stdClass();
$args->type = "Date";
$args->name = "rencontre";
$args->css = "rencontredate";
$args->value = $date;
$args->yearFirst = 2000;
$args->yearLast = -1;
$body .= $page->FormField($args);

// AUTHOR
$args = new stdClass();
$args->type = "text";
$args->title = "Auteur(e)";
$args->name = "author";
$args->value = $author;
$args->css = "rencontreauthor";
if($id > 0 || $author == "") {
	$args->autofocus = true;
}
$body .= $page->FormField($args);

// PLACE
$args = new stdClass();
$args->type = "text";
$args->title = $placefield;
$args->name = "place";
$args->value = $place;
if($id == 0 && $author != "") {
	$args->autofocus = true;
}
$body .= $page->FormField($args);

// PHOTO
$args = new stdClass();
$args->type = "select";
$args->name = "photo";
$args->value = $photo;
$args->title = $photofield;
$args->css = "rencontrephoto";
$args->listQuery = "SELECT * FROM `photos` ORDER BY `date` DESC, `time` DESC";
$args->listQueryValue = "id";
$args->listQueryTitle = "title";
$args->WithEmpty = true;
$body .= $page->FormField($args);

// COMMENTS
$body .= "<div class=\"rencontrecomment\">\n";

$args = new stdClass();
$args->type = "textarea";
$args->cols = 48;
$args->rows = 8;
$args->div = false;
$args->paragraph = true;

// french
$args->title = "Fran&ccedil;ais";
$args->name = "french";
$args->value = $french;
$body .= $page->FormField($args);

// wolof
$args->title = "Wolof";
$args->name = "wolof";
$args->value = $wolof;
$body .= $page->FormField($args);

// manding
$args->title = "Manding";
$args->name = "manding";
$args->value = $manding;
$body .= $page->FormField($args);

$body .= "</div>\n";

// BUTTONS
$butt = new stdClass();
$butt->css = "rencontrebut";
$butt->CloseTag = true;
$body .= $page->SubButt($id > 0, "la rencontre #$id avec $author", $butt);

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";


$page->show($body);
unset($page);
?>
