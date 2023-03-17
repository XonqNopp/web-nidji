<?php
/*** Created: Sat 2014-09-27 09:17:24 CEST
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/sobonana.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);

$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$title = "Dolli yobbante";
	$nick = "Tuur bi";
	$theplace = "Localisation (facultatif)";
	$thecomment = "Commentaire";
	$ortho = "Merci d&#039;&eacute;crire vos commentaires correctement (en &eacute;vitant le langage SMS)...";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$title = "Kuno kafu";
	$nick = "To";
	$theplace = "Localisation (facultatif)";
	$thecomment = "Commentaire";
	$ortho = "Merci d&#039;&eacute;crire vos commentaires correctement (en &eacute;vitant le langage SMS)...";
} else {
	$title = "Ajouter un commentaire";
	$nick = "Pr&eacute;nom";
	$theplace = "Localisation (facultatif)";
	$thecomment = "Commentaire";
	$ortho = "Merci d&#039;&eacute;crire vos commentaires correctement (en &eacute;vitant le langage SMS)...";
}

$id = 0;
$auth = "";
$loc = "";
$place = "";
$com = "";
$now = $page->GetNow();
$year = $now->year;
$month = $now->month;
$day = $now->day;
$hour = $now->hour;
$minute = $now->minute;
$second = $now->second;

if(isset($_POST["antitouristid"])) {
	/*** Coming back from form ***/
	if(isset($_POST["id"])) {
		$id = $_POST["id"];
	}
	$auth = $_POST["nick"];
	$loc = $_POST["place"];
	$com = $_POST["comment"];
	$year = $_POST["year"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	$hour = $_POST["hour"];
	$minute = $_POST["minute"];
	$second = $_POST["second"];
	//
	if(!CheckNobo($page, $_POST["antitouristid"], $_POST["antitourist"])) {
		$page->NewError("Test humain incorrect");
	} else {
		if(isset($_POST["erase"])) {
			/*** delete entry ***/
			$id = $_POST["id"];
			$query = $page->DB_QueryPrepare("DELETE FROM `" . $page->ddb->DBname . "`.`guestbook` WHERE `guestbook`.`id` = ? LIMIT 1;");
			$query->bind_param("s", $id);
			$page->DB_ExecuteManage($query);
			$page->HeaderLocation("guestbook.php");
			exit;
		} elseif(isset($_POST["submit"])) {
			/*** insert/update ***/
			$author = $page->field2SQL($auth);
			$place = $page->field2SQL($loc);
			$comment = $page->paragraph2SQL($com, "com");
			$dt = new stdClass();
			$dt->year   = $year;
			$dt->month  = $month;
			$dt->day    = $day;
			$dt->hour   = $hour;
			$dt->minute = $minute;
			$dt->second = $second;
			$datetime   = $page->ConvertDate($dt, true, true);
			$date = $datetime->date;
			$time = $datetime->time;
			if($comment == "") {
				$page->NewError("Veuillez ins&eacute;rer un commentaire svp.");
			} else {
				$query = null;
				if($id == 0) {
					/* INSERT */
					$query = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`guestbook` (`date`, `time`, `author`, `place`, `comment`) VALUES(?, ?, ?, ?, ? );");
					$query->bind_param("sssss", $date, $time, $author, $place, $comment);
				} else {
					/* UPDATE */
					$query = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`guestbook` SET `author` = ?, `place` = ?, `comment` = ? WHERE `guestbook`.`id` = ? LIMIT 1;");
					$query->bind_param("ssss", $author, $place, $comment, $id);
				}
				$page->DB_ExecuteManage($query);
				$query->close();
				$page->HeaderLocation("guestbook.php");
				exit;
			}
		}
	}
} elseif(isset($_GET["id"])) {
	/*** edit existing entry ***/
	$na = new stdClass();
	$na->session = "stilili";
	$na->url = "guestbook.php";
	$page->NotAllowed($na);
	$id = $_GET["id"];
	$catch = $page->DB_IdManage("SELECT * FROM `guestbook` WHERE `id` = ?", $id);
	$catch->bind_result($id, $date, $time, $author, $place, $comment);
	$catch->fetch();
	$catch->close();
	$datetime = $page->ConvertDate("$date $time", true, true);
	$year     = $datetime->year;
	$month    = $datetime->month;
	$day      = $datetime->day;
	$hour     = $datetime->hour;
	$minute   = $datetime->minute;
	$second   = $datetime->second;
	$auth    = $page->SQL2field($author);
	$loc     = $page->SQL2field($place);
	$com = $page->SQL2paragraph($comment);
	$title = "Modifier le commentaire #$id de $auth";
}

$body = "";

$body .= $page->SetTitle($title);
$page->CSS_ppJump();
$page->CSS_ppWing();
$page->CSS_Push("guestbook");
$page->js_Form();

$page->HotBooty();

$gohome = new stdClass();
$gohome->page = "guestbook";
$gohome->rootpage = "..";
$body .= $page->GoHome($gohome);
$body .= $page->Languages();


$body .= "<div class=\"guestcontent\">\n";

$body .= $page->FormTag();


$body .= "<div class=\"hidden\">\n";
/* ID */
if($id > 0) {
	$body .= "<input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
}
/* DATE AND TIME */
$body .= "<input type=\"hidden\" name=\"year\"   value=\"$year\" />\n";
$body .= "<input type=\"hidden\" name=\"month\"  value=\"$month\" />\n";
$body .= "<input type=\"hidden\" name=\"day\"    value=\"$day\" />\n";
$body .= "<input type=\"hidden\" name=\"hour\"   value=\"$hour\" />\n";
$body .= "<input type=\"hidden\" name=\"minute\" value=\"$minute\" />\n";
$body .= "<input type=\"hidden\" name=\"second\" value=\"$second\" />\n";
$body .= "</div>\n";

/* NICKNAME */
$field = new stdClass();
$field->type = "text";
$field->name = "nick";
$field->title = $nick;
$field->value = $auth;
$field->css = "newguestnick";
$field->required = true;
$field->autofocus = true;
$field->size = 30;
$body .= $page->FormField($field);
/* PLACE */
$field = new stdClass();
$field->type = "text";
$field->name = "place";
$field->title = $theplace;
$field->value = $loc;
$field->size = 30;
$field->css = "newguestpalce";
$body .= $page->FormField($field);
/* ANTI-TOURISTES */
	$nobot = GetNobo($page);
	$antitouristid = $nobot->id;
	$question      = $nobot->question;
	$field = new stdClass();
	$field->type = "text";
	$field->name = "antitourist";
	$field->title = "$question&nbsp;?";
	$field->value = "";
	$field->nodiv = true;
	$field->required = true;
$body .= "<div class=\"insantitouristes\">\n";
$body .= "<b>Test humain</b> (r&eacute;pondre en minuscules, au masculin et sans chiffres)&nbsp;:<br />\n";
$body .= $page->FormField($field);
$body .= "<input type=\"hidden\" name=\"antitouristid\" value=\"$antitouristid\" />\n";
$body .= "</div>\n";
/* COMMENT */
$field = new stdClass();
$field->type = "textarea";
$field->name = "comment";
$field->title = $thecomment;
$field->value = $com;
$field->css = "newguestcomment";
$field->required = true;
$field->rows = 8;
$field->cols = 48;
$body .= $page->FormField($field);
$body .= "<div class=\"guestortho\">\n";
$body .= "$ortho\n";
$body .= "</div>\n";
/* BUTTONS */
$butt = new stdClass();
$butt->css = "newguestbuttons";
$butt->CloseTag = true;
$butt->cancelURL = "guestbook.php";
$body .= $page->SubButt($id > 0, "le mot #$id de $auth", $butt);

$body .= "</div>\n";

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
