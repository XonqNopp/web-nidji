<?php
/*** Created: Tue 2014-12-09 17:33:05 CET
 ***
 *** TODO:
 ***
 ***/
require("functions/classPage.php");
$funcpath = "functions";
$page = new PhPage();
$page->NotAllowed();
$page->initDB();
//$page->LogLevelUp(6);


$page_title = "Ajouter une question anti-tourist";
$sel = " selected=\"selected\"";
$id = 0;

//// init vars
$id = 0;
$question = "";
$answer = "";

//// DATABASE
if(isset($_POST["submit"])) {
	$question = $page->field2SQL($_POST["question"]);
	$language = $_POST["language"];
	if(isset($_POST["id"])) {
		$id = $_POST["id"];
	}
	if($_POST["question"] == "" || $_POST["answer1"] == "" || $_POST["answer2"] == "" || $_POST["answer1"] != $_POST["answer2"]) {
		$page->NewError("Veuillez ins&eacute;rer une question et deux fois la m&ecirc;me r&eacute;ponse.");
	} else {
		$answer = $page->hache($_POST["answer1"]);
		if($id > 0) {
			//// UPDATE
			$query = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`tourist` SET `language` = ?, `question` = ?, `answer` = ? WHERE `tourist`.`id` = ? LIMIT 1;");
			$query->bind_param("sssi", $language, $question, $answer, $id);
		} else {
			//// NEW ENTRY
			$query = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`tourist` (`language`, `question`, `answer`) VALUES(?, ?, ?);");
			$query->bind_param("sss", $language, $question, $answer);
		}
		$page->DB_ExecuteManage($query);
		$page->HeaderLocation("nobot.php");
	}
} elseif(isset($_POST["erase"])) {
	//// ERASE
	$id = $_POST["id"];
	$erase = $page->DB_QueryPrepare("DELETE FROM `" . $page->ddb->DBname . "`.`tourist` WHERE `tourist`.`id` = ? LIMIT 1;");
	$erase->bind_param("i", $id);
	$page->DB_ExecuteManage($erase);
	$page->HeaderLocation("nobot.php");
}



//// GETTING INFOS
if(isset($_GET["id"])) {
	$id = $_GET["id"];
	$fetch = $page->DB_IdManage("SELECT * FROM `tourist` WHERE `id` = ?", $id);
	$fetch->bind_result($id, $language, $question, $answer);
	$fetch->fetch();
	$fetch->close();
	$question = $page->SQL2field($question);
	$page_title = "Modifier la question No $id";
}
if(!isset($language)) {
	$language = "french";
}
$fr = "";
$wf = "";
$mg = "";
if($language == "mandinka") {
	$mg = $sel;
} elseif($language == "wolof") {
	$wf = $sel;
} else {
	$fr = $sel;
}


$page->js_Form();

$body = "";
$gohome = new stdCLass();
$gohome->page = "nobot";
$gohome->rootpage = "index";
$body .= $page->GoHome($gohome);
$body .= $page->SetTitle($page_title);
$page->HotBooty();


$body = "<form action=\"nobot_insert.php\" method=\"post\">\n";
if($id > 0) {
	$args = new stdClass();
	$args->type = "hidden";
	$args->name = "id";
	$args->value = $id;
	$args->css = "hidden";
	$body .= $page->FormField($args);
}
//// LANGUAGE
$body .= "<div class=\"touristlang\"><select name=\"language\">\n";
$body .= "<option value=\"french\"$fr>Fran&ccedil;ais</option>\n";
$body .= "<option value=\"wolof\"$wf>Wolof</option>\n";
$body .= "<option value=\"manding\"$mg>Manding</option>\n";
$body .= "</select></div>\n";
//// QUESTION
$args= new stdClass();
$args->type = "text";
$args->title = "Question";
$args->name = "question";
$args->value = $question;
$args->css = "touristquest";
$args->size = 80;
$args->autofocus = true;
$args->required = true;
$args->posttitle = "?";
$body .= $page->FormField($args);

//// ANSWER
$args = new stdClass();
$args->type = "text";
$args->title = "R&eacute;ponse";
$args->name = "answer1";
$args->css = "touristans";
$args->size = 40;
$args->required = true;
$body .= $page->FormField($args);

$args->name = "answer2";
$args->title = "Confirmation de la r&eacute;ponse";
$args->css = "touristconfirm";
$body .= $page->FormField($args);

//// BUTTONS
$butt = new stdClass();
$butt->css = "touristbut";
$butt->CloseTag = true;
$body .= $page->SubButt($id > 0, "la question #$id", $butt);


$page->show($body);
unset($page);
?>
