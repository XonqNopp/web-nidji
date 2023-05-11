<?php
/*** Created: Tue 2014-09-23 13:13:44 CEST
 ***/
require("functions/classPage.php");
$funcpath = "functions";
require("{$funcpath}_local/copyright.php");
require("{$funcpath}_local/sobonana.php");
$page = new PhPage();

//$page->initHTML();
//$page->LogLevelUp(6);


function SwitchType($type) {
	$back = new stdClass();
	switch($type) {
		case "album":
			$back->GetBack = "mandingkeso/photos_collection";
			$back->parachute = "mandingkeso";
			break;
		case "photo":
			$back->GetBack = "mandingkeso/photos_display";
			$back->parachute = "mandingkeso";
			break;
		case "conte":
			$back->GetBack = "nidji/culture/contes_display";
			$back->parachute = "nidji/culture";
			break;
		case "video":
			$back->GetBack = "mandingkeso/video";
			$back->parachute = "mandingkeso";
			break;
		default:
			break;
	}
	return $back;
}



$GetBack = new stdClass();
$GetBack->id = 0;
if(isset($_POST["id"])) {
	$GetBack->id = $_POST["id"];
	$st = SwitchType($_POST["type"]);
	$GetBack->page = $st->GetBack;
}

$page->initDB();
$parachutePath = new stdClass();

if($page->CheckSessionLang($page->GetWolof())) {
	$title = "Dolli yobbante";
	$name = "Tuur bi";
	$thecomment = "Yobbante";
	$ortho = "Merci d&#039;&eacute;crire vos commentaires correctement (en &eacute;vitant le langage SMS)...";
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$title = "Kuno kafu";
	$name = "To";
	$thecomment = "Kuno";
	$ortho = "Merci d&#039;&eacute;crire vos commentaires correctement (en &eacute;vitant le langage SMS)...";
} else {
	$title = "Ajouter un commentaire";
	$name = "Pr&eacute;nom";
	$thecomment = "Commentaire";
	$ortho = "Merci d&#039;&eacute;crire vos commentaires correctement (en &eacute;vitant le langage SMS)...";
}


// init vars
$comid = 0;
$id = 0;
$type = "";
$now = $page->GetNow();
$year = $now->year;
$month = $now->month;
$day = $now->day;
$hour = $now->hour;
$minute = $now->minute;
$second = $now->second;
$author = "";
$auth = "";
$comm = "";



if(isset($_POST["antitouristid"])) {
	if(isset($_POST["comid"])) {
		$comid = $_POST["comid"];
	}
	$comm = $_POST["comment"];
	$type = $_POST["type"];
	$id = $_POST["id"];
	$year = $_POST["year"];
	$month = $_POST["month"];
	$day = $_POST["day"];
	$hour = $_POST["hour"];
	$minute = $_POST["minute"];
	$second = $_POST["second"];
	$auth = $_POST["author"];
	$MayEx = true;
	//
	if(!CheckNobo($page, $_POST["antitouristid"], $_POST["antitourist"])) {
		$page->NewError("Mauvaise reponse...");
		$MayEx = false;
		$st = SwitchType($type);
		$GetBack->page = $st->GetBack;
		$parachutePath->newpath = $st->parachute;
		$page->CSS_Path("parachute", $parachutePath);
	} else {
		if(isset($_POST["erase"])) {
			/*** POST erase ***/
			$na = new stdClass();
			$na->session = "stilili";
			$page->NotAllowed($na);
			//
			$comid = $_POST["comid"];
			$erase = $page->DB_QueryPrepare("DELETE FROM `" . $page->ddb->DBname . "`.`comments` WHERE `comments`.`id` = ? LIMIT 1;");
			$erase->bind_param("i", $comid);
			$page->DB_ExecuteManage($erase);
			//
			$type = $_POST["type"];
			$typid = $_POST["id"];
			$goto = "index.php";
			if($type == "photo") {
				$goto = "mandingkeso/photos_display.php?id=$typid";
			} elseif($type == "album") {
				$goto = "mandingkeso/photos_collection.php?id=$typid";
			} elseif($type == "conte") {
				$goto = "nidji/culture/contes_display.php?id=$typid";
			} elseif($type == "video") {
				$goto = "mandingkeso/video.php?id=$typid";
			}
			$page->HeaderLocation($goto);
		} elseif(isset($_POST["id"])) {
			/*** POST update/add ***/
			$author = $page->field2SQL($auth);
			$comment = $page->paragraph2SQL($comm, "comment");
			$dt = new stdClass();
			$dt->year = $year;
			$dt->month = $month;
			$dt->day = $day;
			$dt->hour = $hour;
			$dt->minute = $minute;
			$dt->second = $second;
			$datetime = $page->ConvertDate($dt, true, true);
			$date = $datetime->date;
			$time = $datetime->time;
			if(isset($_POST["comid"])) {
				/*** update ***/
				$na = new stdClass();
				$na->session = "stilili";
				$page->NotAllowed($na);
				//
				$comid = $_POST["comid"];
				$query = $page->DB_QueryPrepare("UPDATE `" . $page->ddb->DBname . "`.`comments` SET `author` = ?, `comment` = ? WHERE `comments`.`id` = ? LIMIT 1;");
				$query->bind_param("sss", $author, $comment, $comid);
			} else {
				/*** insert ***/
				$query = $page->DB_QueryPrepare("INSERT INTO `" . $page->ddb->DBname . "`.`comments` (`date`, `time`, `whichone`, `whichid`, `author`, `comment`) VALUES(?, ?, ?, ?, ?, ? );");
				$query->bind_param("ssssss", $date, $time, $type, $id, $author, $comment);
			}
			if($MayEx) {
				$page->DB_ExecuteManage($query);
			}
			$goto = "index.php";
			switch($type) {
				case "album":
					$goto = "mandingkeso/photos_collection.php?id=$id";
					break;
				case "photo":
					$goto = "mandingkeso/photos_display.php?id=$id";
					break;
				case "conte":
					$goto = "nidji/culture/contes_display.php?id=$id";
					break;
				case "video":
					$goto = "mandingkeso/video.php?id=$id";
					break;
				default:
					break;
			}
			$page->HeaderLocation($goto);
		}
	}
	//
	/*** For those who stay here: ***/
	if($type == "photo") {
		$query = $page->DB_IdManage("SELECT * FROM `photos` WHERE `id` = ?", $id);
		$query->bind_result($id, $date, $time, $place, $album, $picname, $pictitle, $french, $wolof, $manding);
		$query->fetch();
		$query->close();
		$path = "album$album/$picname";
	}
//} else {
	//$page->NewError("Bot spotted");
	//$mayEx = false;
}


/*** edit existing ***/
if(isset($_GET["edit"])) {
	$na = new stdClass();
	$na->session = "stilili";
	$page->NotAllowed($na);
	$comid = $_GET["edit"];
	$query = $page->DB_IdManage("SELECT * FROM `comments` WHERE `id` = ?", $comid);
	$query->bind_result($comid, $date, $time, $type, $id, $auth, $comm);
	$query->fetch();
	$query->close();
	$datetime = $page->ConvertDate("$date $time", true, true);
	$year     = $datetime->year;
	$month    = $datetime->month;
	$day      = $datetime->day;
	$hour     = $datetime->hour;
	$minute   = $datetime->minute;
	$second   = $datetime->second;
	$title = "Modifier le commentaire #$comid pour $type #$id";
	$GetBack->id = $id;
	$st = SwitchType($type);
	$GetBack->page = $st->GetBack;
	$parachutePath->newpath = $st->parachute;
	$page->CSS_Path("parachute", $parachutePath);
	$auth = $page->SQL2field($auth);
	$comm = $page->SQL2paragraph($comm);
	if($type == "photo") {
		$query = $page->DB_IdManage("SELECT * FROM `photos` WHERE `id` = ?", $id);
		$query->bind_result($id, $date, $time, $place, $album, $picname, $pictitle, $french, $wolof, $manding);
		$query->fetch();
		$query->close();
		$path = "album$album/$picname";
	}
}

/*** where does user come from ***/
if(isset($_GET["id"])) {
	$id = $_GET["id"];
	$type = $_GET["type"];
	$GetBack->id = $id;
	$st = SwitchType($type);
	$GetBack->page = $st->GetBack;
	$parachutePath->newpath = $st->parachute;
	$page->CSS_Path("parachute", $parachutePath);
	if($type == "photo") {
		$query = $page->DB_IdManage("SELECT * FROM `photos` WHERE `id` = ?", $id);
		$query->bind_result($id, $date, $time, $place, $album, $picname, $pictitle, $french, $wolof, $manding);
		$query->fetch();
		$query->close();
		$path = "album$album/$picname";
	}
}



$page->CSS_Push("photos", "mandingkeso");
$page->js_Form();

$body = "";
$GetBack->rootpage = "index";
$body .= $page->GoHome($GetBack);
$body .= $page->Languages();
$body .= $page->SetTitle($title);
$page->HotBooty();


$body .= $page->FormTag();
//
	//// HIDDEN
	$body .= "<div class=\"hidden\">\n";
	if($comid > 0) {
		$body .= "<input type=\"hidden\" name=\"comid\" value=\"$comid\" />\n";
	}
	$body .= "<input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
	$body .= "<input type=\"hidden\" name=\"type\" value=\"$type\" />\n";
	$body .= "<input type=\"hidden\" name=\"year\" value=\"$year\" />\n";
	$body .= "<input type=\"hidden\" name=\"month\" value=\"$month\" />\n";
	$body .= "<input type=\"hidden\" name=\"day\" value=\"$day\" />\n";
	$body .= "<input type=\"hidden\" name=\"hour\" value=\"$hour\" />\n";
	$body .= "<input type=\"hidden\" name=\"minute\" value=\"$minute\" />\n";
	$body .= "<input type=\"hidden\" name=\"second\" value=\"$second\" />\n";
	$body .= "</div>\n";
//
	//// PHOTO
	if($type == "photo") {
		$body .= "<div class=\"ncpic\">\n";
		$body .= "<img alt=\"$pictitle\" title=\"$pictitle\" src=\"pictures/$path\" />\n";
		$body .= "</div>\n";
	}
//
	//// ORTHO
	$body .= "<div class=\"orthocomment\">$ortho</div>\n";
//
	//// AUTHOR
	$field = new stdClass();
	$field->type = "text";
	$field->name = "author";
	$field->value = $auth;
	$field->title = $name;
	$field->css = "ncauthor";
	$field->size = 30;
	$field->autofocus = true;
	$field->required = true;
	$body .= $page->FormField($field);
//
	//// COMMENT
	$field = new stdClass();
	$field->type = "textarea";
	$field->title = $thecomment;
	$field->name = "comment";
	$field->value = $comm;
	$field->css = "nccomment";
	$field->required = true;
	$field->rows = 8;
	$field->cols = 48;
	$body .= $page->FormField($field);
//
	//// ANTI-tourist
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
	$field->jsChanged = false;
	$body .= "<div class=\"comantitourist\">\n";
	$body .= "<b>Test humain</b> (r&eacute;pondre en minuscules, au masculin et sans chiffres)&nbsp;:<br />\n";
	$body .= $page->FormField($field);
	$body .= "<input type=\"hidden\" name=\"antitouristid\" value=\"$antitouristid\" />\n";
	$body .= "</div>\n";
//
	//// BUTTONS
	$butt = new stdClass();
	$butt->css = "ncbut";
	$butt->CloseTag = true;
	$body .= $page->SubButt($comid > 0, "le commentaire #$comid de $auth", $butt);
//


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
