<?php

require_once './Node.php';

function reverse( $head ) {

    $previous = null;
    $next = null;
    $current = $head;
    while( $current !== null )
    {
        $next = $current->next;
        $current->next = $previous; 
        $previous = $current;
        $current = $next;
    }

    return $previous;
}

var_dump( Node::initializeLinkedList() );
var_dump( reverse( Node::initializeLinkedList() ) );

function reverseRec( $head, $previous = null ) {
    if( $head === null ) return $previous;

    $next = $head->next;
    $head->next = $previous;
    $previous = $head;
    return reverseRec( $next, $previous );
}


var_dump( Node::initializeLinkedList() );
var_dump( reverse( Node::initializeLinkedList() ) );