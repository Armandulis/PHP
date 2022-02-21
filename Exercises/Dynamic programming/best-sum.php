<?php

/**
 * Find a way to sum up numbers to result in $targetSum in a least amount of numbers
 * Ex. $targetSum = 7 $numbers = [ 3, 4, 5, 2, 7 ] => 7
 * @param int $targetSum - Sum to be found
 * @param int[] $numbers - Provided numbers
 * @param array<int, int[]> - An array to cache values 
 * @return array<int, int[]>|null - array of best numbers
 */
function bestSum( int $targetSum, array $numbers, &$cache = [] ) : ?array
{
    // Check if current $targetSum is already cached
    if( array_key_exists( $targetSum, $cache ) ) return $cache[ $targetSum ];
   
    // If we reach 0 - it means we are able to sum up $numbers to our $targetSum
    if( $targetSum === 0 ) return [];

    // If we went bellow 0, we are unable to reach our $targetSum
    if( $targetSum < 0 ) return null;

    // Default answer is null
    $bestSum = null;

    // Loop through numbers
    foreach( $numbers as $number )
    {
        // Take a way a number, and call bestSum() again with a new value
        $remainderTarget = $targetSum - $number;
        $result = bestSum( $remainderTarget, $numbers, $cache );

        // If the $result is null, we couldn't reach $targetSum
        if( $result !== null )
        {
            // If the result has less numbers in it than our current best sum, this is our new answer
            // Don't forget to add current number to the result
            $result[] = $number;   
            if( $bestSum === null || count( $bestSum ) > count( $result ) )
            {
                $bestSum = $result;
            }
        }
        
    }

    // Cache current value
    $cache[ $targetSum ] = $bestSum;
    return $bestSum;
}


# Brute force: O(n^m * m)
# Cached: O(m^2 * n)
// Test cases
var_dump( bestSum( 2, [ 1, 2 ] ) );
var_dump( bestSum( 7, [ 5, 3, 4, 7 ] ) ); // [ 7 ]
var_dump( bestSum( 8, [ 2, 3, 5 ] ) ); // [ 3, 5 ]
var_dump( bestSum( 8, [ 1, 4, 5 ]  ) ); // [ 4, 4 ]
var_dump( bestSum( 100, [ 1, 2, 5, 25 ] ) ); // [ 25, 25, 25, 25 ] 
