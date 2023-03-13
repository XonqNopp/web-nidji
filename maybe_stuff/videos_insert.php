<?php
session_start();
require("functions/session.php");
session("french");
cancelback('videos_collection.php');
notallowed();
require("functions/w3c.php");
require("functions/language.php");
require("functions/makedate.php");
require("functions/gohome.php");
require("functions/headers.php");
require("functions/maketime.php");
require("functions/months.php");
require("functions/connection.php");
require("functions/valbut.php");
require("functions/extension.php");
require("functions/convert.php");
require("functions/createthumb.php");
require("functions/adminlink.php");
$link = connection( "nidji" );
$placefield = 'Lieu (facultatif)';
$thetitle = 'Ajouter une vid&eacute;o';
$albumfield = 'Dans l&#039;album';
$titlefield = 'Titre de la vid&eacute;o';
$videofield = 'Vid&eacute;o';
$thumbfield = 'Illustration (facultatif)';
$delete = 'Supprimer cet aper&ccedil;u';
$dimfield = 'Dimensions de la vid&eacute;o';
$heightfield = 'Hauteur';
$widthfield = 'Largeur';
$comebackfield = 'Ajouter une autre vid&eacute;o ensuite';
$comebackfieldyes = 'oui';
$comebackfieldno = 'non';
$com1 = 'Les champs <i>titre, largeur</i> et <i>hauteur</i> sont obligatoires, et il serait bien qu&#039;il y ait au moins un des trois champs de commentaires qui soit rempli.';
$com2 = 'La vid&eacute;o <b>doit faire moins de 50Mo</b> (formats .mp4 .mpg .avi .mov (non test&eacute;)). Les formats d&#039;images support&eacute;s sont <b>png</b> et <b>jpg</b> (ou gif).';
$error = '';
$max_size_Mo = 50;// [Mo]
$max_size_o  = 1024*1024 * $max_size_Mo;// [o]
/* DATABASE CHANGES */
if( isset( $_POST[ 'submit' ] ) ) {
	$title = fromfield( $_POST[ 'title' ] );
	$date = makedate( $_POST[ 'year' ], $_POST[ 'month' ], $_POST[ 'day' ] );
	if( $_POST[ 'place' ] != '' ) {
		$place = fromfield( $_POST[ 'place' ] );
	}
	if( $_POST[ 'french' ] != '' ) {
		$french = fromparagraph( $_POST[ 'french' ], 'videolegend' );
	}
	if( $_POST[ 'wolof' ] != '' ) {
		$wolof = fromparagraph( $_POST[ 'wolof' ], 'videolegend' );
	}
	if( $_POST[ 'manding' ] != '' ) {
		$manding = fromparagraph( $_POST[ 'manding' ], 'videolegend' );
	}
	$height = $_POST[ 'height' ];
	$width = $_POST[ 'width' ];
	$type = $_POST[ 'type' ];
	if( isset( $_POST[ 'id' ] ) ) {
		/* update */
		$id = $_POST[ 'id' ];
		/* delete thumb */
		if( isset( $_POST[ 'thumbdelete' ] ) ) {
			$thumb = $_POST[ 'picture' ];
			$deletethumb = $link -> prepare( "UPDATE `" . dbname( "nidji" ) . "` . `movies` SET `thumb` = NULL WHERE `movies` . `id` = " . $id );
			$deletethumb -> bind_param( 'i', $id );
			if( unlink( 'videos/thumbs/' . $thumb ) ) {
				if( !$deletethumb -> execute() ) {
					displerr( $deletethumb, $link );
				}
			} else {
				$error .= 'Impossible d&#039;effacer le fichier.<br />' . "\n";
			}
		}
		/* add new thumb */
		$filename = fromhome( $_FILES[ 'thumb' ][ 'name' ] );
		if( $filename != '' ) {
			$newthumb = $link -> prepare( "UPDATE `" . dbname( "nidji" ) . "` . `movies` SET `thumb` = ? WHERE `movies` . `id` = ? LIMIT 1;" );
			$newthumb -> bind_param( 'si', $filename, $id );
			$tmp = $_FILES[ 'thumb' ][ 'tmp_name' ];
			$path = 'videos/thumbs/' . $filename;
			$max = 100.0;
			if( move_uploaded_file( $tmp, $path ) ) {
				try {
					$nt1 = createthumb( $max, $path, $path, false );
				} catch( Exception $e ) {
					$error .= $e -> getMessage();
				}
				if( $nt1 ) {
					if( !$newthumb -> execute() ) {
						displerr( $newthumb, $link );
						unlink( $path );
					}
				} else {
					$error .= 'Probl&egrave;me rencontr&eacute; lors du chargement de l&#039;image.<br />' . "\n";
					unlink( $path );
				}
			} else {
				$error .= 'Impossible de charger l&#039;image.<br />' . "\n";
			}
		}
		$query = $link -> prepare( "UPDATE `" . dbname( "nidji" ) . "` . `movies` SET `date` = ?, `place` = ?, `type` = ?, `width` = ?, `height` = ?, `title` = ?, `french` = ?, `wolof` = ?, `manding` = ? WHERE `movies` . `id` = ? LIMIT 1;" );
		$query -> bind_param( 'sssssssssi', $date, $place, $type, $width, $height, $title, $french, $wolof, $manding, $id );
		if( !$query -> execute() ) {
			displerr( $query, $link );
		}
		header( 'Location: videos_display.php?id=' . $id );
	} else {
		/* insert */
		/* FILES */
		/* video */
		$tmpvideo = $_FILES[ 'video' ][ 'tmp_name' ][ 0 ];
		$namevideo = fromhome( $_FILES[ 'video' ][ 'name' ][ 0 ] );
		if( is_uploaded_file( $tmpvideo ) && !file_exists( 'videos/' . $namevideo ) ) {
			$b1 = move_uploaded_file( $tmpvideo, 'videos/' . $namevideo );
		} else {
			$error .= 'Impossible de charger la vid&eacute;o...<br />' . "\n";
			$b5 = false;
		}
		/* thumb */
		$tmpthumb = $_FILES[ 'video' ][ 'tmp_name' ][ 1 ];
		$namethumb = fromhome( $_FILES[ 'video' ][ 'name' ][ 1 ] );
		$ct = true;
		if( $namethumb != '' ) {
			if( is_uploaded_file( $tmpthumb ) && !file_exists( 'videos/thumbs/' . $namethumb ) ) {
				$path = 'videos/thumbs/' . $namethumb;
				if( move_uploaded_file( $tmpthumb, $path ) ) {
					$max = 100.0;
					try {
						$ct = createthumb( $max, $path, $path, false );
					} catch( Exception $e ) {
						$error .= $e -> getMessage();
					}
				} else {
					$error .= 'Impossible de mettre l&#039;aper&ccedil;u dans le dossier...<br />' . "\n";
				}
			} else {
				$error .= 'Impossible de charger l&#039;aper&ccedil;u...<br />' . "\n";
			}
		} else {
			unset( $tmpthumb, $namethumb );
		}
		/* SQL */
		$query = $link -> prepare( "INSERT INTO `" . dbname( "nidji" ) . "` . `movies` ( `id`, `date`, `place`, `name`, `thumb`, `type`, `width`, `height`, `title`, `french`, `wolof`, `manding` ) VALUES( NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? );" );
		$query -> bind_param( 'sssssssssss', $date, $plaace, $namevideo, $namethumb, $type, $width, $height, $title, $french, $wolof, $manding );
		if( $ct ) {
			if( $query -> execute() ) {
				$id = $query -> insert_id;
			} else {
				unlink( 'videos/' . $namevideo );
				if( $namethumb != "" ) {
					unlink( 'videos/thumbs/' . $namethumb );
				}
				displerr( $query, $link );
			}
			header( 'Location: videos_display.php?id=' . $id );
		} else {
			if( !$b1 ) {
				$error .= 'Erreur lors du chargement de la vid&eacute;o<br />' . "\n";;
			} elseif( !$b2 || !$b3 || !$b4 ) {
				$error .= 'Erreur de traitement de l&#039;aper&ccedil;u<br />' . "\n";;
			}
			unlink( 'videos/' . $namevideo );
			if( $namethumb != "" ) {
				unlink( 'videos/thumbs/' . $namethumb );
			}
			unset( $id );
			header( "Location: videos_collection.php" );
		}
	}
	/* FINAL */
	exit;
}
/* ERASE */
if( isset( $_POST[ 'erase' ] ) ) {
	$id = $_POST[ 'id' ];
	$erase = $link -> prepare( "DELETE FROM `" . dbname( "nidji" ) . "` . `movies` WHERE `movies` . `id` = ? LIMIT 1;" );
	$erase -> bind_param( 'i', $id );
	if( !$erase -> execute() ) {
		displerr( $erase, $link );
	}
	header( 'Location: videos_collection.php' );
	exit;
}
/* GETTING INFOS */
if( isset( $_GET[ 'id' ] ) ) {
	$id = $_GET[ 'id' ];
	if( !$query = $link -> query( "SELECT * FROM `movies` WHERE `id` = " . $id ) ) {
		displerr( $query, $link );
	}
	$movie = $query -> fetch_assoc();
	$query -> close();
	$name = tohtml( $movie[ 'name' ] );
	if( $movie[ 'thumb' ] != '' ) {
		$thumb = tohtml( $movie[ 'thumb' ] );
	}
	$date = $movie[ 'date' ];
	$dates = destroydate( $date );
	$year = $dates[ 'year' ];
	$month = $dates[ 'month' ];
	$day = $dates[ 'day' ];
	$french = toparagraph( $movie[ 'french' ], 'videolegend' );
	$wolof = toparagraph( $movie[ 'wolof' ], 'videolegend' );
	$manding = toparagraph( $movie[ 'manding' ], 'videolegend' );
	$type = $movie[ 'type' ];
	$height = $movie[ 'height' ];
	$width = $movie[ 'width' ];
	$title = tofield( $movie[ 'title' ] );
} else {
	$date = date( 'c' );
	$year = substr( $date, 0, 4 );
	$month = substr( $date, 5, 2 );
	$day = substr( $date, 8, 2 );
	if( isset( $_POST[ 'submit' ] ) ) {
		//unset( $id );
		$year = $_POST[ 'year' ];
		$month = $_POST[ 'month' ];
		$day = $_POST[ 'day' ];
		$title = stripslashes( $_POST[ 'title' ] );
		$french = stripslashes( $_POST[ 'french' ] );
		$wolof = stripslashes( $_POST[ 'wolof' ] );
		$manding = stripslashes( $_POST[ 'manding' ] );
		$type = $_POST[ 'type' ];
		$height = $_POST[ 'height' ];
		$width = $_POST[ 'width' ];
		$place = stripslashes( $_POST[ 'place' ] );
	} else {
		$height = 240;
		$width = 320;
	}
}
/* main body */
$body = '<form action="videos_insert.php" method="post" enctype="multipart/form-data">' . "\n";
/* BLOCK */
$body .= '<div class="newvideoblock">' . "\n";
/* DATE */
$body .= '<div class="newvideodate">' . "\n";
$body .= '<select name="day" onchange="enablesubmit()">' . "\n";
for( $i = 1; $i < 32; ++$i ) {
	if( $i == $day ) {
		$ch = ' selected="selected"';
	} else {
		$ch = '';
	}
	$body .= '<option value="' . $i . '"' . $ch . '>' . $i . '</option>' . "\n";
}
$body .= '</select>' . "\n";
$body .= '<select name="month" onchange="enablesubmit()">' . "\n";
for( $i = 1; $i < 13; ++$i ) {
	if( $i == $month ) {
		$ch = ' selected="selected"';
	} else {
		$ch = '';
	}
	$body .= '<option value="' . $i . '"' . $ch . '>' . months( $i ) . '</option>' . "\n";
}
$body .= '</select>' . "\n";
$body .= '<select name="year" onchange="enablesubmit()">' . "\n";
for( $i = 2009; $i < 2013; ++$i ) {
	if( $i == $year ) {
		$ch = ' selected="selected"';
	} else {
		$ch = '';
	}
	$body .= '<option value="' . $i . '"' . $ch . '>' . $i . '</option>' . "\n";
}
$body .= '</select>' . "\n";
$body .= '</div>' . "\n";
/* TITLE */
$body .= '<div class="newvideotitle">' . "\n";
$body .= $titlefield . '&nbsp;: <input name="title" type="text" class="tnr" id="thefocus" size="40" value="' . $title . '" onchange="enablesubmit()" onkeyup="enablesubmit()" />' . "\n";
$body .= '</div>' . "\n";
/* PLACE */
$body .= '<div class="newvideoplace">' . "\n";
$body .= $placefield . '&nbsp;: <input type="text" class="tnr" name="place" value="' . $place . '" size="40" onchange="enablesubmit()" onkeyup="enablesubmit()" />' . "\n";
$body .= '</div>' . "\n";
/* TYPE */
if( $type == 'mpeg' ) {
	$chmped = ' selected="selected"';
} elseif( $type == 'avi' ) {
	$chavi = ' selected="selected"';
} elseif( $type == 'mov' ) {
	$chmov = ' selected="selected"';
}
$body .= '<div class="newvideotype">' . "\n";
$body .= 'Type&nbsp;: <select name="type" onchange="enablesubmit()">' . "\n";
$body .= '<option value="mpeg"' . $chmpg . '>mpeg/mpg</option>' . "\n";
$body .= '<option value="avi"' . $chavi . '>avi</option>' . "\n";
$body .= '<option value="mov"' . $chmov . '>mov/quicktime</option>' . "\n";
$body .= '</select>' . "\n";
$body .= '</div>' . "\n";
/* HEIGHT AND WIDTH */
$body .= '<div class="newvideodim">' . "\n";
$body .= $dimfield . "<br />\n";
$body .= $widthfield . '&nbsp;: <input type="text" name="width" value="' . $width . '" onkeyup="onlynumbers( this ); enablesubmit()" onchange="enablesubmit()" />&nbsp;' . "\n";
$body .= $heightfield . '&nbsp;: <input type="text" name="height" value="' . $height . '" onkeyup="onlynumbers( this ); enablesubmit()" onchange="enablesubmit()" />' . "\n";
$body .= '</div>' . "\n";
if( isset( $id ) ) {
	/* ID + NAME */
	$body .= '<div class="hidden">' . "\n";
	$body .= '<input type="hidden" name="id" value="' . $id . '" />' . "\n";
	$body .= '<input type="hidden" name="name" value="' . $name . '" />' . "\n";
	if( isset( $thumb ) ) {
		$body .= '<input type="hidden" name="picture" value="' . $thumb . '" />' . "\n";
	}
	$body .= '</div>' . "\n";
	/* THUMB DISPLAY */
	$body .= '<div class="newvideothumb">' . "\n";
	if( isset( $thumb ) ) {
		$body .= '<img alt="' . $title . '" title="' . $title . '" src="videos/thumbs/' . $thumb . '" /><br />' . "\n";
		$body .= '<label for="delete">' . $delete . '&nbsp;<input type="checkbox" id="delete" name="thumbdelete" onchange="enablesubmit()" />' . "\n";
	} else {
		$body .= "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$max_size_o\" />\n";
		// This means $max_size_Mo Mo
		$body .= $thumbfield . '&nbsp;: <input id="inputfile" type="file" name="thumb" onchange="enablesubmit()" />' . "\n";
	}
	$body .= '</div>' . "\n";
} else {
	/* FILE FIELD */
	$body .= '<div class="newvideofilesfield">' . "\n";
	$body .= "<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"$max_size_o\" />\n";
	$body .= "<!-- This means $max_size_Mo Mo -->\n";
	// This means $max_size_Mo Mo
	$body .= $videofield . '&nbsp;: <input id="inputfile" type="file" name="video[]" /><br />' . "\n";
	$body .= $thumbfield . '&nbsp;: <input id="inputfile" type="file" name="video[]" />' . "\n";
	$body .= '</div>' . "\n";
	/* COME BACK */
	$body .= '<div class="newvideocomeback">' . "\n";
	$body .= '<table>' . "\n";
	$body .= '<tr>' . "\n";
	$body .= '<td id="comeback" rowspan="2">' . $comebackfield . '&nbsp;:</td>' . "\n";
	$body .= '<td class="cbr"><label for="comebackyes">' . $comebackfieldyes . '</label></td>' . "\n";
	$body .= '<td class="cbr"><input id="comebackyes" type="radio" name="comeback" value="yes" /></td>' . "\n";
	$body .= '</tr>' . "\n";
	$body .= '<tr>' . "\n";
	$body .= '<td class="cbr"><label for="comebackno">' . $comebackfieldno . '</label></td>' . "\n";
	$body .= '<td class="cbr"><input id="comebackno" type="radio" name="comeback" value="no" checked="checked" /></td>' . "\n";
	$body .= '</tr>' . "\n";
	$body .= '</table>' . "\n";
	$body .= '</div>' . "\n";
}
/* warnings */
$body .= '<div class="newvideofac"><ul>' . "\n";
$body .= '<li>' . $com1 . '</li>' . "\n";
$body .= '<li>' . $com2 . '</li>' . "\n";
$body .= '</ul></div>' . "\n";
/* BUTTONS */
$body .= '<div class="newvideobut">' . "\n";
$body .= valbut( isset( $id ), $id, 'video' );
$body .= '</div>' . "\n";
/* END BLOCK */
$body .= '</div>' . "\n";
/* COMMENT */
$body .= '<div class="newvideocomment">' . "\n";
/* french */
$body .= '<p>Fran&ccedil;ais&nbsp;:<br />' . "\n";
$body .= '<textarea name="french" class="area" cols="48" rows="8" onchange="enablesubmit()" onkeyup="enablesubmit()">' . $french . '</textarea></p>' . "\n";
/* wolof */
$body .= '<p>Wolof&nbsp;:<br />' . "\n";
$body .= '<textarea name="wolof" class="area" cols="48" rows="8" onchange="enablesubmit()" onkeyup="enablesubmit()">' . $wolof . '</textarea></p>' . "\n";
/* manding */
$body .= '<p>Manding&nbsp;:<br />' . "\n";
$body .= '<textarea name="manding" class="area" cols="48" rows="8" onchange="enablesubmit()" onkeyup="enablesubmit()">' . $manding . '</textarea></p>' . "\n";
/* end comment */
$body .= '</div>' . "\n";
/* / */
$body .= '</form>' . "\n";
/*** ECHO ***/
$header = beforehead();
$header .= favicon();
$header .= commoncss( "video" ,"css");
$header .= jsform();
$header .= jsnumbers();
$header .= headertitle( $thetitle, "Estelle et Lamine" );
$header .= endhead( true );
$header .= "<h1>$thetitle</h1>\n";
$header .= onlyfrench();
$header .= '<div class="home">' . "\n";
$header .= gohome( "videos_collection", "", "Retour aux vid&eacute;os" );
$header .= '</div>' . "\n";
echo $header;
echo $body;
if( $error != '' ) {
	echo '<div class="error">' . $error . '</div>' . "\n";
}
$footer = adminlink();
$footer .= copyright( "Lamine Kont&eacute;" );
$footer .= cssw3c();
$footer .= xhtmlw3c();
$footer .= endhtml();
echo $footer;
$link -> close();
?>
