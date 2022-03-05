<?php
require_once './Node.php';

$Node = Node::initializeLinkedList();

/**
 * Prints throught linked list
 * @param Node|null $head
 */
function printLinkedList( $head ) 
{
    // Set current node
    $current = $head;

    // Make sure the value exists
    while( $current !== null )
    {
        // Print value
        var_dump( $current->value );
        $current = $current->next;
    }
}

// printLinkedList( $Node );

/**
 * Prints throught linked list
 * @param Node|null $head
 */
function printLinkedListRecursive( $head )
{
    // Base case: head is null, end recursion
    if( $head === null ) return;

    // Print value
    var_dump( $head->value );

    // Call itself with next node
    printLinkedListRecursive( $head->next );
}

printLinkedListRecursive( $Node );