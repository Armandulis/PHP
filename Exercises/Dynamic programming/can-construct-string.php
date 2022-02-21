<?php

/**
 * Check if we can add strings from $words that will result in $target
 * Example: (skateboard, [bo, rd, ate, t, ska, sk, boar ]) -> false
 * Example: (tester, [ st, er, in, tes, te] ) -> true
 * @param string $target - Value you want to generate
 * @param string[] $words - A list of words
 * @param array<int, bool> - An array to cache values 
 * @return bool - true if we can construct $target
 */
function canConstructString( string $target, array $words, array &$cache = [] ) : bool 
{
    // Return cache if we have answer cached
    if( array_key_exists( $target, $cache ) ) return $cache[ $target ];

    // Reached empty string - means we can reach $target 
    if( $target === '' ) return true;
    
    // Loop through words and check if each word the the beggining of $target
    foreach( $words as $word )
    {
        if( substr($target, 0, strlen( $word ) ) === $word )
        {
            $suffix = substr( $target, strlen( $word ) );
           
            // Call canConstructString() with a new $target 
            $result = canConstructString( $suffix, $words, $cache );
            $cache[ $suffix ] = $result;

            // If canConstructString() returns true, that's our answer
            if( $result === true )
            {
                return $result;
            }
        }
    }

    // We can't get $target using $words
    return false;
}

#   brute force: O((n^m) *m)
#   cached: O(n*(m^2))
// Test cases
var_dump( canConstructString('tester', [ 'st', 'er', 'in', 'tes', 't'] ) ); // True
var_dump( canConstructString( 'skateboard', ['bo', 'rd', 'ate', 't', 'ska', 'sk', 'boar' ] ) ); // false
var_dump( canConstructString( 'this is a nice sentence', [ 'this ', 'is', ' ', 'a', 'nice  ', 'nice', 'sentence' ] ) ); // True
var_dump( canConstructstring( 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeef', [ 'e', 'ee', 'eee', 'eeee', 'eeeee', 'eeeee', 'eeeeee' ] ) ); // False
