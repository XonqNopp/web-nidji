<?php
/*** Created: Sun 2014-09-28 18:19:19 CEST
 ***/
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
//$page->initHTML();

$na = new stdClass();
$na->url = "galerie.php";
$page->NotAllowed($na);


$page->initDB();

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
//}
$page_title = "Ajouter une photo";

$location = "";
$legend = "";
$id = 0;
$now = $page->GetNow();
$date = $now->date;




if(isset($_POST["erase"])) {
	// Delete entry
	$id = $_POST["id"];
	$fetch_file = $page->DB_IdManage("SELECT `id`, `file` FROM `galerie` WHERE `id` = ?", $id);
	$fetch_file->bind_result($id, $file);
	$fetch_file->fetch();
	$fetch_file->close();
	$file = "../../pictures/galerie/$file";
	$delete = $page->DB_QueryPrepare("DELETE FROM `" . $page->ddb->DBname . "`.`galerie` WHERE `galerie`.`id` = ? LIMIT 1;");
	$delete->bind_param("i", $id);
	if(unlink($file)) {
		$page->DB_ExecuteManage($delete);
	} else {
		$page->NewError("Impossible d'effacer le fichier");
	}
	$page->HeaderLocation("galerie.php");
} elseif(isset($_POST["submit"])) {
	// Insert/update
	$dt = new stdClass();
	$dt->year  = $_POST["date_year"];
	$dt->month = $_POST["date_month"];
	$dt->day   = $_POST["date_day"];
	$date = $page->ConvertDate($dt)->date;
	$location = $page->field2SQL($_POST["location"]);
	$legend = $page->txtarea2SQL($_POST["legend"]);
	if(isset($_POST["id"])) {
		$id = $_POST["id"];
		$update = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`galerie` SET `date` = ?, `location` = ?, `legend` = ? WHERE `galerie` . `id` = ? LIMIT 1;");
		$update->bind_param("sssi", $date, $location, $legend, $id);
		$page->DB_ExecuteManage($update);
	} else {
		$filename = $page->filename2SQL($_FILES["photo"]["name"]);
		//
		$add = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`galerie` (`file`, `date`, `location`, `legend`) VALUES(?, ?, ?, ?);");
		$add->bind_param("ssss", $filename, $date, $location, $legend);
		//
		$leaf = new stdClass();
		$leaf->fieldname = "photo";
		$leaf->filename = $filename;
		$leaf->path = "../../pictures/galerie";
		$leaf->maxfilesize = 2000000;
		$leaf->maximgsize  = 800;
		$leaf->querybound = $add;
		$page->LoadFile($leaf);
	}
	$page->HeaderLocation("galerie.php");
} elseif(isset($_GET["id"])) {
	$id = $_GET["id"];
	$fetch = $page->DB_IdManage("SELECT * FROM `galerie` WHERE `id` = ? LIMIT 1;", $id);
	$fetch->bind_result($id, $file, $date, $location, $legend);
	$fetch->fetch();
	$fetch->close();
	$page_title = "Modifier les informations de $file";
	$basefile = $file;
	$file = "pictures/galerie/$file";
	$location = $page->SQL2field($location);
	$legend = $page->SQL2txtarea($legend);
}


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("galerie");
$page->js_Form();

$body = "";
$gohome = new stdCLass();
$gohome->page = "galerie";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



$fword = new stdClass();
$fword->more = "enctype=\"multipart/form-data\"";
$body .= $page->FormTag($fword);

$field = new stdClass();

$body .= "<div class=\"galerie_new_main\">\n";
$body .= "<div class=\"galerie_new_bothcols\">\n";
	// Left column
	$body .= "<div class=\"galerie_new_left\">\n";
	// File
	if($id > 0) {
		$body .= "<div class=\"galerie_new_photo\">\n";
		$body .= "<img src=\"../../functions_local/thumb.php?picpath=$file&amp;max=250\" alt=\"photo\" />\n";
		$body .= "</div>\n";
	} else {
		$field->type = "file";
		$field->title = "Photo";
		$field->name = "photo";
		$field->value = "";
		$field->size = 20;
		$field->required = true;
		$field->css = "galerie_new_photo";
		$body .= $page->FormField($field);
	}
	$body .= "</div>\n";
//
	// Right column
	$body .= "<div class=\"galerie_new_right\">\n";
		// ID
		if($id > 0) {
			$field->type = "hidden";
			$field->title = "";
			$field->name = "id";
			$field->value = $id;
			$field->size = 0;
			$field->css = "galerie_new_id";
			$body .= $page->FormField($field);
		}
	//
		// Date
		$field->type = "Date";
		$field->title = "Date";
		$field->name = "date";
		$field->value = $date;
		$field->size = 0;
		$field->required = true;
		$field->css = "galerie_new_date";
		$field->yearFirst = 2000;
		$field->yearLast = -1;
		$body .= $page->FormField($field);
	//
		// Location
		$field->type = "text";
		$field->title = "Lieu (facultatif)";
		$field->name = "location";
		$field->value = $location;
		$field->size = 30;
		$field->required = false;
		$field->css = "galerie_new_location";
		$body .= $page->FormField($field);
	//
		// Legend
		$field->type = "textarea";
		$field->title = "Texte (les adresses internet commen&ccedil;ant par \"http://\" seront automatiquement converties en liens)";
		$field->name = "legend";
		$field->value = $legend;
		$field->size = 0;
		$field->rows = 7;
		$field->cols = 50;
		$field->required = true;
		$field->css = "galerie_new_legend";
		$body .= $page->FormField($field);
	//
	$body .= "</div>\n";
$body .= "</div>\n";
// Valbut
$butt = new stdClass();
$butt->css = "galerie_new_but";
$butt->CloseTag = true;
$body .= $page->SubButt($id > 0, $basefile, $butt);


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
