<?php

/**
 * Find how many times each valye in array was repeated
 */
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

countWords();