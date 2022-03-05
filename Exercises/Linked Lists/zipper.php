<?php

require_once './Node.php';

function zipper($head, $headSecond ) {
    $headResult = $head;
    $currentFirst = $head->next;
    $currentSecond = $headSecond;
    $checkFirst = false;

    while ($currentFirst !== null && $currentSecond !== null) 
    {
        if( $checkFirst )
        {
            $headResult->next = $currentFirst;
            $currentFirst = $currentFirst->next;

           
        }
        else
        {
            $headResult->next = $currentSecond;
            $currentSecond = $currentSecond->next;
        }
        $headResult = $headResult->next;
        $checkFirst = !$checkFirst;
    }
    if( $currentFirst !== null )
    {
        $headResult->next = $currentFirst;
    }
    
    if( $currentSecond !== null )
    {
        $headResult->next = $currentSecond;
    }

    return $head;
}

// var_dump( zipper( Node::initializeLinkedList(), Node::initializeNumbersLinkedList() ) );




// TODO analize this again, try to solve again
function zipperRec($head, $headSecond  )
{
    if( $head === null && $headSecond === null ) return null;
    if( $head === null ) return $headSecond;
    if( $headSecond == null ) return $head;
    $nextFirst = $head->next;
    $nextSecond = $headSecond->next;
    $head->next = $headSecond;
    $headSecond->next = zipperRec( $nextFirst, $nextSecond );
    return $head;
}


var_dump( zipperRec( Node::initializeLinkedList(), Node::initializeNumbersLinkedList() ) );

