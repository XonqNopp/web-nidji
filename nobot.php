<?php
/*** Created: Tue 2014-12-09 12:55:37 CET
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

$UserIsSuper = $page->UserIsSuper();

$body = "";
$gohome = new stdClass();
$gohome->page = "admin";
$gohome->rootpage = "index";
$body .= $page->GoHome($gohome);
$body .= "<div id=\"thebody\">\n";
$body .= $page->SetTitle("Questions anti-bot");
$page->HotBooty();


$getthem = $page->DB_QueryManage("SELECT * FROM `tourist` ORDER BY `language` ASC, `question` ASC");
if($UserIsSuper) {
	$body .= "<div class=\"touristadmin\">\n";
	$body .= "<a href=\"nobot_insert.php\" title=\"Ajouter une question\">Ajouter une question</a>\n";
	$body .= "</div>\n";
}

$body .= "<div class=\"touristtable\">\n";
if($getthem->num_rows == 0) {
	$body .= "D&eacute;sol&eacute;, il n&#039;y a pas encore de questions anti-tourists...\n";
} else {
	$body .= "<table class=\"tourist\">\n";
	$body .= "<tr>\n";
	$body .= "<th></th>\n";
	$body .= "<th>Question</th>\n";
	$body .= "<th>R&eacute;ponse crypt&eacute;e</th>\n";
	$body .= "</tr>\n";
	$old = "";
	$lg = array("french" => "Fran&ccedil;ais", "wolof" => "Wolof", "manding" => "Manding");
	while($one = $getthem->fetch_object()) {
		$id = $one->id;
		$language = $one->language;
		$question = $one->question;
		$answer   = $one->answer;
		$MaxAnswer = 20;
		if(strlen($answer) > $MaxAnswer) {
			$answer = substr($answer, 0, $MaxAnswer) . "...";
		}
		if($old != $language) {
			$old = $language;
			$body .= "<tr class=\"tourist\">\n";
			$body .= "<td colspan=\"3\" class=\"lang\">" . $lg[$language] . "</td>\n";
			$body .= "</tr>\n";
		}
		$body .= "<tr class=\"tourist\">\n";
		$body .= "<td class=\"edit\">\n";
		if($UserIsSuper) {
			$body .= "<a href=\"nobot_insert.php?id=$id\" title=\"Modifier\">Modifier</a>\n";
		}
		$body .= "</td>\n";
		$body .= "<td class=\"quest\">$question?</td>\n";
		$body .= "<td class=\"quest\">$answer</td>\n";
		$body .= "</tr>\n";
	}
	$body .= "</table>\n";
}
$getthem->close();
$body .= "</div>\n";
$body .= "</div>\n";


$page->show($body);
unset($page);
?>
