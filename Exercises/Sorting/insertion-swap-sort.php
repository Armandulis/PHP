<?php
/**
 * Insertion Sort
 * It's a sort algorything that takes the a number from the list and compares it with a number to the left side of it
 * (Because left should be smallest number) If the number on the left is bigger, we want to move the bigger number to 
 * the right, then we compare our number with the number more to the left. When we finally reach a value that is smaller
 * than our number, we place our number to the current position, to the right of the smaller number.
 */


/**
 * Sorts the scrambled array of numbers
 */
function insertionSwap() : void
{
    $numbers = [ 5, 4, 6, 3, 1, 8, 2, 7, 9 ];
    var_dump( 'Unsorted: ' . implode( ', ', $numbers ) );

    // We loop through all numbers, important to know they key (position of current number)
    foreach( $numbers as $key => $number )
    {
        // This is happening:
        // Key => number    currentComparison value     While loop check    Values that were switched   Current $numbers
        // 0   => 5;        CurrentComparison = -1;     false;              0 => 0                      [ 5, 4, 6...]
        // 1   => 4;        CurrentComparison =  0;     4 < 5;              1=>5; 0=> 4                 [ 4, 5, 6...]
        // 2   => 6;        CurrentComparison =  1;     false;              2=>6                        [ 4, 5, 6, 3 ..]
        // 3   => 3;        CurrentComparison =  2;     3 < 6;              3=>6; 2=>5; 1=>4; 0=>3      [ 3, 4, 5, 6 ..]    

        // We want to compare  current number with a number to the left of it
        $currentComparison = $key - 1 ; 

        // Check if number to the left if bigger
        while( $currentComparison >= 0 && $number < $numbers[ $currentComparison ] )
        {
            // The number is bigger so
            // We want to put number that is to the left of out number to the right side
            // NOTE that we might have already moved we time to the left, so we can't use the $key anymore
            // Use the comparison key
            $numbers[ $currentComparison + 1 ] = $numbers[ $currentComparison ];
           
            // Now we will have to compare our number to the left side again
            $currentComparison--;
        }
        
        // Now the left side is smaller 
        // so we know that we want to add our number to the right of the number we just checked $currentComparison + 1
        $numbers[ $currentComparison + 1 ] = $number;
    }

    var_dump( implode( ', ', $numbers ) );
}

/**
 * Insertion swap is great, but it's slow. The O(n^2) is slow. It's important to note that ALL numbers on the LEFT side
 * of the array are sorted, So insead of checking every numberm what we could do is check the number in the middle of the
 * 'LEFT side array'. Binary search does exactly that, split array into to, check if the the number we're searching for
 * is bigger or smaller than the middle number. If the it's lower, do the same with the left side, and vise versa.
 * @param int[] $arrayToSort - unsorted array
 * @param int[] - sorted array
 */
function binaryInsertionSwap( array $arrayToSort ) : array
{
    // Loop through numbers
    foreach( $arrayToSort as $key => $number )
    {   
        // Find the number that is left of the current number we're checking
        $numberToMove = $key - 1;

        // Find a location of the index where we should place this number
        $location = binarySearch( array_slice( $arrayToSort, 0, $key), $number );

        // Now we want to move all numbers that are down to locations index to the right side 
        while( $location <= $numberToMove )
        {
            // Move the bigger numbers to the right side
            $arrayToSort[ $numberToMove + 1 ] = $arrayToSort[ $numberToMove ];  
            $numberToMove--;
        }
        
        // Insert this number to the location
        $arrayToSort[ $location == -1 ? 0 : $location ] = $number;
        
    }

    return $arrayToSort;
}


/**
 * Binary search only takes O(log2 n)
 * Here's a small exaplme of how it will work:
 * 2, 5, 7, 8, 10 => 4
 * L: 0, H:4, middle: 2, it is lower, so high becomes middle-1, ( 0 to 1 )
 * L: 0, H:1, middle: 0, it's higher, so low becomes middle+1, (1 to 1 )
 * L: 1, H:1, middle: 1, Low is equal or higher than high, so we return current $low which is 1, so 4 should be inserted into 1 
 * @param int[] $sortedArray - we'll be doing search here
 * @param int $numberToFind - numbere we're searching for
 * @param int $low - default 0 - the lowest point in the array
 * @param int|null $high - default null - the highest point in array
 * @return int - Index of the number where it should be placed at
 */
function binarySearch( array $sortedArray, int $numberToFind, int $low = 0, ?int $high = null  ) : int
{
    // High and low by default are 0/null, if high is null, the high should be the lenght of the array
    $high = $high ?? count( $sortedArray ) - 1; 

    // We reached the end of the array
    if( $low >= $high ) {
        // Because we do ">=" we will be left with two last numbers of the array
        // So we simply have to check if we should return the "last index" or index before last one.
        return $numberToFind > $sortedArray[ $low ] ? $low + 1 : $low ;
    }

    // Find the middle number ( floor() - used if we divide by 2 and end up with something like 4.5 turn it into 4)
    $middle = floor( ( $low + $high ) / 2);

    // We found the exact same value in the array, so just return this index + 1, to insert it right after this same value
    if( $sortedArray[ $middle ] == $numberToFind ) return $middle + 1;

    // The middle number is lower than the number we're searching for, so $low becomes middle+1 (because we already
    // checked middle one), then call itself
    if( $sortedArray[ $middle ] < $numberToFind )
    {
        $low = $middle + 1;
        return binarySearch( $sortedArray, $numberToFind, $low, $high );
    }

    // The middle number at this point is higher than the number we're searching for, so $high becomes middle-1.
    // (because we already checked middle one), then call itself
    $high = $middle - 1;
    return binarySearch( $sortedArray, $numberToFind, $low, $high ); 
}



// Test cases
$numbers = [  9, 5, 4, 2, 2, 2, 2, 2, 2, 1, 1, 1, 6, 3, 1, 8, 2, 7, 9, 9, 9, 9, 9, 9 ];
var_dump( 'Unsorted: ' . implode( ', ', $numbers ) );
var_dump( 'Sorted: ' . implode( ', ', binaryInsertionSwap( $numbers ) ) );


// Here's a nice representation of how it works:
// string(35) "Unsorted: 5, 4, 6, 3, 1, 8, 2, 7, 9"
// string(37) "We want to put index 0(5)into index 1"
// string(34) "Sorted!: 5, 5, 6, 3, 1, 8, 2, 7, 9"

// string(35) "Unsorted: 5, 5, 6, 3, 1, 8, 2, 7, 9"
// string(37) "We want to put index 1(4)into index 0"
// string(34) "Sorting: 5, 5, 6, 3, 1, 8, 2, 7, 9"
// string(34) "Sorted!: 4, 5, 6, 3, 1, 8, 2, 7, 9"

// string(35) "Unsorted: 4, 5, 6, 3, 1, 8, 2, 7, 9"
// string(37) "We want to put index 2(6)into index 2"
// string(34) "Sorted!: 4, 5, 6, 3, 1, 8, 2, 7, 9"

// string(35) "Unsorted: 4, 5, 6, 3, 1, 8, 2, 7, 9"
// string(37) "We want to put index 3(3)into index 0"
// string(34) "Sorting: 4, 5, 6, 6, 1, 8, 2, 7, 9"
// string(34) "Sorting: 4, 5, 5, 6, 1, 8, 2, 7, 9"
// string(34) "Sorting: 4, 4, 5, 6, 1, 8, 2, 7, 9"
// string(34) "Sorted!: 3, 4, 5, 6, 1, 8, 2, 7, 9"

// string(35) "Unsorted: 3, 4, 5, 6, 1, 8, 2, 7, 9"
// string(37) "We want to put index 4(1)into index 0"
// string(34) "Sorting: 3, 4, 5, 6, 6, 8, 2, 7, 9"
// string(34) "Sorting: 3, 4, 5, 5, 6, 8, 2, 7, 9"
// string(34) "Sorting: 3, 4, 4, 5, 6, 8, 2, 7, 9"
// string(34) "Sorting: 3, 3, 4, 5, 6, 8, 2, 7, 9"
// string(37) "We want to put index 5(8)into index 5"
// string(34) "Sorted!: 1, 3, 4, 5, 6, 8, 2, 7, 9"

// string(35) "Unsorted: 1, 3, 4, 5, 6, 8, 2, 7, 9"
// string(37) "We want to put index 6(2)into index 1"
// string(34) "Sorting: 1, 3, 4, 5, 6, 8, 8, 7, 9"
// string(34) "Sorting: 1, 3, 4, 5, 6, 6, 8, 7, 9"
// string(34) "Sorting: 1, 3, 4, 5, 5, 6, 8, 7, 9"
// string(34) "Sorting: 1, 3, 4, 4, 5, 6, 8, 7, 9"
// string(34) "Sorting: 1, 3, 3, 4, 5, 6, 8, 7, 9"
// string(34) "Sorted!: 1, 2, 3, 4, 5, 6, 8, 7, 9"

// string(35) "Unsorted: 1, 2, 3, 4, 5, 6, 8, 7, 9"
// string(37) "We want to put index 7(7)into index 6"
// string(34) "Sorting: 1, 2, 3, 4, 5, 6, 8, 8, 9"
// string(34) "Sorted!: 1, 2, 3, 4, 5, 6, 7, 8, 9"

// string(35) "Unsorted: 1, 2, 3, 4, 5, 6, 7, 8, 9"
// string(37) "We want to put index 8(9)into index 8"
// string(34) "Sorted!: 1, 2, 3, 4, 5, 6, 7, 8, 9"
// string(33) "Sorted: 1, 2, 3, 4, 5, 6, 7, 8, 9"