<?php

require_once './Node.php';

function getAtIndexRec( $head, $index, $currentIndex = 0 ) {
    if( $head === null ) return 0;
    if( $currentIndex === $index ) return $head->value;

    return getAtIndexRec( $head->next, $index, $currentIndex + 1 );
}  

var_dump( getAtIndexRec( Node::initializeLinkedList(), 3 ) );
var_dump( getAtIndexRec( Node::initializeLinkedList(), 6 ) );


function getAtIndex( $head, $index ) {
    $currentIndex = 0;
    $current = $head;
    while( $current !== null )
    {
        if( $currentIndex === $index ) return $current->value;
        $currentIndex++;
        $current = $current->next;
    }

    return 0;
}


var_dump( getAtIndex( Node::initializeLinkedList(), 0 ) );
var_dump( getAtIndex( Node::initializeLinkedList(), 6 ) );
