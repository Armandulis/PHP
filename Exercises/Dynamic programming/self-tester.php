<?php
// A notebook/sandbox for me to solve problems

function insertionSwap() : void
{
    $numbers = [ 5, 4, 6, 3, 1, 8, 2, 7, 9];
    var_dump( 'Unsorted: ' . implode( ', ', $numbers ) );

    // We loop through all numbers, important to know they key (position of current number)
    foreach( $numbers as $key => $number )
    {
        // 0 => 5; CurrentComparison -1; false; 0 => 0                   [ 5, 4, 6...]
        // 1 => 4; CurrentComparison 0;   4 <5; 1=>5; 0=> 4              [ 4, 5, 6...]
        // 2 => 6; CurrentComparison 1;  false;  2=>6                    [ 4, 5, 6, 3, 1...]
        // 3 => 3; CurrentComparison 2;  3 < 6; 3=>6; 2=>5; 1=>4; 0=>3   [ 3, 4, 5, 6]    


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

insertionSwap();


function countWords() : void
{
    $words = [ 'php', 'c#', 'php', 'php', 'c#', 'java', 'c#', 'java' ];

    $answer = [];
    foreach( $words as $word )
    {
        $answer[ $word ] = isset( $answer[ $word ] ) ? $answer[ $word ] + 1 : 1; 
    }
    var_dump( $answer);
}

// countWords();


/**
 * Check how many ways we can add strings from $words that will result in $target
 * Example: ('tester', [ 'tes', 'ter', 'te', 'st', 'er', 't', 'ester' ]) -> 4
 * Example: (tester, [] ) -> 0
 * @param string $target - Value you want to generate
 * @param string[] $words - A list of words
 */
function countConstructString( string $target, array $words, array &$cache = [] ) : int 
{
    if( isset( $cache[ $target ] ) ) return $cache[ $target ];
    if( $target === '' ) return 1;

    $countAnswer = 0;

    foreach( $words as $word )
    {
        $prefix = substr( $target, 0, strlen( $word ) );

        if( $prefix === $word )
        {
           $countAnswer += countConstructString( substr( $target, strlen( $word ) ), $words, $cache );
        }
    }

    $cache[ $target ] = $countAnswer;
    return $countAnswer;
}


// var_dump( countConstructString( 'tester', [ 'tes', 'ter', 'te', 'st', 'er', 't', 'ester' ] ) ); // 4
// var_dump( countConstructString('tester', [ 'st', 'er', 'in', 'tes', 't'] ) ); // 1
// var_dump( countConstructString( 'skateboard', ['bo', 'rd', 'ate', 't', 'ska', 'sk', 'boar' ] ) ); // 0
// var_dump( countConstructString( 'this is a nice sentence', [ 'this ', 'is', ' ', 'a', 'nice  ', 'nice', 'sentence' ] ) ); // 1
// var_dump( countConstructString( 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeef', [ 'e', 'ee', 'eee', 'eeee', 'eeeee', 'eeeee', 'eeeeee' ] ) ); // 0

/**
 * Check how many ways we can add strings from $words that will result in $target
 * Example: ('tester', [ 'tes', 'ter', 'te', 'st', 'er', 't', 'ester' ]) -> 4
 * Example: (tester, [] ) -> 0
 * @param string $target - Value you want to generate
 * @param string[] $words - A list of words
 */
function allConstructString( string $target, array $words, array &$cache = [] ) : array 
{
    if( isset( $cache[ $target ] ) ) return $cache[ $target ];
    if( $target === '' ) return [[]];

    $answer = [];

    foreach( $words as $word )
    {
        $prefix = substr( $target, 0, strlen( $word ) );

        if( $prefix === $word )
        {
            $results = allConstructString( substr( $target, strlen( $word ) ), $words, $cache );

            foreach( $results as $result )
            {
                $result[] = $word;
                $answer[] = $result;
            }
        } 
    }

    $cache[ $target ] = $answer;
    return $answer;
}
    // var_dump('hello');
    // var_dump( allConstructString( 'tester', [ 'tes', 'ter', 'te', 'st', 'er', 't', 'ester' ] ) ); // [['test', 'ter'], [ 'er', 't', 'tes'], ['er', 'st', 'te'], ['t', 'ester']]
    // var_dump( allConstructString('tester', [ 'st', 'er', 'in', 'tes', 't'] ) ); // // [['er', 't', 'tes]]
    // var_dump( allConstructString( 'skateboard', ['bo', 'rd', 'ate', 't', 'ska', 'sk', 'boar' ] ) );
    // var_dump( allConstructString( 'this is a nice sentence', [ 'this ', 'is', ' ', 'a', 'nice  ', 'nice', 'sentence' ] ) ); // [[ 'sentence', ' ', 'nice', ' ', 'a', ' ', 'is', 'this ' ]]
    // var_dump( allConstructString( 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeef', [ 'e', 'ee', 'eee', 'eeee', 'eeeee', 'eeeee', 'eeeeee' ] ) ); // []
    
    
    
/**
 * Check if we can add strings from $words that will result in $target
 * Example: (skateboard, [bo, rd, ate, t, ska, sk, boar ]) -> false
 * Example: (tester, [ st, er, in, tes, te] ) -> true
 * @param string $target - Value you want to generate
 * @param string[] $words - A list of words
 */
function canConstructString( string $target, array $words, array &$cache = [] ) : bool 
{
    if( isset( $cache[ $target ] ) ) return $cache[ $target ];
    if( $target === '' ) return true;

    // substr strlen
    foreach( $words as $word )
    {
        $prefix = substr( $target, 0, strlen( $word ) );
        
        if( $prefix === $word )
        {
            if( canConstructString( substr( $target, strlen( $word ) ), $words, $cache ) ) 
            {
                return true;
            }
        }
    }

    $cache[ $target ] = false;
    return false;
}


// var_dump( canConstructString('tester', [ 'st', 'er', 'in', 'tes', 't'] ) );
// var_dump( canConstructString( 'skateboard', ['bo', 'rd', 'ate', 't', 'ska', 'sk', 'boar' ] ) );
// var_dump( canConstructString( 'this is a nice sentence', [ 'this ', 'is', ' ', 'a', 'nice  ', 'nice', 'sentence' ] ) );
// var_dump( canConstructstring( 'eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeef', [ 'e', 'ee', 'eee', 'eeee', 'eeeee', 'eeeee', 'eeeeee' ] ) );



function bestSum( $targetSum, $numbers, &$cache = [] ) : ?array
{
    if( array_key_exists( $targetSum, $cache ) ) return $cache[ $targetSum ];
    if( $targetSum < 0 ) return null;
    if( $targetSum === 0 ) return [];
   
    $bestSum = null;

    foreach( $numbers as $num )
    {
        $result = bestSum( $targetSum - $num, $numbers, $cache );

        if( $result !== null )
        {
            $result[] = $num;
            if( $bestSum === null || count( $bestSum ) > count( $result ) )
            {
                $bestSum = $result;
            }
        }
        
        $cache[ $targetSum ] = $bestSum;
    }

    $cache[ $targetSum ] = $bestSum;
    return $bestSum;
}

// # Brute force: O(n^m * m)
# Cached: O(m^2 * n)
// var_dump( bestSum( 2, [ 1, 2 ] ) );
// var_dump( bestSum( 7, [ 5, 3, 4, 7 ] ) ); // [ 7 ]
// var_dump( bestSum( 8, [ 2, 3, 5 ] ) ); // [ 3, 5 ]
// var_dump( bestSum( 8, [ 1, 4, 5 ]  ) ); // [ 4, 4 ]
// var_dump( bestSum( 100, [ 1, 2, 5, 25 ] ) ); // [ 25, 25, 25, 25 ] 



/**
 * Finds how add numbers from array to get target sum
 * @param int $targetSum 
 * @param int[] $numbers
 * @return ?int[] null if cant find sum when add numbers or array of numbers who's sum is targer sum 
 */
function howSum( int $targetSum, array $numbers, array &$cache = [] ): ?array
{
    if( array_key_exists( $targetSum, $cache ) ) return $cache[ $targetSum ]; 
    if( $targetSum < 0 ) return null;
    if( $targetSum === 0 ) return [];
    

    foreach( $numbers as $num )
    {
        $result = howSum( $targetSum - $num, $numbers, $cache );
        
        if( $result !== null)
        {
            $result[] = $num;
            return $result;
        }
    }

    $cache[ $targetSum ] = null;
    return null;
}

# Brute force: O(n^m * m)
# Cached: O(n+m^2)
// #

// var_dump( howSum( 7, [ 2 , 3 ] ) ); // [ 3, 2, 2 ]
// var_dump( howSum( 7, [ 5 , 3, 4, 7 ] ) ); // [ 4, 3 ]
// var_dump( howSum( 7, [ 2, 4 ]  ) ); // null
// var_dump( howSum( 8, [ 2, 3, 5 ] ) ); // [ 2, 2, 2, 2 ] 
// var_dump( howSum(300, [ 7, 14 ] ) ); // null


/**
 * Checks if it is possible to add numbers to results in target sum
 * @param int $targetSum
 * @param int[] $numbers
 * @return bool true if we can add up numbers to target sum 
 */
function canSum( int $targetSum, array $numbers, array &$cache = [] ): bool
 {
    if( isset( $cache[ $targetSum ] ) ) return $cache[ $targetSum ];
    if( $targetSum < 0  ) return false;
    if( $targetSum === 0 ) return true;
     
    foreach( $numbers as $num )
    {
        if( canSum( $targetSum - $num, $numbers, $cache ) )
        {
            $cache[ $targetSum ] = true;
            return true;
        } 
    }
     
    $cache[ $targetSum ] = false;
    return false;
 }

//  var_dump( canSum( 7, [ 2 , 3, 4 ] ) ); // true
//  var_dump( canSum( 7, [ 1, 2, 3, 10 ] ) ); // false
//  var_dump( canSum( 7, [ 3, 4 ]  ) ); // true
//  var_dump( canSum( 8, [ 2, 3, 5 ] ) ); // true
//  var_dump( canSum(300, [ 7, 14 ] ) ); // false
 

/**
 * Find the shortest path from top left of the grid to bottom right
 * @param int $width width of the grid
 * @param int $height height of the grid
 * @param array<string, int> $cache cached values
 */
function gridTraveler( int $width, int $height, &$cache = [] ) : int
{
    $key = $width . '-' . $height;
    if( isset($cache[ $key ] ) ) return $cache[ $key ];
    if( $width === 0 || $height === 0 ) return 0;
    if( $width === 1 && $height === 1 ) return 1;

    $result = gridTraveler( $width - 1, $height, $cache ) + gridTraveler( $width, $height - 1, $cache );
    $cache[ $key ] = $result;
    return $result;
}

// var_dump( gridTraveler( 18, 18 ) );

// 1 x 1 -> 0
// 1 x 2 -> 1
// 2 x 2 -> 2
// 2 x 3 -> 3 
// 3 x 3 -> 

/**
 * Finds n-th number, which is two previous numbers combined
 * @param int $n desired number
 * @param array<int, string> $cache cached values -> so we wouldn't need to try to find numbers we already know. 
 * Use it as reference and not as copy 
 */
function fibonacci( int $number, array &$cache = [] ) : string
{
    var_dump( $number );
    # 0, 1, 1, 2, 3, 5, 8, 13
    if( $number <= 0 ) return 0;
    if( $number < 2 ) return 1;

    return fibonacci( $number - 1 ) + fibonacci( $number - 2 );
}


// var_dump( fibonacci( 5 ) );