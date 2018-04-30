<?php
session_start();
require("functions/session.php");
session("french");
if( !isset( $_GET[ 'id' ] ) ) {
	header( 'Location: videos_collection.php' );
	exit;
}
require("functions/w3c.php");
require("functions/language.php");
require("functions/connection.php");
require("functions/headers.php");
require("functions/gohome.php");
require("functions/convert.php");
require("functions/makedate.php");
require("functions/adminlink.php");
require("functions_local/getcomments.php");
$link = connection( "nidji" );
if( $_SESSION[ 'language' ] == 'french' ) {
	$newvid = 'Ajouter une vid&eacute;o';
	$modify = 'Modifier les informations de cete vid&eacute;o';
} elseif( $_SESSION[ 'language' ] == 'wolof' ) {
	$newvid = 'Ajouter une vid&eacute;o';
	$modify = 'Modifier les informations de cete vid&eacute;o';
} else {
	$newvid = 'Ajouter une vid&eacute;o';
	$modify = 'Modifier les informations de cete vid&eacute;o';
}
$id = $_GET[ 'id' ];
if( !$check = $link -> query( "SELECT * FROM `movies` ORDER BY `id` ASC" ) ) {
	displerr( $check, $link );
}
$minus = '';
$test = true;
$plus = '';
$bords = array();
while( $c = $check -> fetch_assoc() ) {
	if( $c[ 'id' ] == $id ) {
		$test = false;
	}
	if( $c[ 'id' ] != $id && $test ) {
		$minus = $c[ 'id' ];
		$bords[ 'previous' ] = tohtml( $c[ 'title' ] );
	} elseif( $plus == '' && $c[ 'id' ] != $id && !$test ) {
		$plus = $c[ 'id' ];
		$bords[ 'next' ] = tohtml( $c[ 'title' ] );
	}
}
$check -> close();
/* QUERY */
if( !$query = $link -> query( "SELECT * FROM `movies` WHERE `id` = " . $id ) ) {
	displerr( $query, $link );
}
$movie = $query -> fetch_assoc();
$query -> close();
/* fetch infos */
$title = tohtml( $movie[ 'title' ] );
$path = 'videos/' . $movie[ 'name' ];
$quicktime = false;
switch( $movie[ 'type' ] ) {
	case 'mpeg':
		$type = 'mpeg';
		break;
	case 'avi':
		$type = 'x-msvideo';
		break;
	case 'mov':
		$type = 'quicktime';
		$quicktime = true;
		break;
}
$width = $movie[ 'width' ];
$height = $movie[ 'height' ] + 16;// for the control bar
$date = $movie[ 'date' ];
if( $movie[ 'place' ] != '' ) {
	$place = tohtml( $movie[ 'place' ] );
}
$french = tohtml( $movie[ 'french' ] );
$wolof = tohtml( $movie[ 'wolof' ] );
$manding = tohtml( $movie[ 'manding' ] );
$legend = '';
if( $wolof != '' && ( $_SESSION[ 'language' ] == 'wolof' || ( $_SESSION[ 'language' ] == 'manding' && $maning == '' ) || ( $_SESSION[ 'language' ] == 'french' && $french == '' ) ) ) {
	if( $_SESSION[ 'language' ] != 'wolof' ) {
		$legend .= '<p class="videolegendNO">Wolof&nbsp;:</p>' . "\n";
	}
	$legend .= $wolof;
} elseif( $french != '' && ( $_SESSION[ 'language' ] == 'french' || ( $_SESSION[ 'language' ] == 'wolof' && $wolof == '' ) || ( $_SESSION[ 'language' ] == 'manding' && $manding == '' && $wolof == '' ) ) ) {
	if( $_SESSION[ 'language' ] != 'french' ) {
		$legend .= '<p class="videolegendNO">Fran&ccedil;ais&nbsp;:</p>' . "\n";
	}
	$legend .= $french;
} else {
	if( $_SESSION[ 'language' ] != 'manding' ) {
		$legend .= '<p class="videolegendNO">Manding&nbsp;:</p>' . "\n";
	}
	$legend .= $manding;
}
/* body content */
$body = '';
if( $_SESSION[ 'stilili' ] ) {
	$body .= '<div class="videoadmin">' . "\n";
	$body .= '<a href="videos_insert.php?id=' . $id . '" title="' . $modify . '">' . $modify . '</a><br />' . "\n";
	$body .= '<a href="videos_insert.php" title="' . $newvid . '">' . $newvid . '</a>' . "\n";
	$body .= '</div>' . "\n";
}
$body .= '<div class="videovideo">' . "\n";
if( $quicktime ) {
	$body .= '<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" width="' . $width . '" height="' . $height . '">' . "\n";
	$body .= '<param name="src="' . $path . '" />' . "\n";
	$body .= '<param name="autoplay" value="false" />' . "\n";
	$body .= '<param name="controller" value="true" />' . "\n";
}
$body .= '<object class="video" name="' . $title . '" data="' . $path . '" type="video/' . $type . '" width="' . $width . '" height="' . $height . '">' . "\n";
// standby for loading message
$body .= '<param name="src" value="' . $path . '" />' . "\n";
$body .= '<param name="autoplay" value="false" />' . "\n";
$body .= '<param name="autostart" value="0" />' . "\n";
$body .= '<param name="controller" value="true" />' . "\n";
//$body .= '<em><a href="' . $path . '">' . $title . '</a></em>' . "\n";
$body .= 'alt : <a href="' . $path . '" title="' . $title . '">' . $title . '</a>' . "\n";
$body .= '</object>' . "\n";
if( $quicktime ) {
	$body .= '</object>' . "\n";
}
$body .= '</div>' . "\n";
$body .= '<div class="videolegend">' . "\n";
$body .= '<div class="videodate">' . "\n";
$body .= $date . "\n";
$body .= '</div>' . "\n";
if( isset( $place ) ) {
	$body .= '<div class="videoplace">' . "\n";
	$body .= $place . "\n";
	$body .= '</div>' . "\n";
}
$body .= '<div class="videolegendbody">' . "\n";
$body .= $legend . "\n";
$body .= '</div>' . "\n";
$body .= '</div>' . "\n";
/* COMMENTS */
$body .= getcomments( $link, $id, 'video', 'vid' );
/*** ECHO ***/
$header = beforehead();
$header .= favicon();
$header .= commoncss( "video" ,"css");
$header .= headertitle( $title, "Estelle et Lamine" );
$header .= endhead();
$header .= "<h1>$title</h1>\n";
$header .= language3( 'videos_display', $id );
if( $minus != '' ) {
	$header .= '<div id="home2">' . "\n";
	$header .= toprevious( 'videos_display', $minus, $bords[ 'previous' ] );
} else {
	$header .= '<div id="home">' . "\n";
}
$header .= gohome( "videos_collection", "", "Retour aux vid&eacute;os" );
if( $plus != '' ) {
	$header .= tonext( 'videos_display', $plus, $bords[ 'next' ] );
}
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
