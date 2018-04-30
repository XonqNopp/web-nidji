<?php
/*** Created: Mon 2014-09-29 13:46:34 CEST
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
$na->url = "pressbook.php";
$page->NotAllowed($na);


$page->initDB();

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
//}

$page_title = "Ajouter un article";
$date = $page->GetNow()->date;
$id = 0;
$file = "";
$text = "";
$alt  = "";


if(isset($_POST["erase"])) {
	// Delete entry
	$id = $_POST["id"];
	$fetch_file = $page->DB_IdManage("SELECT `id`,`file` FROM `pressbook` WHERE `id` = ?", $id);
	$fetch_file->bind_result($id, $file);
	$fetch_file->fetch();
	$fetch_file->close();
	if($file != "") {
		$file = "../../pictures/pressbook/$file";
	}
	$delete = $page->DB_QueryPrepare("DELETE FROM `" . $page->ddb->DBname . "`.`pressbook` WHERE `pressbook`.`id` = ? LIMIT 1;");
	$delete->bind_param("i", $id);
	if($file != "") {
		if(unlink($file)) {
			$page->DB_ExecuteManage($delete);
		} else {
			$page->FatalError("Impossible d'effacer le fichier");
		}
	} else {
		$page->DB_ExecuteManage($delete);
	}
	$page->HeaderLocation("pressbook.php");
} elseif(isset($_POST["submit"])) {
	// Insert/update
	$dt = new stdClass();
	$dt->year  = $_POST["date_year"];
	$dt->month = $_POST["date_month"];
	$dt->day   = $_POST["date_day"];
	$date = $page->ConvertDate($dt)->date;
	$text = $page->paragraph2SQL($_POST["text"]);
	if(isset($_POST["id"])) {
		// Update
		$id = $_POST["id"];
		$update = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`pressbook` SET `date` = ?, `text` = ? WHERE `pressbook`.`id` = ? LIMIT 1;");
		$update->bind_param("ssi", $date, $text, $id);
		$page->DB_ExecuteManage($update);
	} else {
		// Insert
		$add = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`pressbook` (`date`, `file`, `text`) VALUES(?, ?, ?);");
		$filename = "";
		if($_FILES != array()) {
			$filename = $page->filename2SQL($_FILES["press"]["name"]);
		}
		$add->bind_param("sss", $date, $filename, $text);
		//
		$leaf = new stdClass();
		$leaf->fieldname = "press";
		$leaf->filename = $filename;
		$leaf->path = "../../pictures/pressbook";
		$leaf->maxfilesize = 2000000;
		$leaf->maximgsize  = 800;
		$leaf->querybound = $add;
		//$leaf->reduce = false;
		if($filename != "") {
			$page->LoadFile($leaf);
		} else {
			$page->DB_ExecuteManage($add);
		}
	}
	$page->HeaderLocation("pressbook.php");
} elseif(isset($_GET["id"])) {
	$id = $_GET["id"];
	$fetch = $page->DB_IdManage("SELECT * FROM `pressbook` WHERE `id` = ? LIMIT 1;", $id);
	$fetch->bind_result($id, $date, $file, $text);
	$fetch->fetch();
	$fetch->close();
	if($file != "") {
		$alt = $file;
		$file = "../../pictures/pressbook/$file";
	}
	$text = $page->SQL2paragraph($text);
	$page_title = "Modifier les informations de l'article";
}


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("pressbook");
$page->js_Form();

$body = "";
$gohome = new stdClass();
$gohome->page = "pressbook";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



$field = new stdClass();

$fword = new stdClass();
$fword->more = "enctype=\"multipart/form-data\"";
$body .= $page->FormTag($fword);

if($id > 0) {
	$body .= "<div class=\"pressbook_new_id\">\n";
	$body .= "<input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
	$body .= "</div>\n";
}
$body .= "<div class=\"pressbook_new_main\">\n";
$body .= "<div class=\"pressbook_new_bothcols\">\n";
	// Left column
	$body .= "<div class=\"pressbook_new_left\">\n";
	// File
	if($id > 0) {
		if($file != "") {
			$body .= "<div class=\"pressbook_new_press\">\n";
			$erf = new stdClass();
			$erf->alt_txt = $alt;
			$erf->picthumb = true;
			$erf->picsize = 250;
			$erf->picwidth = 300;
			$erf->picheight = 200;
			$erf->funcpath = "../..";
			$body .= $page->EmbedFile($file, $erf);
			//if($ext == ".pdf") {
				//$pdfwidth = 300;
				$pdfheight = 200;
				////$body .= "<object data=\"$file\" type=\"application/pdf\" width=\"$pdfwidth\" height=\"$pdfheight\">\n";
				//$body .= "alt : <a href=\"$file\" title=\"$file\">$file</a>\n";
				//$body .= "</object>\n";
			//} else {
				//$body .= "<img src=\"../../functions_local/thumb.php?picpath=$file&amp;max=250\" alt=\"article\" />\n";
			//}
			$body .= "</div>\n";
		}
	} else {
		$field->type = "file";
		$field->title = "Fichier PDF/JPG/PNG/GIF (facultatif)";
		$field->name = "press";
		$field->value = "";
		$field->size = 20;
		$field->required = true;
		$field->css = "pressbook_new_press";
		$body .= $page->FormField($field);
	}
	$body .= "</div>\n";
//
	// Right column
	$body .= "<div class=\"pressbook_new_right\">\n";
		// Date
		$field->type = "Date";
		$field->title = "Date";
		$field->name = "date";
		$field->value = $date;
		$field->size = 0;
		$field->required = true;
		$field->css = "pressbook_new_date";
		$body .= $page->FormField($field);
	//
		// Text
		$field->type = "textarea";
		$field->title = "Texte (les adresses internet commen&ccedil;ant par \"http://\" seront automatiquement converties en liens)";
		$field->name = "text";
		$field->value = $text;
		$field->rows = 7;
		$field->cols = 50;
		$field->required = true;
		$field->css = "pressbook_new_text";
		$body .= $page->FormField($field);
	//
	// Valbut
	$body .= "</div>\n";
$butt = new stdClass();
$butt->CloseTag = true;
$body .= "</div>\n";
$body .= "</div>\n";
$body .= $page->SubButt($id > 0, "l'article #$id", $butt);


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";


$page->show($body);
unset($page);
?>
