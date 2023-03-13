<?php
/*** Created: Tue 2014-09-30 09:18:10 CEST
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

$na = new stdClass();
$na->url = "proverbes.php";
$page->NotAllowed($na);

$page->initDB();

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
//}

$page_title = "Nouveau proverbe";
$id = 0;
$french  = "";
$wolof   = "";
$manding = "";
$source_fr = "";
$source_wo = "";
$source_md = "";


if(isset($_POST["erase"])) {
	// Delete given id
	$id = $_POST["id"];
	$page->DB_IdManage("DELETE FROM `" . $page->ddb->DBname . "`.`proverbs` WHERE `proverbs`.`id` = ? LIMIT 1;", $id);
	$page->HeaderLocation("proverbes.php");
} elseif(isset($_POST["submit"])) {
	// insert/update
	$french   = $page->paragraph2SQL($_POST["french"]);
	$wolof    = $page->paragraph2SQL($_POST["wolof"]);
	$manding  = $page->paragraph2SQL($_POST["manding"]);
	$source_fr = $page->paragraph2SQL($_POST["source_fr"]);
	$source_wo = $page->paragraph2SQL($_POST["source_wo"]);
	$source_md = $page->paragraph2SQL($_POST["source_md"]);
	$query = null;
	if(isset($_POST["id"])) {
		$id = $_POST["id"];
		$query = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`proverbs` SET `french` = ?, `wolof` = ?, `manding` = ?, `source_fr` = ?, `source_wo` = ?, `source_md` = ? WHERE `proverbs`.`id` = ? LIMIT 1;");
		$query->bind_param("ssssssi", $french, $wolof, $manding, $source_fr, $source_wo, $source_md, $id);
	} else {
		$query = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`proverbs` (`french`, `wolof`, `manding`, `source_fr`, `source_wo`, `source_md`) VALUES(?, ?, ?, ?, ?, ?);");
		$query->bind_param("ssssss", $french, $wolof, $manding, $source_fr, $source_wo, $source_md);
	}
	$page->DB_ExecuteManage($query);
	$page->HeaderLocation("proverbes.php");
} elseif(isset($_GET["id"])) {
	$id = $_GET["id"];
	$findit = $page->DB_IdManage("SELECT * FROM `proverbs` WHERE `id` = ? LIMIT 1;", $id);
	$findit->bind_result($id, $french, $source_fr, $wolof, $source_wo, $manding, $source_md);
	$findit->fetch();
	$findit->close();
	$french    = $page->SQL2paragraph($french);
	$wolof     = $page->SQL2paragraph($wolof);
	$manding   = $page->SQL2paragraph($manding);
	$source_fr = $page->SQL2paragraph($source_fr);
	$source_wo = $page->SQL2paragraph($source_wo);
	$source_md = $page->SQL2paragraph($source_md);
	$page_title = "Modifier le proverbe";
}


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("proverbes");
$page->js_Form();

$body = "";
$gohome = new stdClass();
$gohome->page = "proverbes";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();



$body .= $page->FormTag();

$field = new stdClass();

$field->type = "hidden";
$field->name = "id";
$field->value = $id;
$field->css = "proverb_new_id";
if($id > 0) {
	$body .= $page->FormField($field);
}

$body .= "<div class=\"csstab64_table\">\n";

$body .= "<div class=\"csstab64_row\">\n";

$field->type = "textarea";
$field->title = "Fran&ccedil;ais";
$field->name = "french";
$field->value = $french;
$field->css = "csstab64_cell proverb_new_french";
$field->rows = 7;
$field->cols = 50;
$field->autofocus = true;
$body .= $page->FormField($field);

$field->type = "textarea";
$field->title = "Source fran&ccedil;ais";
$field->name = "source_fr";
$field->value = $source_fr;
$field->rows = 7;
$field->cols = 50;
$field->css = "csstab64_cell proverb_new_source_fr";
$body .= $page->FormField($field);

$body .= "</div>\n";
$body .= "<div class=\"csstab64_row\">\n";

$field->type = "textarea";
$field->title = "Wolof";
$field->name = "wolof";
$field->value = $wolof;
$field->css = "csstab64_cell proverb_new_wolof";
$field->rows = 7;
$field->cols = 50;
$field->autofocus = false;
$body .= $page->FormField($field);

$field->type = "textarea";
$field->title = "Source wolof";
$field->name = "source_wo";
$field->value = $source_wo;
$field->rows = 7;
$field->cols = 50;
$field->css = "csstab64_cell proverb_new_source_wo";
$body .= $page->FormField($field);

$body .= "</div>\n";
$body .= "<div class=\"csstab64_row\">\n";

$field->type = "textarea";
$field->title = "Mandingue";
$field->name = "manding";
$field->value = $manding;
$field->rows = 7;
$field->cols = 50;
$field->css = "csstab64_cell proverb_new_manding";
$body .= $page->FormField($field);

$field->type = "textarea";
$field->title = "Source mandingue";
$field->name = "source_md";
$field->value = $source_md;
$field->rows = 7;
$field->cols = 50;
$field->css = "csstab64_cell proverb_new_source_md";
$body .= $page->FormField($field);

$body .= "</div>\n";
$body .= "</div>\n";

$butt = new stdClass();
$butt->CloseTag = true;
$butt->css = "proverb_new_valbut";
$body .= $page->SubButt($id > 0, "le proverbe #$id", $butt);



$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
