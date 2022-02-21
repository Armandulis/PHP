<?php

/**
 * Finds n number, which is two previous numbers combined
 * @param int $n desired number
 * @param array<int, string> $cache cached values -> so we wouldn't need to try to find numbers we already know. 
 * Use it as reference and not as copy 
 * @return int the fibonacci number at possition $n
 */
function fibonacci( int $n, array &$cache = [] ): string 
{
  // If $n value was stored in 'cache' just return it instead of trying to find same number again
  if( isset($cache[ $n ] ) ) return $cache[ $n ];

  // First and second numbers in fibonacci are 1
  if($n <= 2) return 1;
  
  // Recruissive call, to get n number fibonacci we just have to add two previous numbers
  // Save value is cache 'cache'
  $cache[ $n ] = fibonacci( $n - 1, $cache ) + fibonacci( $n - 2, $cache ); 

  // Return sum of two numbers
  return $cache[ $n ]; 
}

// Without 'cache' it would take O(2^n), with cache, it only takes O(n)
// Test cases
var_dump( fibonacci( 7 ) );
var_dump( fibonacci( 50 ) );
var_dump( fibonacci( 500 ) );



// Tabulation
// TODO Figure out solution for PHP
function fibonacciTab( int $n ) : int
{
  $tabulation = array_fill( 0, $n + 1, 0 );
  $tabulation[ 1 ] = 1;

  foreach( $tabulation as $key => $table )
  {
    if (!isset($tabulation[ $key + 1 ])) {
        continue;
      }
    $tabulation[ $key + 1 ] += $table;
    var_dump( $table);
    
    if( !isset( $tabulation[ $key + 2 ] ) ) continue;
    $tabulation[ $key + 2 ] += $table;
  }

  var_dump( $tabulation);
  return $tabulation[ $n ];
}

// var_dump( fibonacciTab(6) ); // 8
// var_dump( fibonacciTab(7) ); // 13
// var_dump( fibonacciTab(8) ); // 21
// var_dump( fibonacciTab(50) ); // 12586269025