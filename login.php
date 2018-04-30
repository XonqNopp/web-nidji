<?php
/*** Created: Tue 2014-09-23 07:56:19 CEST
 ***
 *** TODO:
 ***
 ***/
require("functions/classPage.php");
$funcpath = "functions";
require("${funcpath}_local/copyright.php");
$page = new PhPage();

$loginOK = new stdClass();
if(isset($_GET["from"])) {
	$loginOK->redirect = $_GET["from"];
}
$page->LoginCookie($loginOK);
//$page->LogLevelUp(6);


$name = "Nom";
$password = "Mot de passe";
$ok = "Valider";

$nick = "";
if(isset($_POST["submit"])) {
	$nick = $_POST["username"];
	$pw   = $_POST["password"];
	if(isset($_POST["from"]) && $_POST["from"] != "") {
		$loginOK->redirect = $_POST["from"];
	}
	if(// GI
		$page->hache($nick, "3a3c64bb7b37ad030d1b6c3ce2c29aaf4f1df091ebb737fc5a9a2761de1def405ec19b26a77206b70f44c808d482b96ecdb33df426aeba7b52663d2c762b4bc6")
		&& $page->hache($pw, "64a585b437ab29eac88e1970f4347140cef6021c20e0466ab3912d04b7f044053e5e31f59c52d123037c8235c60a10f11302e5b7466d12be1480a3a38aa534d4")
	) {
		$loginOK->level = 2;
		$page->LoginSuccessful($loginOK);
	} elseif(// stilili
		$page->hache($nick, "3a3c64bb7b37ad030d1b6c3ce2c29aaf4f1df091ebb737fc5a9a2761de1def405ec19b26a77206b70f44c808d482b96ecdb33df426aeba7b52663d2c762b4bc6")
		&& $page->hache($pw, "5fd265786ffd56b10b06f8539db28aac4e1107a7dcdee4b83132a17c2e59e3da9eff326bd01a500ec2f8261e10e28e839c95d430a4dc0d876d8b746d14da04a8")
	) {
		$loginOK->level = 1;
		$page->LoginSuccessful($loginOK);
	} else {
		$page->NewError("Mot de passe erron&eacute;!");
	}
}


$body = "";
$body .= $page->GoHome();
$body .= $page->Languages();
$body .= $page->SetTitle("Veuillez vous identifier");
$page->HotBooty();

$body .= $page->FormTag();

$field = new stdClass();
$field->type = "text";
$field->name = "username";
$field->value = $nick;
$field->title = $name;
$field->css = "loginname";
$field->autofocus = true;
$body .= $page->FormField($field);

$field->type = "password";
$field->name = "password";
$field->value = "";
$field->title = "Mot de passe";
$field->css = "loginpwd";
$field->autofocus = false;
$body .= $page->FormField($field);

$field->type = "hidden";
$field->name = "from";
$field->title = "";
$field->css = "";
$field->value = "";
if(isset($_GET["from"])) {
	$field->value = $_GET["from"];
}
$body .= $page->FormField($field);

$butt = new stdClass();
$butt->erase_allowed = false;
$butt->CloseTag = true;
$butt->add = $ok;
$butt->css = "loginsubmit";
$body .= $page->SubButt(false, null, $butt);

$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
