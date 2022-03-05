<?php
require_once './Node.php';

function sumList( ?Node $head ) {
    $answer = 0;
    if( $head === null ) return $answer;
    
    $answer += sumList( $head->next );
    $answer += $head->value;

    return $answer;
}

var_dump( sumList( Node::initializeNumbersLinkedList() ) );