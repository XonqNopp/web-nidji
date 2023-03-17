<?php
/*** Created: Sat 2014-09-27 11:59:14 CEST
 */
require("../../functions/classPage.php");
$rootPath = "../..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/agendacatpub.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$na = new stdClass();
$na->url = "agenda.php";
$page->NotAllowed($na);


$page->initDB();

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
//}

$now = $page->GetNow();
$date = $now->date;
$id = 0;
$title = "";
$location = "";
$category = "";
$public = "";
$description = "";

$page_title = "Ajouter un &eacute;v&egrave;nement";

if(isset($_POST["erase"])) {
	/*** delete entry ***/
	$id = $_POST["id"];
	$delete = $page->DB_IdManage("DELETE FROM `" . $page->ddb->DBname . "`.`agenda` WHERE `agenda`.`id` = ? LIMIT 1;", $id);
	$page->HeaderLocation("agenda.php");
	exit;
} elseif(isset($_POST["submit"])) {
	/*** Insert/update ***/
	$title = $page->field2SQL($_POST["title"]);
	$dt = new stdClass();
	$dt->year  = $_POST["date_year"];
	$dt->month = $_POST["date_month"];
	$dt->day   = $_POST["date_day"];
	$date = $page->ConvertDate($dt)->date;
	$location = $page->field2SQL($_POST["location"]);
	$category = $_POST["category"];
	$public = $_POST["public"];
	$description = $page->paragraph2SQL($_POST["description"]);
	$query = null;
	if(isset($_POST["id"])) {
		/*** Update ***/
		$id = $_POST["id"];
		$query = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`agenda` SET `title` = ?, `date` = ?, `location` = ?, `category` = ?, `audience` = ?, `description` = ? WHERE `agenda`.`id` = ? LIMIT 1;");
		$query -> bind_param("ssssssi", $title, $date, $location, $category, $public, $description, $id);
	} else {
		/*** Insert ***/
		$query = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`agenda` (`title`, `date`, `location`, `category`, `audience`, `description` ) VALUES(?, ?, ?, ?, ?, ? );");
		$query -> bind_param("ssssss", $title, $date, $location, $category, $public, $description);
	}
	$page->DB_ExecuteManage($query);
	$page->HeaderLocation("agenda.php");
	exit;
} elseif(isset($_GET["id"])) {
	$id = $_GET["id"];
	$fetch = $page->DB_IdManage("SELECT * FROM `agenda` WHERE `id` = ?", $id);
	$fetch->bind_result($id, $title, $date, $location, $category, $public, $description);
	$fetch->fetch();
	$fetch->close();
	$title = $page->SQL2field($title);
	$location = $page->SQL2field($location);
	$description = $page->SQL2paragraph($description);
	$page_title = "Modifier $title ($date)";
}


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("agenda");
$page->js_Form();

$body = "";
$gohome = new stdCLass();
$gohome->page = "agenda";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();




$body .= "<div class=\"agenda_new_main\">\n";
$body .= $page->FormTag();

$field = new stdClass();
	// id
	$field->type = "hidden";
	$field->name = "id";
	$field->value = $id;
	$field->css = "agenda_new_id";
	if($id > 0) {
		$body .= $page->FormField($field);
	}
//
	// title
	$field->type = "text";
	$field->title = "Titre";
	$field->name = "title";
	$field->value = $title;
	$field->size = 40;
	$field->css = "agenda_new_title";
	$field->autofocus = true;
	$field->required = true;
	$body .= $page->FormField($field);
	$field->autofocus = false;
//
	// date
	$field->type = "Date";
	$field->title = "Date";
	$field->name = "date";
	$field->value = $date;
	$field->size = 0;
	$field->required = true;
	$field->css = "agenda_new_date";
	$body .= $page->FormField($field);
//
	// location
	$field->type = "text";
	$field->title = "Lieu";
	$field->name = "location";
	$field->value = $location;
	$field->size = 30;
	$field->css = "agenda_new_location";
	$body .= $page->FormField($field);
	$body .= "<div>\n";
	$body .= "(Le lieu sera un lien sur google maps. Ce qui est entre paranth&egrave;ses ne sera pas utilis&eacute; pour le lien. Essaie le lien quand tu as fini pour v&eacute;rifier que &ccedil;a fonctionne comme tu le veux.)\n";
	$body .= "</div>\n";
//
	// category
	$field->type = "select";
	$field->title = "Cat&eacute;gorie";
	$field->list = get_cat_full();
	$field->name = "category";
	$field->value = $category;
	$field->size = 0;
	$field->css = "agenda_new_category";
	$body .= $page->FormField($field);
//
	// audience
	$field->title = "Public";
	$field->list = get_public_full();
	$field->name = "public";
	$field->value = $public;
	$field->css = "agenda_new_public";
	$body .= $page->FormField($field);
//
	// description
	$field->type = "textarea";
	$field->title = "Description (les adresses internet commen&ccedil;ant par \"http://\" seront automatiquement converties en liens)";
	$field->name = "description";
	$field->value = $description;
	$field->cols = 70;
	$field->rows = 15;
	$field->required = true;
	$field->css = "agenda_new_description";
	$body .= $page->FormField($field);
//
	// valbut
	$butt = new stdClass();
	$butt->css = "agenda_new_but";
	$butt->CloseTag = true;
	$body .= $page->SubButt($id > 0, "'$title'", $butt);

$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";


$page->show($body);
unset($page);
?>
