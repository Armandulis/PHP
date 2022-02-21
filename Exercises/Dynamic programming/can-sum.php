<?php

/**
 * Checks if it is possible to add numbers to results in target sum
 * @param int $targetSum
 * @param int[] $numbers 
 * @param array<int, bool> $cache - cached values
 * @return bool true if we can add up numbers to target sum 
 */
function canSum( int $targetSum, array $numbers, array &$cache = [] ): bool
{
    if(isset( $cache[ $targetSum ] ) ) return $cache[ $targetSum ];

    // If target sum reaches 0, return true
    if( $targetSum === 0 ) return true;
    if( $targetSum < 0 ) return false;

    // Taking $number from $targetSum and doing that untill we reach 0 will mean that we can reach $targetSum with $numbers
    foreach( $numbers as $number )
    {
        if( canSum( $targetSum - $number, $numbers, $cache ) )
        { 
            $cache[ $targetSum ] = true;
            return true;
        }
    }

    // Cache answer
    $cache[ $targetSum ] = false;
    return false;
}

# Brute force: O(n^m)
# Cached: O(m*n)
// Test cases
var_dump( canSum( 7, [ 2 , 3, 4 ] ) ); // true
var_dump( canSum( 7, [ 1, 2, 3, 10 ] ) ); // false
var_dump( canSum( 7, [ 3, 4 ]  ) ); // true
var_dump( canSum( 8, [ 2, 3, 5 ] ) ); // true
var_dump( canSum(300, [ 7, 14 ] ) ); // false
