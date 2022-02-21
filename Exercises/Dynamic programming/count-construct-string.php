<?php

/**
 * Check how many ways we can add strings from $words that will result in $target
 * Example: ('tester', [ 'tes', 'ter', 'te', 'st', 'er', 't', 'ester' ]) -> 4
 * Example: (tester, [] ) -> 0
 * @param string $target - Value you want to generate
 * @param string[] $words - A list of words
 * @param array<string, string[]> $cache - cached values
 * @return int the amount of ways we can construct $target
 */
function countConstructString( string $target, array $words, array &$cache = [] ) : int 
{
    // Return cached value
    if( array_key_exists( $target, $cache ) ) return $cache[ $target ];

    // Reaching empty string means we can reach $target
    if( $target === '' ) return 1;
    $count = 0;

    // Loop through each word, each result will be added to $count
    foreach( $words as $word )
    {
        if( substr($target, 0, strlen( $word ) ) === $word )
        {
            $suffix = substr( $target, strlen( $word ) );
           
            $result = countConstructString( $suffix, $words, $cache );        
            $count += $result;
        }
    }

    // Cache answer
    $cache[ $target ] = $count;
    return $count;
}

#   brute force: O((n^m) *m)
#   cached: O(n*(m^2))
// Test cases
var_dump( countConstructString( 'tester', [ 'tes', 'ter', 'te', 'st', 'er', 't', 'ester' ] ) ); // 4
var_dump( countConstructString('tester', [ 'st', 'er', 'in', 'tes', 't'] ) ); // 1
var_dump( countConstructString( 'skateboard', ['bo', 'rd', 'ate', 't', 'ska', 'sk', 'boar' ] ) ); // 0
var_dump( countConstructString( 'this is a nice sentence', [ 'this ', 'is', ' ', 'a', 'nice  ', 'nice', 'sentence' ] ) ); // 1
var_dump( countConstructString( 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeef', [ 'e', 'ee', 'eee', 'eeee', 'eeeee', 'eeeee', 'eeeeee' ] ) ); // 0
