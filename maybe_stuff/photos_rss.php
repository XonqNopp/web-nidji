<?php
function photosrss( $link )
{
	$titlefrench = 'Photos';
	$titlewolof = 'Portale';
	$titlemanding = 'Portale';
	$xmlfrench = headrss( $titlefrench, 'albums_collection', "", "Lamine Kont&#201;" );
	$xmlwolof = headrss( $titlewolof, 'albums_collection', "", "Lamine Kont&#201;" );
	$xmlmanding = headrss( $titlemanding, 'albums_collection', "", "Lamine Kont&#201;" );
	if( !$tofs = $link -> query( "SELECT * FROM `photos` ORDER BY `date` DESC, `time` DESC, `id` DESC" ) ) {
		displerr( $tofs, $link );
	}
	while( $item = $tofs -> fetch_assoc() ) {
		$xmlfrench .= '<item>' . "\n";
		$xmlwolof .= '<item>' . "\n";
		$xmlmanding .= '<item>' . "\n";
		/*** SQL QUEST ***/
		$id = $item[ 'id' ];
		$date = $item[ 'date' ];
		$time = $item[ 'time' ];
		$place = tohtml( $item[ 'place' ] );
		if( $place != '' ) {
			$place .= ', ';
		}
		$albumno = $item[ 'album' ];
		if( !$albquery = $link -> query( "SELECT `title` FROM `albums` WHERE `id` = " . $albumno ) ) {
			displerr( $albquery, $link );
		}
		$albitem = $albquery -> fetch_assoc();
		$albquery -> close();
		$album = tohtml( $albitem[ 'title' ] );
		$name = tohtml( $item[ 'name' ] );
		$title = tohtml( $item[ 'title' ] );
		$french = $item[ 'french' ];
		$wolof = $item[ 'wolof' ];
		$manding = $item[ 'manding' ];
		/*** RSS FEED ***/
		/** title **/
		$xmlfrench .= '<title>' . $title . ' (' . $place . $date . ', ' . $time . ')</title>' . "\n";
		$xmlwolof .= '<title>' . $title . ' (' . $place . $date . ', ' . $time . ')</title>' . "\n";
		$xmlmanding .= '<title>' . $title . ' (' . $place . $date . ', ' . $time . ')</title>' . "\n";
		/** link **/
		$xmlfrench .= '<link>http://www.estellelamine.org/photos_display.php?lang=fr&amp;id=' . $id . '</link>' . "\n";
		$xmlwolof .= '<link>http://www.estellelamine.org/photos_display.php?lang=wolof&amp;id=' . $id . '</link>' . "\n";
		$xmlmanding .= '<link>http://www.estellelamine.org/photos_display.php?lang=manding&amp;id=' . $id . '</link>' . "\n";
		/** description **/
		/* tag */
		$xmlfrench .= '<description>';
		$xmlwolof .= '<description>';
		$xmlmanding .= '<description>';
		/* content */
		// picture
		$picpath = "pictures/album$albumno/$name";
		$xmlfrench  .= "&#60;img alt=\"$title\" title=\"$title\" src=\"photos_displaythumb.php?picpath=$picpath\" /&#62;";
		$xmlwolof   .= "&#60;img alt=\"$title\" title=\"$title\" src=\"photos_displaythumb.php?picpath=$picpath\" /&#62;";
		$xmlmanding .= "&#60;img alt=\"$title\" title=\"$title\" src=\"photos_displaythumb.php?picpath=$picpath\" /&#62;";
		// text
		if( $french != '' || $wolof != '' || $manding != '' ) {
			if( $wolof != '' ) {
				$xmlwolof .= $wolof . "\n";
				if( $manding == '' ) {
					$xmlmanding .= '&#60;p&#62;&#60;b&#62;Wolof&#160;:&#60;/b&#62;&#60;/p&#62;';
					$xmlmanding .= $wolof;
				} else {
					$xmlmanding .= $manding;
				}
				if( $french == '' ) {
					$xmlfrench .= '&#60;p&#62;&#60;b&#62;Wolof&#160;:&#60;/b&#62;&#60;/p&#62;';
					$xmlfrench .= $wolof;
				} else {
					$xmlfrench .= $french;
				}
			} else {
				if( $manding == '' ) {
					$xmlwolof .= '&#60;p&#62;&#60;b&#62;Fran&#231;ais&#160;:&#60;/b&#62;&#60;/p&#62;';
					$xmlmanding .= '&#60;p&#62;&#60;b&#62;Fran&#231;ais&#160;:&#60;/b&#62;&#60;/p&#62;';
					$xmlfrench .= $french;
					$xmlwolof .= $french;
					$xmlmanding .= $french;
				} else {
					$xmlmanding .= $manding;
					$xmlwolof .= '&#60;p&#62;&#60;b&#62;Manding&#160;:&#60;/b&#62;&#60;/p&#62;';
					$xmlwolof .= $manding;
					if( $french == '' ) {
						$xmlfrench .= '&#60;p&#62;&#60;b&#62;Manding&#160;:&#60;/b&#62;&#60;/p&#62;';
						$xmlfrench .= $manding;
					} else {
						$xmlfrench .= $french;
					}
				}
			}
		}
		/* end tag */
		$xmlfrench .= '</description>' . "\n";
		$xmlwolof .= '</description>' . "\n";
		$xmlmanding .= '</description>' . "\n";
		/** end **/
		$xmlfrench .= '</item>' . "\n";
		$xmlwolof .= '</item>' . "\n";
		$xmlmanding .= '</item>' . "\n";
	}
	$tofs -> close();
	$xmlfrench .= endrss();
	$xmlwolof .= endrss();
	$xmlmanding .= endrss();
	$fopfr = fopen( 'photosfrench.rss', 'w+' );
	$fopwo = fopen( 'photoswolof.rss', 'w+' );
	$fopmg = fopen( 'photosmanding.rss', 'w+' );
	fputs( $fopfr, $xmlfrench );
	fputs( $fopwo, $xmlwolof );
	fputs( $fopmg, $xmlmanding );
	fclose( $fopfr );
	fclose( $fopwo );
	fclose( $fopmg );
}
?>
