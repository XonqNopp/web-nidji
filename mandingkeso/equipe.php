<?php
/*** Created: Fri 2014-09-19 11:56:48 CEST
 ***
 *** TODO:
 ***
 ***/
require("../functions/classPage.php");
$rootPath = "..";
$funcpath = "$rootPath/functions";
require("${funcpath}_local/copyright.php");
$page = new PhPage($rootPath);
//$page->LogLevelUp(6);
$page->initDB();

if($page->CheckSessionLang($page->GetWolof())) {
	$page_title = 'L&#039;&eacute;quipe derri&egrave;re ce beau projet';
	$sub = "Voici ceux qui nous ont apport&eacute; un pr&eacute;cieux soutien depuis le d&eacute;but de l'aventure.";
	$sorry = 'D&eacute;sol&eacute;, les membres ne sont pas encore &eacute;crits sur le site...';
	//$warnmail = 'Pour &eacute;crire un mail, veuillez remplacer le _AT_ par le caract&egrave;re &#64; merci&nbsp;!';
} elseif($page->CheckSessionLang($page->GetMandinka())) {
	$page_title = 'L&#039;&eacute;quipe derri&egrave;re ce beau projet';
	$sub = "Voici ceux qui nous ont apport&eacute; un pr&eacute;cieux soutien depuis le d&eacute;but de l'aventure.";
	$sorry = 'D&eacute;sol&eacute;, les membres ne sont pas encore &eacute;crits sur le site...';
	//$warnmail = 'Pour &eacute;crire un mail, veuillez remplacer le _AT_ par le caract&egrave;re &#64; merci&nbsp;!';
} else {
	$page_title = 'L&#039;&eacute;quipe derri&egrave;re ce beau projet';
	$sub = "Voici ceux qui nous ont apport&eacute; un pr&eacute;cieux soutien depuis le d&eacute;but de l'aventure.";
	$sorry = 'D&eacute;sol&eacute;, les membres ne sont pas encore &eacute;crits sur le site...';
	//$warnmail = 'Pour &eacute;crire un mail, veuillez remplacer le _AT_ par le caract&egrave;re &#64; merci&nbsp;!';
}

$membres = $page->DB_QueryManage("SELECT * FROM `team` ORDER BY `priority` DESC, `name` ASC, `id` ASC");

$page->SetTitle($page_title);
$page->CSS_ppJump();
$page->CSS_ppWing();

$body = "";
$page->HotBooty();

$args = new stdClass();
$args->rootpage = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();


$body .= "<div class=\"headbanner\">\n";
$body .= "<div class=\"imgheader\">\n";
$body .= "<img src=\"../pictures/divers/equipeHeader.png\" alt=\"$page_title\" title=\"$page_title\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"headtxtarea\">\n";
$body .= "<div class=\"headtxt\">\n";
$body .= $sub;
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "</div>\n";
$body .= "<div class=\"team_main\">\n";

if($membres->num_rows > 0) {
	$k = 0;
	$max = 5;
	$oldp = 10;
	$body .= "<div class=\"membres\">\n";
	$body .= "<div class=\"csstab64_table\">\n";
	$body .= "<div class=\"csstab64_row rk10\">\n";
	while($m = $membres->fetch_object()) {
		$id = $m->id;
		$name = $m->name;
		$function = $m->function;
		$comment = $m->comment;
		$priority = $m->priority;
		if($priority < $oldp) {
			$oldp = $priority;
			$body .= "</div>\n";
			$body .= "<div class=\"csstab64_row rk$priority\">\n";
			$k = 0;
		}
		$large = "";
		//if( $priority < 0 || $priority > 9 ) {
			//$large = " colspan=\"2\"";
		//}
		$body .= "<div class=\"csstab64_cell\">\n";
		$body .= "<div class=\"membrename\">$name</div>\n";
		if($function != "") {
			$body .= "<div class=\"membrefunction\">$function</div>\n";
		}
		if($comment != "") {
			$body .= "<div class=\"membrecomment\">$comment</div>\n";
		}
		$body .= "</div>\n";
		if($k < $max) {
			$k++;
		} else {
			$k = 0;
			$body .= "</div>\n";
			$body .= "<div class=\"csstab64_row rk$priority\">\n";
		}
	}
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
} else {
	$body .= "<div class=\"warning\">$sorry</div>\n";
}
$membres -> close();
$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
