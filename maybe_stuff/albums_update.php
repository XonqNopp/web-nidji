<?php
function updatealbum( $oldalbum, $newalbum, $link )
{
	$goback = thisalbum( $oldalbum, $link );
	$photos = $link -> prepare( "UPDATE `" . dbname( "nidji" ) . "` . `photos` SET `album` = ? WHERE `photos` . `id` = ?" );
	foreach( $goback as $g ) {
		$photos -> bind_param( 'ss', $newalbum, $g );
		if( !$photos -> execute() ) {
			displerr( $photos, $link );
		}
	}
	$photos -> close();
	$album = $link -> prepare( "UPDATE `" . dbname( "nidji" ) . "` . `albums` SET `name` = ? WHERE `name` = ?" );
	$album -> bind_param( 'ss', $newalbum, $oldalbum );
	if( !$album -> execute() ) {
		displerr( $album, $link );
	}
	// rename directory
	if( !rename( 'pictures/album' . $oldalbum, 'pictures/album' . $newalbum ) ) { //|| !rename( 'thumbnails/album' . $oldalbum, 'thumbnails/album' . $newalbum ) ) {
		echo '<div id="error">Impossible de renommer le dossier...</div>' . "\n";
	}
}
?>
