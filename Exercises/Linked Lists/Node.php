<?php 

/**
 * Class Node
 */
class Node
{
    public $value = null;
    public $next = null;

    /**
     * Node Constructor
     * @param $value 
     */
    function __construct( $value ) {
        $this->value = $value;
        $this->next = null;
    }

    public static function initializeLinkedList() : Node {
        // Create nodes
        $a = new Node( 'A' );
        $b = new Node( 'B' );
        $c = new Node( 'C' );
        $d = new Node( 'D' );

        // Link all nodes: $a -> $b -> $c -> $d -> null
        $a->next = $b;
        $b->next = $c;
        $c->next = $d;

        return $a;
    }

    public static function initializeNumbersLinkedList() : Node {
        // Create nodes
        $a = new Node( 2 );
        $b = new Node( 8 );
        $c = new Node( 3 );
        $d = new Node( 7 );

        // Link all nodes: $a -> $b -> $c -> $d -> null
        $a->next = $b;
        $b->next = $c;
        $c->next = $d;

        return $a;
    }
}