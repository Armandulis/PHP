<?php

/**
 * Return all ways we can add strings from $words that will result in $target
 * Example: ('tester', [ 'st', 'er', 'in', 'tes', 't'] ) ->[['er', 't', 'tes]]
 * Example:( 'skateboard', ['bo', 'rd', 'ate', 't', 'ska', 'sk', 'boar' ] ) -> []
 * @param string $target - Value you want to generate
 * @param string[] $words - A list of words
 * @param array<string, string[]> cache
 * @return array<int, string[]> - all possible answers
 */
function allConstructString( string $target, array $words, array &$cache = [] ) : array 
{
    // Check if the target we want to get is already in the cache
    if( array_key_exists( $target, $cache ) ) return $cache[ $target ];

    // We reached empty string - meaning we can combine $words into target. Return array of array - this will help us
    // to store $words
    if( $target === '' ) return [[]];
    $answer = [];

    // Loop through words
    foreach( $words as $word )
    {
        // Check if current $word is the start of our target
        if( substr($target, 0, strlen( $word ) ) === $word )
        {
            // Remove the $word from the $target
            $suffix = substr( $target, strlen( $word ) );
            $result = allConstructString( $suffix, $words, $cache );        
            
            // If we received anything from the allConstructString - this means we should add current $word to the $answer
            // 
            foreach( $result as $ways )
            {
                $ways[] = $word;
                $answer[] = $ways;
            } 
        }
    }
    
    // Cache our answer for the current target
    $cache[ $target ] = $answer;
    return $answer;
}

# O(n^m)
// Test cases
var_dump( allConstructString( 'tester', [ 'tes', 'ter', 'te', 'st', 'er', 't', 'ester' ] ) ); // [['test', 'ter'], [ 'er', 't', 'tes'], ['er', 'st', 'te'], ['t', 'ester']]
var_dump( allConstructString('tester', [ 'st', 'er', 'in', 'tes', 't'] ) ); // // [['er', 't', 'tes]]
var_dump( allConstructString( 'skateboard', ['bo', 'rd', 'ate', 't', 'ska', 'sk', 'boar' ] ) );
var_dump( allConstructString( 'this is a nice sentence', [ 'this ', 'is', ' ', 'a', 'nice  ', 'nice', 'sentence' ] ) ); // [[ 'sentence', ' ', 'nice', ' ', 'a', ' ', 'is', 'this ' ]]
var_dump( allConstructString( 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeef', [ 'e', 'ee', 'eee', 'eeee', 'eeeee', 'eeeee', 'eeeeee' ] ) ); // []
