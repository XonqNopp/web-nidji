<?php
function removeanalbum( $name, $link )
{
	if( !$photos = $link -> query( "SELECT * FROM `photos` WHERE `album` = '" . $name . "'" ) ) {
		displerr( $photos, $link );
	}
	if( $photos -> num_rows == 0 ) {
		/* Removing from the photos albums */
		$query = "ALTER TABLE `photos` CHANGE `album` `album` ENUM( '";
		$albs = getalbums( $link );
		foreach( $albs as $a ) {
			if( $a != $name ) {
				$query .= $a . "', '";
			}
		}
		$query = substr( $query, 0, -3 );
		$query .= " ) NOT NULL";
		if( !$link -> query( $query ) ) {
			displerr( $link );
		}
		/* Removing from the album DB */
		$album = $link -> prepare( "DELETE FROM `" . dbname( "nidji" ) . "` . `albums` WHERE `albums` . `id` = ? LIMIT 1;" );
		$album -> bind_param( 's', $name );
		if( !$album -> execute() ) {
			displerr( $album, $link );
		}
		// remove the directory!!!!!: rmdir
		if( !rmdir( 'pictures/album' . $name ) ) { //|| !rmdir( 'thumbnails/album' . $name ) ) {
			echo '<div id="error">Impossible d&#039;effacer le dossier, peut-&ecirc;tre contient-il encore des fichiers...</div>' . "\n";
		}
		/* remove the comments */
		if( !$erase = $link -> query( "DELETE FROM `" . dbname( "nidji" ) . "` . `comments` WHERE `comments` . `whichone` = 'album' AND `comments` . `whichid` = " . $name ) ) {
			displerr( $erase, $link );
		}
	} else {
		echo '<div id="error">Impossible d&#039;effacer cet album, il contient encore des photos.</div>' . "\n";
	}
	$photos -> close();
}
?>
