<?php

/**
 * Finds how add numbers from array to get target sum
 * @param int $targetSum 
 * @param int[] $numbers
 * @param array<int, int[]|null> cached values
 * @return ?int[]|null if cant find sum when add numbers or array of numbers who's sum is targer sum 
 */
function howSum( int $targetSum, array $numbers, array &$cache = [] ): ?array
{
    // Check if we have it in the cache
    // Do not use isset(): $cache[ 123 ] = null; isset( $cache[ 123] ) === false
    if( array_key_exists( $targetSum, $cache ) ) return $cache[ $targetSum ];

    // We went below 0, return null
    if( $targetSum < 0 ) return null;

    // We reached 0 - meaning we can reach target sum
    if( $targetSum === 0 ) return [];

    // Loop throught numbers
    foreach( $numbers as $number )
    {
        // If the result is not null, add the number to the result and return the result
        $remainder = $targetSum - $number;
        $remainderResult = howSum($remainder, $numbers, $cache );
        if( $remainderResult !== null )
        {
            $remainderResult[] = $number;
            $cache[ $targetSum ] = $remainderResult;
            return $remainderResult;
        }
    }

    // Cache values
    $cache[ $targetSum ] = null;
    return null;
}

# Brute force: O(n^m * m)
# Cached: O(n+m^2)
// Test cases
var_dump( howSum( 7, [ 2 , 3 ] ) ); // [ 3, 2, 2 ]
var_dump( howSum( 7, [ 5 , 3, 4, 7 ] ) ); // [ 4, 3 ]
var_dump( howSum( 7, [ 2, 4 ]  ) ); // null
var_dump( howSum( 8, [ 2, 3, 5 ] ) ); // [ 2, 2, 2, 2 ] 
var_dump( howSum(300, [ 7, 14 ] ) ); // null