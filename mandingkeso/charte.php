<?php
/*** Created: Fri 2014-09-19 13:36:31 CEST
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

//if($page->CheckSessionLang($page->GetWolof())) {
//} elseif($page->CheckSessionLang($page->GetMandinka())) {
//} else {
	$pdf = "La charte en PDF";
//}

$page->CSS_ppJump();
$page->CSS_ppWing();

$body = "";
$args = new stdClass();
$args->rootpage = "..";
$body .= $page->GoHome($args);
$body .= $page->Languages();
$body .= $page->SetTitle("Charte de voyage");
$page->HotBooty();


$body .= "<div class=\"chartebody\">\n";
/*** Marcher ***/
$body .= "<h3 class=\"charte\">Marcher</h3>\n";
$body .= "<p class=\"charte\">\n";
$body .= "Poser nos pas dans ceux des habitants des pays mandingues afin que leurs traces \n";
$body .= "se renforcent et deviennent visibles aux yeux du monde.\n";
$body .= "</p>\n";
/*** Observer ***/
$body .= "<h3 class=\"charte\">Observer</h3>\n";
$body .= "<p class=\"charte\">\n";
$body .= "Avec l&#039;aide de tous nos sens, nous impr&eacute;gner du climat ambiant \n";
$body .= "de chacun des villages travers&eacute;s, avec l&#039;intention de nous \n";
$body .= "familiariser avec les modes de vie et non de les juger.\n";
$body .= "</p>\n";
/*** Rencontrer ***/
$body .= "<h3 class=\"charte\">Rencontrer</h3>\n";
$body .= "<p class=\"charte\">\n";
$body .= "Ne forcer aucune porte, aucune bouche&nbsp;! N&#039;offenser aucun coeur. \n";
$body .= "Manipuler la parole avec prudence, en respectant les usages en vigueur au \n";
$body .= "sein des communaut&eacute;s visit&eacute;es et en nous adressant prioritairement \n";
$body .= "au chef de village avant de nous entretenir avec d&#039;autres villageois.\n";
$body .= "</p>\n";
/*** Accueillir ***/
$body .= "<h3 class=\"charte\">Accueillir</h3>\n";
$body .= "<p class=\"charte\">\n";
$body .= "R&eacute;server un accueil sinc&egrave;re et respectueux &agrave; toutes \n";
$body .= "les personnes qui nous offrirons le r&eacute;cit d&#039;une parcelle de leur \n";
$body .= "vie, de l&#039;histoire d&#039;un village, d&#039;une famille&nbsp;?\n";
$body .= "</p>\n";
/*** Chercher ***/
$body .= "<h3 class=\"charte\">Chercher</h3>\n";
$body .= "<p class=\"charte\">\n";
$body .= "Retrouver l&#039;origine et comprendre la signification des actes \n";
$body .= "pos&eacute;s actuellement par les populations rencontr&eacute;es &agrave; \n";
$body .= "l&#039;occasion des f&ecirc;tes et des rites de passage afin de mettre \n";
$body .= "en lumi&egrave;re la richesse de leur symbolique.\n";
$body .= "</p>\n";
/*** Graver ***/
$body .= "<h3 class=\"charte\">Graver</h3>\n";
$body .= "<p class=\"charte\">\n";
$body .= "Imprimer dans les m&eacute;moires les gestes significatifs que les descendants \n";
$body .= "de l&#039;Empire du Manding effectuent jusqu&#039;&agrave; nos jours pour \n";
$body .= "franchir les &eacute;tapes de la vie, au moyen de documents visuels&nbsp;: \n";
$body .= "r&eacute;cits, photos, reportages&nbsp;?\n";
$body .= "</p>\n";
/*** Raconter ***/
$body .= "<h3 class=\"charte\">Raconter</h3>\n";
$body .= "<p class=\"charte\">\n";
$body .= "Utiliser nos voix pour r&eacute;p&eacute;ter les paroles re&ccedil;ues des \n";
$body .= "anciens, afin que les messages d&eacute;livr&eacute;s soient entendus par \n";
$body .= "leurs descendances souvent exil&eacute;es ainsi que par les occidentaux qui \n";
$body .= "m&eacute;connaissent l&#039;Afrique dans sa complexit&eacute;.\n";
$body .= "</p>";
/*** PDF ***/
$body .= "<div class=\"chartepic\">\n";
$body .= "<img alt=\"kora\" title=\"kora\" src=\"../pictures/divers/kora.png\" />\n";
$body .= "</div>\n";
$body .= "<div class=\"chartepdf\">\n";
$body .= "<a href=\"../pdfs/charte.pdf\" title=\"$pdf\">$pdf</a>\n";
$body .= "</div>\n";

$body .= "</div>\n";


$body .= "<div class=\"wide\">\n";
$body .= copyright();
$body .= $page->AdminLink();
$body .= "</div>\n";

$page->show($body);
unset($page);
?>
