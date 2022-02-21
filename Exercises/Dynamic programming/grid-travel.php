<?php

/**
 * Find the shortest path from top left of the grid to bottom right
 * @param int $width width of the grid
 * @param int $height height of the grid
 * @param array<string, int> $cache cached values
 * @return int The amount of steps it took to reach the right bottom square
 */
function gridTraveler( int $width, int $height, array &$cache = [] ): int
{
    // Cached values are a combination of $width - $height
    if( isset( $cache[ $width . '-' . $height ] ) )
    {
        return $cache[ $width . '-' . $height ];
    }

    // Our base case is 1x1 - you stay in place to reach your target
    if( $width == 1 && $height == 1 )
    {
        return 1; 
    }

    // Invalid grid return 0
    if ( $width == 0 || $height == 0 )
    {
        return 0;
    }

    // Call it self going right and going down, combine these two results, possibly do this until we reach 
    // most bottom right square. Going right or down makes our grid smaller by one
    $result = gridTraveler($width - 1, $height, $cache ) + gridTraveler( $width, $height -1, $cache );

    // Cache values
    $cache[  $width . '-' . $height ] = $result;
    return $result;
}

# Brute force: O(2^(n+m)) 
# Cached: O(n*m)
// Test cases
var_dump( gridTraveler(1, 4) );
var_dump( gridTraveler(18, 18) );
