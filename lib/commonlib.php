<?php
/*
 *  lib/commonlib.php
 *
 *  Copyright (C) Sep. 20 2015  Daniel Chen <danielchen0704@gmail.com>
 *
 */
define('DATABASE', "database.xml");

define('SUCCESS', "0:Success");
define('ERROR_DATABASE_NOT_FOUND', "1:Database not found");
define('ERROR_DATABASE_ACCESS_DENY',"2:Database access deny");//can't R/W
define('ERROR_DATABASE_WRITE_FAIL',"3:Database write fail");
define('ERROR_DATABASE_WRITE_DENY',"4:Database write deny");//can't W
define('ERROR_DATABASE_FORMAT_INVALID',"5:Database format is invalid");//can't W
define('ERROR_EMPTY_PHOTO_NAME', "6:photo name is empty");

define('ERROR_UNKNOWN',"9:Unknown error");

/*
 * myQueue - enqueue characters embraced in XML tag and then dequeue as XML item.
 *	@MAXQUEUE:		Maximum size of this queue
 *	@queue:         An array to place characters
 *	@front:         The started index of an queue
 *	@rear:	        The ended index of an queue
 */

class myQueue{
    private $MAXQUEUE = 1024;
    private $queue = array();
    private $front = -1;
    private $rear = -1;

    public function enqueue($item){
        if($this->front==($this->rear = ($this->rear +1 )%$this->MAXQUEUE)){
            die("Queue is full");
        }else{
            $this->queue[$this->rear] = $item;
        }
    }

    public function dequeue(){
        if($this->front==$this->rear){
            return "";
            //die("Queue is empty");
        }
        else{   
            $this->front = ($this->front +1)%$this->MAXQUEUE;
            $temp = $this->queue[$this->front];
            unset($this->queue[$this->front]);
            return $temp;
        }
    }
    
    public function isQueueEmpty(){
        if($this->front==$this->rear)
            return true;
        else
            return false;
    }
    
    public function isQueueFull(){
        if($this->rear == (($this->front+1)%$this->MAXQUEUE))
            return true;
        else
            return false;
    }
}

/*
 * myStack - push each XML item and then pop them to form an XML tree.
 *	@MAXSTACK:		Maximum size of this stack
 *	@stack :        An array to place items
 *	@top:           The top index of an stack
 */

class myStack{
    private $MAXSTACK = 1024;
    private $stack = array();
    private $top = -1;
    
    public function push($item){
        if ($this->top == $this->MAXSTACK-1){
            die("Stack is full");
        }else{
            $this->top++;
            $this->stack[$this->top]=$item;
            //echo "($this->top: $item)\n";
        }
    }
    
    public function pop(){
        if ($this->top == -1){
            die("Stack is empty");
        }else{
            $temp = $this->stack[$this->top];
            unset($this->stack[$this->top]);
            $this->top--;
            return $temp;
        }
    }
    
    public function isStackEmpty(){
        if ($this->top == -1)
            return true;
        else
            return false;
    }
    
    public function isStackFull(){
        if ($this->top == $this->MAXSTACK-1)
            return true;
        else
            return false;
    }
}

/*
 * xmlListNode - a node structure for XML items.
 *	@name:		        XML node name
 *	@data :             XML node Data
 *	@next:              Link to next XML node
 *  @lastChild:         The last node in a XML tree
 *  @parent:            The parent of a XML node
 *  @youngerBrother:    Link to next XML node
 *  @olderBrother:      Link to previous XML node
 *  @lineInFile:        The line number in a XML source file
 *  @depth:             The level in a XML tree
 */

class xmlListNode{
    /* XML node name */
    public $name;
    /* XML node Data */
    public $data; 
    /* Link to next XML node */
    public $next;
    /* last node in XML tree */
    public $lastChild;
    /* parent of a XML node*/
    public $parent;
    public $youngerBrother;
    public $olderBrother;
    public $lineInFile;
    public $depth;
 
    /* Node constructor */
    function __construct($data){
        $this->name = NULL;
        $this->data = $data;
        $this->next = NULL;
        $this->lastChild = NULL;
        $this->parent = NULL;
        $this->youngerBrother = NULL;
        $this->olderBrother = NULL;
        $this->lineInFile = 0;
        $this->depth = 0;
    }
}

/*
 * xmlPhotoElement - a special node structure for photographs.
 *	@name:		        name of a photograph
 *	@id:                id of a photograph
 *	@time:              upload time of a photograph
 *  @owner:             owner of a photograph
 */

class xmlPhotoElement{
    public $name;
    public $id;
    public $time;
    public $owner;
    function __construct($name, $id, $time, $owner) {
        $this->name = $name;
        $this->id = $id;
        $this->time = $time;
        $this->owner = $owner;
    }
}

/*
 * xmlPhotoOwnerElement - a special node structure for an owner information of a photograph.
 *	@$firstName:     The first name of an owner
 *	@middleName:     The middle name of an owner
 *	@lastName:       The last name of an owner
 */

class xmlPhotoOwnerElement{
    public $firstName;
    public $middleName;
    public $lastName;
    function __construct($firstName, $middleName, $lastName) {
        $this->firstName = $firstName;
        $this->middleName = $middleName;
        $this->lastName = $lastName;
    }
}
?>