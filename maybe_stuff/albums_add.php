<?php
function addanalbum( $title, $french, $wolof, $manding, $link )
{
	$album = $link -> prepare( "INSERT INTO `" . dbname( "nidji" ) . "` . `albums` ( `id`, `title`, `picid`, `french`, `wolof`, `manding` ) VALUES( NULL, ?, NULL, ?, ?, ? );" );
	$album -> bind_param( 'ssss', $title, $french, $wolof, $manding );
	$photos = "ALTER TABLE `photos` CHANGE `album` `album` ENUM( '";
	$als = getalbums( $link );
	foreach( $als as $a ) {
		$photos .= $a . "', '";
	}
	if( !$album -> execute() ) {
		displerr( $album, $link );
	}
	$id = $album -> insert_id;
	$photos .= $id . "' ) NULL DEFAULT NULL";
	if( !$link -> query( $photos ) ) {
		displerr( $photos, $link );
	}
	// create directory: mkdir
	if( !mkdir( 'pictures/album' . $id ) ) { //|| !mkdir( 'thumbnails/album' . $id ) ) {
		echo '<div id="error">Impossible de cr&eacute;er le dossier...</div>' . "\n";
	}
}
?>
