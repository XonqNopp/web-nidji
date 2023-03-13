<?php
/*** Created: Thu 2014-12-04 12:51:59 CET
 ***
 *** TODO:
 ***
 ***/
function GetNobo(PhPage $page) {
	$back = new stdClass();
	$page->ln_3(6, "GetNobo()", "sobonana.php");
	//// Check language
	$BotLang = $page->GetSessionLang();
	$test = $page->DB_QueryManage("SELECT * FROM `tourist` WHERE `language` = '$BotLang'");
	if($test->num_rows == 0) {
		$BotLang = "french";
	}
	$test->close();
	$page->ln_3(6, "GetNobo lang=$BotLang", "sobonana.php");
	//// Get one
	$numtourists = $page->DB_QueryManage("SELECT `id` FROM `tourist` ORDER BY `id` DESC LIMIT 1");
	$get = $numtourists->fetch_object();
	$numtourists->close();
	$maxtourist = $get->id;
	$page->ln_3(6, "GetNobo maxid=$maxtourist", "sobonana.php");
	do {
		$antitouristid = mt_rand(1, $maxtourist);
		$essai = $page->DB_QueryManage("SELECT * FROM `tourist` WHERE `language` = '$BotLang' AND `id` = $antitouristid");
	} while($essai->num_rows == 0);
	$anti = $essai->fetch_object();
	$essai->close();
	//// return
	$back->id       = $anti->id;
	$back->question = $anti->question;
	$page->ln_3(6, "GetNobo id=$anti->id", "sobonana.php");
	$page->ln_3(6, "GetNobo end", "sobonana.php");
	return $back;
}

function CheckNobo(PhPage $page, $id, $answer) {
	$page->ln_3(6, "CheckNobo($id, $answer)", "sobonana.php");
	$check = $page->DB_QueryManage("SELECT * FROM `tourist` WHERE `id` = $id");
	$check_answer = $check->fetch_object();
	$check->close();
	return $page->hache($answer, $check_answer->answer);
}
?>
