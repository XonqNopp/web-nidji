<?php
function getalbums( $link )
{
	if( !$query = $link -> query( "SHOW COLUMNS FROM `photos` LIKE 'album'" ) ) {
		displerr( $query, $link );
	}
	$result = $query -> fetch_array();
	$query -> close();
	$result = $result[ 1 ];
	$result = substr( $result, 4 );
	$regexp = "/'(.*?)'/";
	preg_match_all( $regexp, $result, $final );
	$final = $final[ 1 ];
	return $final;
}
?>
