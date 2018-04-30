<?php
/*** Created: Wed 2014-10-01 14:26:30 CEST
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
$na->url = "contes_collection.php";
$page->NotAllowed($na);

$page->initDB();


//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
//}

$id = 0;
$page_title = "Ajouter un conte";
$titlefield = "Titre du conte";
$contefield = "Contenu du conte";
$picfield = "Illustration du conte (facultatif)";
$delete = "Supprimer cette illustration";
$titlefrench = "";
$titlewolof = "";
$titlemanding = "";
$french = "";
$wolof = "";
$manding = "";
$now = $page->GetNow();
$year = $now->year;
$month = $now->month;
$day = $now->day;
$dateStruct = new stdClass();
$dateStruct->year = $year;
$dateStruct->month = $month;
$dateStruct->day = $day;
$date = $page->ConvertDate($dateStruct)->date;
$filename = "";


if(isset($_POST["erase"])) {
	$id = $_POST["id"];
	$query = $page->DB_IdManage("SELECT `id`,`picture` FROM `tales` WHERE `id` = ?", $id);
	$query->bind_result($id, $filename);
	$query->fetch();
	$query->close();
	$erase = $page->DB_QueryPrepare("DELETE FROM `" . $page->ddb->DBname . "`.`tales` WHERE `tales`.`id` = ? LIMIT 1;");
	$erase->bind_param("i", $id);
	$a1 = true;
	if($filename != "") {
		$a1 = unlink("../../pictures/contes/$filename");
	}
	if($a1) {
		$page->DB_ExecuteManage($erase);
	} else {
		$page->NewError("Impossible d&#039;effacer tous les fichiers");
	}
	$page->HeaderLocation("contes_collection.php");
	$page_title = "Modifier un conte";
} elseif(isset($_POST["submit"])) {
	$titlefrench  = $page->field2SQL($_POST["titlefrench"]);
	$titlewolof   = $page->field2SQL($_POST["titlewolof"]);
	$titlemanding = $page->field2SQL($_POST["titlemanding"]);
	$french   = $page->paragraph2SQL($_POST["french"]);
	$wolof    = $page->paragraph2SQL($_POST["wolof"]);
	$manding  = $page->paragraph2SQL($_POST["manding"]);
	$filename = $page->filename2SQL($_FILES["picture"]["name"]);
	$year = $_POST["conte_year"];
	$month = $_POST["conte_month"];
	$day = $_POST["conte_day"];
	$cd = new stdClass();
	$cd->year = $year;
	$cd->month = $month;
	$cd->day = $day;
	$date = $page->ConvertDate($cd)->date;
	if(($titlefrench == "" && $titlewolof == "" && $titlemanding == "") || ($french == "" && $wolof == "" && $manding == "")) {
		$page->NewError("Veuillez mettre le conte et son titre dans au moins une langue");
	} else {
		if(isset($_POST["id"])) {
			$id = $_POST["id"];
			//// Update
			if(isset($_POST["deletethumb"])) {
				//// Delete thumb
				$picture = $_POST["picture"];
				$deletethumb = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`tales` SET `picture` = NULL WHERE `tales`.`id` = ? LIMIT 1;");
				$deletethumb->bind_param("i", $id);
				if(unlink("../../pictures/contes/$picture")) {
					$page->DB_ExecuteManage($deletethumb);
				} else {
					$page->NewError("Impossible d&#039;effacer les fichiers");
				}
			}
			if($filename != "") {
				//// add new thumb
				$newthumb = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`tales` SET `picture` = ? WHERE `tales`.`id` = ? LIMIT 1;");
				$newthumb->bind_param("si", $filename, $id);
				$leaf = new stdClass();
				$leaf->fieldname = "picture";
				$leaf->filename = $filename;
				$leaf->path = "../../pictures/contes";
				$leaf->querybound = $newthumb;
				$leaf->maximgsize = 800;
				$leaf->maxfilesize = 2000000;
				$page->LoadFile($leaf);
			}
			//// update without changing picture
			$update = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`tales` SET `date` = ?, `titlefrench` = ?, `titlewolof` = ?, `titlemanding` = ?, `french` = ?, `wolof` = ?, `manding` = ? WHERE `tales`.`id` = ? LIMIT 1;");
			$update->bind_param("sssssssi", $date, $titlefrench, $titlewolof, $titlemanding, $french, $wolof, $manding, $id);
			$page->DB_ExecuteManage($update);
		} else {
			//// Insert
			$insert = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`tales` (`date`, `picture`, `titlefrench`, `titlewolof`, `titlemanding`, `french`, `wolof`, `manding`) VALUES(?, ?, ?, ?, ?, ?, ?, ?);");
			$insert->bind_param("ssssssss", $date, $filename, $titlefrench, $titlewolof, $titlemanding, $french, $wolof, $manding);
			if($filename != "") {
				$leaf = new stdClass();
				$leaf->fieldname = "picture";
				$leaf->filename = $filename;
				$leaf->path = "../../pictures/contes";
				$leaf->maximgsize = 800;
				$leaf->maxfilesize = 2000000;
				$leaf->querybound = $insert;
				$page->LoadFile($leaf);
			} else {
				$page->DB_ExecuteManage($insert);
			}
			$id = $insert->insert_id;
		}
		$page->HeaderLocation("contes_display.php?id=$id");
	}
	$page_title = "Modifier un conte";
} elseif(isset($_GET["id"])) {
	$id = $_GET["id"];
	$query = $page->DB_IdManage("SELECT * FROM `tales` WHERE `id` = ?", $id);
	$query->bind_result($id, $date, $filename, $titlefrench, $titlewolof, $titlemanding, $french, $wolof, $manding);
	$query->fetch();
	$query->close();
	$titlefrench  = $page->SQL2field($titlefrench);
	$titlewolof   = $page->SQL2field($titlewolof);
	$titlemanding = $page->SQL2field($titlemanding);
	$french       = $page->SQL2paragraph($french);
	$wolof        = $page->SQL2paragraph($wolof);
	$manding      = $page->SQL2paragraph($manding);
	$date  = $page->ConvertDate($date);
	$year  = $date->year;
	$month = $date->month;
	$day   = $date->day;
	$page_title = "Modifier un conte";
}


$page->CSS_ppJump(2);
$page->CSS_ppWing(2);
$page->CSS_Push("contes");
$page->js_Form();

$body = "";
$gohome = new stdClass();
$gohome->page = "contes_collection";
$gohome->rootpage = "../..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();
$body .= $page->SetTitle($page_title);
$page->HotBooty();

$body .= $page->AdminLink();
$body .= copyright();


$fword = new stdClass();
$fword->leeloo = true;
$body .= $page->FormTag($fword);

// date
$args = new stdClass();
$args->type = "Date";
$args->name = "conte";
$args->css = "contedate";
$args->value = $date;
$args->yearFirst = 2000;
$args->yearLast = -1;
$body .= $page->FormField($args);

// title
$body .= "<div class=\"contetitle\">\n";
$body .= "<h3 class=\"contetitle\">$titlefield</h3>\n";
$args = new stdClass();
$args->type = "text";
$args->size = 40;
$args->div = false;
$args->paragraph = true;
$args->css = "contetitle";

// Manding
$args->title = "Manding";
$args->name = "titlemanding";
$args->value = $titlemanding;
$args->autofocus = true;
$body .= $page->FormField($args);
$args->autofocus = false;

// Wolof
$args->title = "Wolof";
$args->name = "titlewolof";
$args->value = $titlewolof;
$body .= $page->FormField($args);

// French
$args->title = "Fran&ccedil;ais";
$args->name = "titlefrench";
$args->value = $titlefrench;
$body .= $page->FormField($args);

$body .= "</div>\n";
/* ID and PICID */
if($id > 0) {
	$body .= "<div class=\"hidden\">\n";
	$args = new stdClass();
	$args->type = "hidden";
	$args->name = "id";
	$args->value = $id;
	$body .= $page->FormField($args);
	if($filename != "") {
		$args->name = "picture";
		$args->value = $filename;
		$body .= $page->FormField($args);
	}
	$body .= "</div>\n";
	if($filename != "") {
		$body .= "<div class=\"contepicture\">\n";
		$body .= "$picfield&nbsp;: \n";
		$picpath = "pictures/contes/$filename";
		$body .= "<img class=\"contepicid\" alt=\"$picfield\" title=\"$picfield\" src=\"../../functions_local/thumb.php?picpath=$picpath\" />\n";
		$body .= "<br />\n";

		$args = new stdClass();
		$args->type = "checkbox";
		$args->name = "deletethumb";
		$args->list = array("_" => $delete);
		$args->div = false;
		$args->noCheckArray = true;
		$body .= $page->FormField($args);

		$body .= "</div>\n";
	} else {
		$args = new stdClass();
		$args->type = "file";
		$args->title = $picfield;
		$args->name = "picture";
		$args->css = "contepicid";
		$args->MaxFileSize = 1;
		$body .= $page->FormField($args);
	}
} else {
	$args = new stdClass();
	$args->type = "file";
	$args->title = $picfield;
	$args->name = "picture";
	$args->css = "contepicid";
	$args->MaxFileSize = 1;
	$body .= $page->FormField($args);
}
/* CONTE */
$body .= "<div class=\"contebody\">\n";
$body .= "<h3 class=\"contebody\">$contefield</h3>\n";
$args = new stdClass();
$args->type = "textarea";
$args->cols = 40;
$args->rows = 10;

// manding
$args->title = "Manding";
$args->name = "manding";
$args->value = $manding;
$body .= $page->FormField($args);

// wolof
$args->title = "Wolof";
$args->name = "wolof";
$args->value = $wolof;
$body .= $page->FormField($args);

// french
$args->title = "Fran&ccedil;ais";
$args->name = "french";
$args->value = $french;
$body .= $page->FormField($args);

/**/
$body .= "</div>\n";
/* BUTTONS */
$butt = new stdClass();
$butt->css = "contebut";
$butt->CloseTag = true;
$body .= $page->SubButt($id > 0, "'$titlefrench' (conte #$id)", $butt);


$page->show($body);
unset($page);
?>
