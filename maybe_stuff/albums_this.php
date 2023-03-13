<?php
function thisalbum( $album, $link )
{
	$query = "SELECT `id` FROM `photos` WHERE `album` LIKE '%" . $album . "%'";
	if( !$result = $link -> query( $query ) ) {
		displerr( $result, $link );
	}
	$goback = array();
	while( $item = $result -> fetch_assoc() ) {
		$goback[] = $item[ 'id' ];
	}
	$result -> close();
	return $goback;
}
?>
