<?php
require_once './Node.php';

function find( $head, $target ) {
    $current = $head;

    while( $current !== null )
    {
        if( $current->value === $target ) return true;
        $current = $current->next;
    }

    return false;
}

var_dump( find( Node::initializeLinkedList(), 'B' ) );
var_dump( find( Node::initializeLinkedList(), 'G' ) );

function findRec( $head, $target ) {

    if( $head === null ) return false;
    if( $head->value === $target ) return true;
    return findRec( $head->next, $target );
}

var_dump( findRec( Node::initializeLinkedList(), 'B' ) );
var_dump( findRec( Node::initializeLinkedList(), 'G' ) );
