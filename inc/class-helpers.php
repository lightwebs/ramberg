<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Class_Helpers {
	
    public function parse_atts( $content ) 
    {
	    $content = preg_match_all( '/([^ ]*)=(\'([^\']*)\'|\"([^\"]*)\"|([^ ]*))/', trim( $content ), $c );
	    list( $dummy, $keys, $values ) = array_values( $c );
	    $c = array();
	    foreach ( $keys as $key => $value ) {
	        $value = trim( $values[ $key ], "\"'" );
	        $type = is_numeric( $value ) ? 'int' : 'string';
	        $type = in_array( strtolower( $value ), array( 'true', 'false' ) ) ? 'bool' : $type;
	        switch ( $type ) {
	            case 'int': $value = (int) $value; break;
	            case 'bool': $value = strtolower( $value ) == 'true'; break;
	        }
	        $c[ $keys[ $key ] ] = $value;
	    }
	    return $c;
	}
   
}
