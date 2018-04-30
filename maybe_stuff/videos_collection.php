<?php
session_start();
require("functions/session.php");
session("french");
require("functions/w3c.php");
require("functions/language.php");
require("functions/connection.php");
require("functions/headers.php");
require("functions/gohome.php");
require("functions/convert.php");
require("functions/makedate.php");
require("functions/adminlink.php");
$link = connection( "nidji" );
if( $_SESSION[ 'language' ] == 'french' ) {
	$title = 'Quelques extraits vid&eacute;os...';
	$newvideo = 'Ajouter une vid&eacute;o';
	$sorry = 'D&eacute;sol&eacute;, il n&#039;y a pas encore de videos.';
} elseif( $_SESSION[ 'language' ] == 'wolof' ) {
	$title = 'Quelques extraits vid&eacute;os...';
	$newvideo = 'Ajouter une vid&eacute;o';
	$sorry = 'D&eacute;sol&eacute;, il n&#039;y a pas encore de videos.';
} else {
	$title = 'Quelques extraits vid&eacute;os...';
	$newvideo = 'Ajouter une vid&eacute;o';
	$sorry = 'D&eacute;sol&eacute;, il n&#039;y a pas encore de videos.';
}
if( !$videos = $link -> query( "SELECT * FROM `movies` ORDER BY `id` ASC" ) ) {
	displerr( $videos, $link );
}
$body = '';
if( $_SESSION[ 'stilili' ] ) {
	$body .= '<div class="videoadmin"><a href="videos_insert.php" title="' . $newvideo . '">' . $newvideo . '</a></div>' . "\n";
}
$k = 0;
$max = 5;
if( $videos -> num_rows == 0 ) {
	$body .= '<div id="warning">' . $sorry . '</div>' . "\n";
} else {
	$body .= '<div class="videos">' . "\n";
	$body .= '<table class="videos">' . "\n";
	$body .= '<tr class="videos">' . "\n";
	while( $vid = $videos -> fetch_assoc() ) {
		$id = $vid[ 'id' ];
		$vidtitle = tohtml( $vid[ 'title' ] );
		$thumb = tohtml( $vid[ 'thumb' ] );
		$body .= '<td class="videos">' . "\n";
		if( $thumb != '' ) {
			/******* SIZE **********/
			$body .= '<div class="videosthumb"><a href="videos_display.php?id=' . $id . '"><img class="videos" alt="' . $vidtitle . '" title="' . $vidtitle . '" src="videos/thumbs/' . $thumb . '" /></a></div>' . "\n";
		}
		$body .= '<div class="videostitle"><a href="videos_display.php?id=' . $id . '" title="' . $vidtitle . '">' . $vidtitle . '</a>' . "\n";
		$body .= '</td>' . "\n";
		if( $k < $max ) {
			++$k;
		} else {
			$k = 0;
			$body .= '</tr>' . "\n";
			$body .= '<tr>' . "\n";
		}
	}
	$body .= '</tr>' . "\n";
	$body .= '</table>' . "\n";
	$body .= '</div>' . "\n";
}
$videos -> close();
/*** ECHO ***/
$header = beforehead();
$header .= favicon();
$header .= commoncss( "video" ,"css");
$header .= headertitle( $title, "Estelle et Lamine" );
$header .= endhead();
$header .= "<h1>$title</h1>\n";
$header .= language3( 'videos_collection' );
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
