<?php

/**
 * Reverse a word
 */
function reverseString( string $word ) : string
{
    $characters = str_split( $word );

    $reversed = '';
    
    foreach( $characters as $char )
    {
        $reversed = $char . $reversed;
    }

    return $reversed;
}

var_dump( reverseString( 'asdf' ) );