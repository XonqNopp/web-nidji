<?php
function get_cat_full($cat = "")
{
	$categories = array( 
		"contes"     => "contes",
		"conference" => "conf&eacute;rence",
		"temoignage" => "t&eacute;moignage",
		"diaporama"  => "diaporama",
		"senegal"    => "soir&eacute;e S&eacute;n&eacute;gal",
		"stand"      => "stand d&#039;information",
		"spectacle"  => "spectacle"
	);
	if($cat == "") {
		return $categories;
	} else {
		return $categories[$cat];
	}
}

function get_public_full($public = "")
{
	$publics = array(
		"tout"      => "tout public",
		"enfants"   => "enfants",
		"ados"      => "ados",
		"etudiants" => "&eacute;tudiants",
		"adultes"   => "adultes",
		"membres"   => "membres"
	);
	if($public == "") {
		return $publics;
	} else {
		return $publics[$public];
	}
}
?>
