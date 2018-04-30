<?php
session_start();
if( isset( $_POST[ 'no' ] ) ) {
	if( isset( $_POST[ 'id' ] ) ) {
		header( 'Location: photos_collection.php?id=' . $_POST[ 'id' ] );
	} else {
		header( 'Location: albums_collection.php' );
	}
}
require("functions/session.php");
session("french");
notallowed();
require("functions/w3c.php");
require("functions/language.php");
require("functions/gohome.php");
require("functions/headers.php");
require("functions/connection.php");
require("functions/valbut.php");
require("functions/convert.php");
require("album_this.php");
require("albums_get.php");
require("albums_add.php");
require("albums_update.php");
require("albums_remove.php");
require("functions/adminlink.php");
require("photos_rss.php");
$link = connection( "nidji" );
$titlefield = 'Titre de l&#039;album';
$picfield = 'Illustration de l&#039;album';
/*** DATABASE CHANGES ***/
$error = '';
if( isset( $_POST[ 'submit' ] ) ) {
	$ok = true;
	if( isset( $_POST[ 'id' ] ) ) {
		$id = $_POST[ 'id' ];
	}
	//if( isset( $_POST[ 'oldname' ] ) ) {
		//$oldname = $_POST[ 'oldname' ];
	//}
	//$name = htmlentities( $_POST[ 'name' ], ENT_QUOTES );
	//if( preg_match( '/&/', $name ) != 0 ) {
		//$error .= 'Caract&egrave;re incorrect utilis&eacute; dans le nom du dossier !<br />' . "\n";
		//$ok = false;
	//}
	$title = fromfield( $_POST[ 'title' ] );
	if( isset( $_POST[ 'picid' ] ) && $_POST[ 'picid' ] != 'NULL' ) {
		$picid = $_POST[ 'picid' ];
	}
	if( $_POST[ 'french' ] != '' ) {
		$french = fromparagraph( $_POST[ 'french' ] );
	}
	if( $_POST[ 'wolof' ] != '' ) {
		$wolof = fromparagraph( $_POST[ 'wolof' ] );
	}
	if( $_POST[ 'manding' ] != '' ) {
		$manding = fromparagraph( $_POST[ 'mading' ] );
	}
	if( $ok ) {
		if( !isset( $id ) ) {
			/* NEW ALBUM */
			addanalbum( $title, $french, $wolof, $manding, $link );
		} else {
			/* UPDATE ALBUM */
			$up = $link -> prepare( "UPDATE `" . dbname( "nidji" ) . "` . `albums` SET `title` = ?, `picid` = ?, `french` = ?, `wolof` = ?, `manding` = ? WHERE `id` = ? LIMIT 1;" );
			$up -> bind_param( 'sisssi', $title, $picid, $french, $wolof, $manding, $id );
			if( !$up -> execute() ) {
				displerr( $up, $link );
			}
			//if( $oldname != $name ) {
				//updatealbum( $oldname, $name, $link );
			//}
		}
		photosrss( $link );
		if( isset( $id ) ) {
			header( 'Location: photos_collection.php?id=' . $id );
		} else {
			header( 'Location: albums_collection.php' );
		}
	}
}
/*** ERASE ALBUM ***/
if( isset( $_POST[ 'erase' ] ) ) {
	//$name = $_POST[ 'oldname' ];
	$name = $_POST[ 'id' ];
	removeanalbum( $name, $link );
	photosrss( $link );
	header( 'Location: albums_collection.php' );
}
/*** EDITION MODE ***/
if( isset( $_GET[ 'id' ] ) ) {
	$id = $_GET[ 'id' ];
	if( $id == 0 ) {
		header( 'Location: albums_collection.php' );
		exit;
	}
	if( !$getit = $link -> query( "SELECT * FROM `albums` WHERE `id` = " . $id ) ) {
		displerr( $getit, $link );
	}
	$it = $getit -> fetch_assoc();
	$getit -> close();
	//$name = $it[ 'name' ];
	$title = tofield( $it[ 'title' ] );
	$picid = $it[ 'picid' ];
	$french = toparagraph( $it[ 'french' ] );
	$wolof = toparagraph( $it[ 'wolof' ] );
	$manding = toparagraph( $it[ 'manding' ] );
}
if( $_SESSION[ 'language' ] == 'french' ) {
	if( isset( $id ) ) {
		$thetitle = '&Eacute;dition';
	} else {
		$thetitle = 'Ajout';
	}
	$thetitle .= ' d&#039;un album';
} elseif( $_SESSION[ 'language' ] == 'wolof' ) {
	if( isset( $id ) ) {
		$thetitle = '&Eacute;dition';
	} else {
		$thetitle = 'Ajout';
	}
	$thetitle .= ' d&#039;un album';
} else {
	if( isset( $id ) ) {
		$thetitle = '&Eacute;dition';
	} else {
		$thetitle = 'Ajout';
	}
	$thetitle .= ' d&#039;un album';
}
/***** MAIN BODY *****/
$body = '<form action="albums_insert.php" method="post">' . "\n";
/* ID */
if( isset( $id ) ) {
	$body .= '<div id="hidden">' . "\n";
	$body .= '<input type="hidden" name="id" value="' . $id . '" />' . "\n";
	//$body .= '<input type="hidden" name="oldname" value="' . $name . '" />' . "\n";
	$body .= '</div>' . "\n";
}
/* NAME */
//$body .= '<div id="albedname">Nom du dossier informatique dans le serveur :<br /><input type="text" class="tnr" name="name" value="' . $name . '" onchange="enablesubmit()" onkeyup="enablesubmit()" /></div>' . "\n";
/* TITLE */
$body .= '<div id="albedtitle">' . $titlefield . '&nbsp;:<br /><input type="text" id="thefocus" class="tnr" name="title" value="' . $title . '" size="40" onchange="enablesubmit()" onkeyup="enablesubmit()" /></div>' . "\n";
/* PIC ID */
if( isset( $id ) ) {
	if( !$pics = $link -> query( "SELECT * FROM `photos` WHERE `album` = '" . $id . "'" ) ) {
		displerr( $pics, $link );
	}
	if( $pics -> num_rows > 0 ) {
		$body .= '<div id="albedpicid">' . "\n";
		$body .= $picfield . '&nbsp;: ' . "\n";
		$body .= '<select name="picid" onchange="enablesubmit()">' . "\n";
		$isid = false;
		while( $p = $pics -> fetch_assoc() ) {
			if( $picid == $p[ 'id' ] ) {
				$ch = ' selected="selected"';
				$isid = true;
			} else {
				$ch = '';
			}
			$body .= '<option value="' . $p[ 'id' ] . '"' . $ch . '>' . $p[ 'title' ] . '</option>' . "\n";
		}
		$pics -> close();
		if( !isset( $picid ) || !$isid ) {
			$body .= '<option value="NULL" selected="selected">aucune...</option>' . "\n";
		} else {
			$body .= '<option value="NULL">aucune...</option>' . "\n";
		}
		$body .= '</select>' . "\n";
		$body .= '</div>' . "\n";
	}
}
/* COMMENTS */
$body .= '<div id="albedcom">' . "\n";
/* french */
$body .= '<p>Fran&ccedil;ais&nbsp;:<br />' . "\n";
$body .= '<textarea name="french" class="area" cols="40" rows="10" onchange="enablesubmit()" onkeyup="enablesubmit()">' . $french . '</textarea></p>' . "\n";
/* wolof */
$body .= '<p>Wolof&nbsp;:<br />' . "\n";
$body .= '<textarea name="wolof" class="area" cols="40" rows="10" onchange="enablesubmit()" onkeyup="enablesubmit()">' . $wolof . '</textarea></p>' . "\n";
/* manding */
$body .= '<p>Manding&nbsp;:<br />' . "\n";
$body .= '<textarea name="manding" class="area" cols="40" rows="10" onchange="enablesubmit()" onkeyup="enablesubmit()">' . $manding . '</textarea></p>' . "\n";
/**/
$body .= '</div>' . "\n";
/* BUTTONS */
$body .= '<div id="albedbut">' . "\n";
$body .= valbut( isset( $id ), $id, 'album' );
$body .= '</div>' . "\n";
$body .= '</form>' . "\n";
/*** ECHO ***/
$header = beforehead();
$header .= favicon();
$header .= commoncss( "photos" ,"css");
$header .= jsform();
$header .= headertitle( $thetitle, "Estelle et Lamine" );
$header .= endhead( true );
$header .= "<h1>$thetitle</h1>\n";
$header .= onlyfrench();
$header .= '<div id="home">' . "\n";
if( isset( $id ) ) {
	$gohome_url = "photos_collection";
	$gohome_txt = "Retour &agrave; l&#039;album";
} else {
	$gohome_url = "albums_collection";
	$gohome_txt = "Retour aux albums";
}
$header .= gohome( $gohome_url, $id, $gohome_txt );
$header .= '</div>' . "\n";
echo $header;
echo $body;
if( $error != '' ) {
	echo '<div id="error">' . $error . '</div>' . "\n";
}
/***** FOOTER *****/
$footer = adminlink();
$footer .= copyright( "Lamine Kont&eacute;" );
$footer .= cssw3c();
$footer .= xhtmlw3c();
$footer .= endhtml();
echo $footer;
$link -> close();
?>
