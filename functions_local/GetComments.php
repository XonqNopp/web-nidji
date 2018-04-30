<?php
function GetComments(PhPage $page, $id, $which, stdClass $varargin = null) {
	$page->ln_3(6, "(local) GetComments(..., $id, $which, ...)");
	/*** varargin ***/
	$css = "";
	$sort = "ASC";
	$path = "";
	if($varargin !== NULL) {
		foreach($varargin as $k => $v) {$$k = $v;}
	}
	if($path != "" && $path != "/") {
		$path = "$path/";
	}
	/*** /varargin ***/
	$UserIsAdmin = $page->UserIsAdmin();
	if($page->CheckSessionLang($page->GetWolof())) {
		$addcom = "Dolli yobbante";
	} elseif($page->CheckSessionLang($page->GetMandinka())) {
		$addcom = "Kuno kafu";
	} else {
		$addcom = "Ajouter un commentaire";
	}
	$body = "";
	$comments = $page->DB_QueryManage("SELECT * FROM `comments` WHERE `whichone` = '$which' AND `whichid` = $id ORDER BY `date` $sort, `time` $sort");
	$body .= "<div class=\"{$css}comtable\">\n";
	$body .= "<div class=\"csstab64_table com_table\">\n";
	while($each = $comments->fetch_object()) {
		$comid = $each->id;
		$body .= "<div class=\"csstab64_row\">\n";
		$body .= "<div class=\"csstab64_cell com\">\n";
		$body .= "<div class=\"comauthor\">\n";
		$body .= "$each->author\n";
		if($UserIsAdmin) {
			$body .= "&nbsp;<a href=\"{$path}comment_insert.php?edit=$comid\" title=\"modifier\">(modifier)</a>\n";
		}
		$body .= "</div>\n";
		$body .= "<div class=\"comdate\">$each->date, $each->time</div>\n";
		$body .= "<div class=\"comcontent\">$each->comment</div>\n";
		$body .= "</div>\n";
		$body .= "</div>\n";
	}
	$comments->close();
	$body .= "<div class=\"csstab64_row\">\n";
	$col = "csstab64_cell addcom";
	if($UserIsAdmin) {
		$col .= " wide";
	}
	$body .= "<div class=\"$col\">\n";
	$body .= "<a href=\"{$path}comment_insert.php?id=$id&amp;type=$which\" title=\"$addcom\">$addcom</a>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	$body .= "</div>\n";
	return $body;
}
?>
