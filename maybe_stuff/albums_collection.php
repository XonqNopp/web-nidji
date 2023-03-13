<?php
session_start();
require("functions/session.php");
session("french");
require("functions/w3c.php");
require("functions/language.php");
require("functions/headers.php");
require("functions/connection.php");
require("functions/gohome.php");
require("functions/adminlink.php");
require("functions/convert.php");
$link = connection( "nidji" );
if( $_SESSION[ 'language' ] == 'french' ) {
	$title = 'Albums de photos';
} elseif( $_SESSION[ 'language' ] == 'wolof' ) {
	$title = 'Su&ntilde;uy portale';
} else {
	$title = 'Nna portale lu';
}
if( !$albums = $link -> query( "SELECT * FROM `albums` ORDER BY `id` ASC" ) ) {
	displerr( $albums, $link );
}
/* admin */
$body = '';
if( $_SESSION[ 'stilili' ] ) {
	$body .= '<div id="albumadmin"><a href="albumedition.php" title="Ajouter un album">Ajouter un album</a></div>' . "\n";
}
/* table */
$body .= '<div class="albums">' . "\n";
$body .= '<table class="albums">' . "\n";
$body .= '<tr class="albums">' . "\n";
$k = 0;
$max = 6;
while( $entry = $albums -> fetch_assoc() ) {
	//$albname = $entry[ 'name' ];
	$albid = $entry[ 'id' ];
	$albtitle = tohtml( $entry[ 'title' ] );
	/*
	$albWtitle = tohtml( $entry[ 'woloftitle' ] );
	if( $_SESSION[ 'language' ] == 'french' ) {
		$albtitle = $albFtitle;
	} else {
		$albtitle = $albWtitle;
	}
	*/
	$body .= '<td class="albums">' . "\n";
	//$body .= '' . "\n";
	if( $entry[ 'picid' ] != 'NULL' && $entry[ 'picid' ] != '' ) {
		$pics = $link -> query( "SELECT * FROM `photos` WHERE `id` = " . $entry[ 'picid' ] );
		if( $pics -> num_rows > 0 ) {
			$pic = $pics -> fetch_assoc();
			$picname = tohtml( $pic[ 'name' ] );
			$picpath = "pictures/album$albid/$picname";
			$body .= "<div class=\"thumb\"><a href=\"photos_collection.php?id=$albid\"><img class=\"thumb\" title=\"$albtitle\" alt=\"$albtitle\" src=\"photos_displaythumb.php?picpath=$picpath\" /></a></div>\n";
		}
		$pics -> close();
	}
	//$albname = tohtml( $entry[ 'name' ] );
	$body .= '<div class="name"><a href="photos_collection.php?id=' . $albid . '" title="' . $albtitle . '">' . $albtitle . '</a></div>' . "\n";
	//$body .= '</a>' . "\n";
	$body .= '</td>' . "\n";
	if( $k == $max - 1 ) {
		$k = 0;
		$body .= '</tr>' . "\n";
		$body .= '<tr class="albums">' . "\n";
	} else {
		++$k;
	}
}
$albums -> close();
$body .= '</tr>' . "\n";
/*if( $_SESSION[ 'stilili' ] ) {
	$body .= '<tr class="albums">' . "\n";
	$body .= '<td colspan="' . $max . '" class="albums special">' . "\n";
	$body .= '<a href="photos_collection.php?id=0" title="Quelques nouvelles de Suisse">Quelques nouvelles<br />de Suisse</a>' . "\n";
	$body .= '</td>' . "\n";
	$body .= '</tr>' . "\n";
} */
$body .= '</table>' . "\n";
$body .= '</div>' . "\n";
/*** ECHO ***/
$header = beforehead();
$header .= favicon();
$header .= commoncss( "photos" ,"css");
$header .= headertitle( $title, "Estelle et Lamine" );
$header .= endhead();
$header .= "<h1>$title</h1>\n";
$header .= language3( 'albums_collection' );
$header .= '<div id="home">' . "\n";
$header .= gohome();
$header .= '</div>' . "\n";
echo $header;
echo $body;
$footer = adminlink();
$footer .= copyright( "Lamine Kont&eacute;" );
$footer .= cssw3c();
$footer .= xhtmlw3c();
$footer .= endhtml();
echo $footer;
$link -> close();
?>
