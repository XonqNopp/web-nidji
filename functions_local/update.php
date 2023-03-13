<?php
/*** Created: Wed 2015-02-18 08:00:09 CET
 * TODO:
 */
function update(PhPage $page) {
	$Atag = "a href=\"nidji/activites/agenda.php\" title=\"agenda\"";
	$back = "";
	$back .= "<div class=\"update\">\n";
	$back .= "<div class=\"marquee\">\n";
	$back .= "<span>\n";
	$back .= "<$Atag>";
	// update
	$update = $page->DB_NextLast("agenda", true, true);
	$update_txt = $page->HighFive($update->what) . " activit&eacute; ";
	if($update->special != "") {
		$update_txt .= $update->special;
	} else {
		$update_txt .= "le " . $update->when->day . " " . $update->when->month . " " . $update->when->year;
	}
	$back .= $update_txt;
	$back .= ", &agrave; voir dans l'</a><$Atag class=\"agenda\">agenda</a>\n";
	$back .= "</span>\n";
	$back .= "</div>\n";
	$back .= "</div>\n";
	return $back;
}
?>
