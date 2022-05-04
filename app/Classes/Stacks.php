<?php

namespace App\Classes;


class Stacks {
    private $people;

    public function __construct(){
        $this->people = [];
    }

    function front(){
        if(!$this->isEmpty()){
            return $this->people[0];
        }
        return null;
    }

    function back(){
        if(!$this->isEmpty()){
            $counts = count($this->people) - 1;
            return $this->people[$counts];
        }
        return null;
    }

    function isEmpty(){
        return empty($this->people);
    }

    function enqueue($item){
        array_push($this->people, $item);
    }

    function dequeue(){
        if($this->front !== null){
            return array_shift($this->people);
        }
        return null;
    }


    
}

/* class Stacks {
    public function __construct($limit=5, $initial=[]){
        $this->limit = $limit;
        $this->stack = $initial;
    }

    public function push($item){
        if(count($this->stack) < $this->limit){
            array_unshift($this->stack, $item); // insert new item in the beginning of the array
        }else{
            echo "Stack is full<br>";
        }
    }

    public function pop(){
        if($this->isEmpty){
            echo "Stack is empty<br>";
        }else{
            array_shift($this->stack); // remove the first item
        }
    }

    public function top(){
        return current($this->stack);
    }

    public function isEmpty(){
        return empty($this->stack);
    }
} */