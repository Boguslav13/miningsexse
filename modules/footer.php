<?php

$HTML_ = explode( '<!--DATA:CurrentYear-->' , $HTML , 3 );
$HTML = $HTML_[0] . "<!--DATA:CurrentYear-->" . date( 'Y' , time() ) . "<!--DATA:CurrentYear-->" . $HTML_[2];

?>