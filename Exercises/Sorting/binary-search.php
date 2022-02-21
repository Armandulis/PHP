<?php
/**
 * The idea of this binary search is to cut the searching volume in half, and keep cutting it untill you find the
 * Value you are looking for, we can easily implement this in sorting algorythm such as insertion-swap. Thanks to
 * binary search, we can reduce the O(n) to O(log2 n) where n is the elements we are searching through.
 */

/**
 * Find a key of the value $a in an sorted array
 * Binary Search helps to find this value in O(log2 n)
 * @param array $sortedNumbers - Array in which we will be doing binary search
 * @param int $numberToFind - Desired number
 * @param int $low - the low point of the array we're checking, default 0
 * @param int|null $high - the high point of the array we're checking
 * @return int index of the number
 */
function binarySearch( array $sortedNumbers, int $numberToFind, int $low = 0, ?int $high = null ) : int
{
    // $high will be either provided $high or the lenght of the array
    $high = $high ?? count( $sortedNumbers ) - 1;

    // We want to find the middle point of the array
    $middle = floor( ( $high + $low) / 2 );
    
    // We couldn't find this value in array
    if( $high < $low )
    {
        return -1;
    }

    // Lucky us the middle number is the one we're looking for return it's index
    if( $sortedNumbers[ $middle ] === $numberToFind ) 
    {
        return $middle;
    }

    // The number we're looking for is smaller than the middle one, meaning our $high becomes middle
    if( $sortedNumbers[ $middle ] > $numberToFind )
    {
        // Call it self with new $high to proceed with search
        // -1 because we already checked the middle one and we're looking for smaller number
        $high = $middle - 1;
        return binarySearch( $sortedNumbers, $numberToFind, $low, $high );
    }

    // The number we're looking for is bigger than the middle one, meaning our high becomes middle
    if( $sortedNumbers[ $middle ] < $numberToFind )
    {
        // Call it self with new $low to proceed with search
        // +1 because we already checked the middle one and we're looking for bigger number
        $low = $middle + 1;
        return binarySearch( $sortedNumbers, $numberToFind, $low, $high );
    }

    // We should never get here, so we could remove the if statement above, but i think it's a bit more readable like this
    // We couldn't find this value in array
    return -1;
}

# O(log2 n) n being the size of the array
// Test cases
var_dump(  'Number 7 is at index ' . binarySearch( [ 2, 4, 5, 6, 7, 8, 10 ], 7 ) ); // 4
var_dump(  'Number 10 is at index ' . binarySearch( [ 2, 4, 5, 6, 7, 8, 10 ], 10 ) ); // 6
var_dump(  'Number 2 is at index ' . binarySearch( [ 1, 1, 1, 1, 1, 1, 2 ], 2 ) ); // 6
var_dump(  'Number 0 is at index ' . binarySearch( [ 0, 10, 20, 23, 27, 29, 100 ], 0 ) ); // 0
var_dump(  'Number 1001 is at index ' . binarySearch( [ 0, 10, 20, 23, 27, 29, 100 ], 1001 ) ); // -1
