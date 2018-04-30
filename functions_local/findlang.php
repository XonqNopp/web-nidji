<?php
function GetBestLang(PhPage $page, $french, $wolof, $manding, $css = "") {
	$body = "";
	if($french != "" || $wolof != "" || $manding != "") {
		if($css != "NODIV") {
			$body .= "<div class=\"$css\">\n";
		}
		if($wolof != "" && ($page->CheckSessionLang($page->GetWolof()) || ($page->CheckSessionLang($page->GetMandinka()) && $manding == "") || ($page->CheckSessionLang($page->GetFrench()) && $french == ""))) {
			$page->ln_3(5, "(GetBestLang) wolof chosen");
			if($css != "NODIV" && !$page->CheckSessionLang($page->GetWolof())) {
				$body .= "<b>Wolof&nbsp;:</b><br />\n";
			}
			$body .= $wolof;
		} elseif($manding != "" && ($page->CheckSessionLang($page->GetMandinka()) || ($wolof == "" && $french == "" && ($page->CheckSessionLang($page->GetWolof()) || $page->CheckSessionLang($page->GetFrench()))))) {
			$page->ln_3(5, "(GetBestLang) manding chosen");
			if($css != "NODIV" && !$page->CheckSessionLang($page->GetMandinka())) {
				$body .= "<b>Manding&nbsp;:</b><br />\n";
			}
			$body .= $manding;
		} else {
			$page->ln_3(5, "(GetBestLang) french chosen");
			if($css != "NODIV" && !$page->CheckSessionLang($page->GetFrench())) {
				$body .= "<b>Fran&ccedil;ais&nbsp;:</b><br />\n";
			}
			$body .= $french;
		}
		if($css != "NODIV") {
			$body .= "</div>\n";
		}
	}
	return $body;
}
?>
