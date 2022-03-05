<?php

require_once './Node.php';

/**
 * Returns the array of all node's values
 * @param Node|null $head
 * @param string[] $values
 * @return string[]  
 */
function getLinkedListValuesAsArray( $head, $values = [] )
{
    if( $head === null ) return $values;

    
    $values = getLinkedListValuesAsArray( $head->next, $values );
    $values[] = $head->value;

    return $values;
}

$Node = Node::initializeLinkedList();
var_dump( getLinkedListValuesAsArray( $Node ) );