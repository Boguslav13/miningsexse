<?php

$Title = [
	'index' => "SexBrytning",
	'form' => "Gå med i SexBrytning",
	'donate' => "SexBrytning Donera",
	'apps' => "SexBrytning-appar",
	'privacypolicytermsconditions' => "SexBrytning Villkor",
];

$Description = [
	'index' => "SexBrytning",
	'form' => "Gå med i SexBrytning",
	'donate' => "SexBrytning Donera",
	'apps' => "SexBrytning-appar",
	'privacypolicytermsconditions' => "SexBrytning integritetspolicy villkor och bestämmelser",
];

$Keywords = [
	'index' => "SexBrytning",
	'form' => "Gå med i SexBrytning",
	'donate' => "SexBrytning Donera",
	'apps' => "SexBrytning-appar",
	'privacypolicytermsconditions' => "SexBrytning integritetspolicy villkor och bestämmelser",
];


if( $Title[$requested_page] ) $HTML = str_replace( '<!--title-->' , $Title[$requested_page] , $HTML );
if( $Description[$requested_page] ) $HTML = str_replace( '<!--description-->' , $Description[$requested_page] , $HTML );
if( $Keywords[$requested_page] ) $HTML = str_replace( '<!--keywords-->' , $Keywords[$requested_page] , $HTML );

?>