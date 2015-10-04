<?php
/*
 *  lib/xmllib.php
 *
 *  Copyright (C) Sep. 20 2015  Daniel Chen <danielchen0704@gmail.com>
 *
 */

include("commonlib.php");

/*
 * mySimpleXml - a class for converting a XML source file to a tree and operaing it as a database.
 *	@file:		         XML file name
 *  @agent:              The agent from which database is accessed,
 *                          0 for a web browser, 1 for a upload tool
 *	@xmlTreeArray:       an array to save XML items as a tree
 *	@xmlHeaderPattern:   a regular expression for the XML header
 *	@xmlTagStartPattern: a regular expression for the XML start tag
 *	@xmlTagEndPattern:   a regular expression for the XML end tag
 *  @xmlCommentPattern:  a regular expression for the XML comment
 *  @xmlTreeHead:        The head node of a XML tree
 *  @backTrace:          record a backtrace
 *  @classMethod         record the class methods' names
 */

class mySimpleXml{
    
    private $file;
    private $agent;
    private $xmlTreeArray = array();
    public $xmlHeaderPattern = '/^<\?xml.*>$/';
    public $xmlTagStartPattern = '/^<[^!\s]+.*>$/';
    public $xmlTagEndPattern = '/^<\/.+>$/';
    public $xmlCommentPattern = '/^<!--.*-->$/';
    private $xmlTreeHead = NULL;
    private $backTrace;
    private $classMethod;
    //private $xmlElement = array();
    
    function __construct($file, $agent) {
        $this->file = $file;
        $this->agent = $agent;
        $this->backTrace = debug_backtrace();
        $this->classMethod = get_class_methods(get_class($this));
        //echo $this->backTrace[0]["file"]."\n";
        //echo $this->backTrace[0]["line"]."\n";
    }

    /*
     * MySimpleXml_load_file - load a XML source file and parse it to a XML tree list.
     */
    
    public function MySimpleXml_load_file() {
        $contentQueue = new myQueue();
        if (!file_exists($this->file)) {
            die(ERROR_DATABASE_NOT_FOUND);
        }
        $handle = fopen($this->file, "r");
        if(!$handle) {
            die(ERROR_DATABASE_ACCESS_DENY);//1
        }
        $contents = '';
        $message = '';
        $name = '';
        $messageArray = array();
        $messageCnt = 0;
        $LessThanSymbolAppear = false;
        $CommentStart = false;
        $HyphenSymbolCnt = 0;
    
        $xmlCollection = new myStack();
        $this->xmlTreeHead = new xmlListNode("");// create XML tree head
        $this->xmlTreeHead->name = "XML Tree Head";
        $head = $this->xmlTreeHead;
        $linenum = 1;
        $xmlTagStartAppear = false;
        $errorMessage = array();
        $xmlElementPairsCheck = -1;
        $xmlEnd = false;
        $depth = -1;
        $lastCharacter = '';

        while (!feof($handle)) {
            if($contents!=''){
                $lastCharacter = $contents;
            }
            $contents = fread($handle, 1);// read one byte each time
            if($contents=="\r") {
                $contents = fread($handle, 1);
                if($contents=="\n") {// meet a new line symbol '\r\n'
                    $linenum++;
                    continue;
                }
            }
            $message = '';
            //echo $contents;
            if($contents=="<") {// XML element start
                if(!$CommentStart){ // not a XML comment start: "<!--"
                    $LessThanSymbolAppear = true;
                    while(!$contentQueue->isQueueEmpty()) {// dequeue each character in current queue
                        $message.= $contentQueue->dequeue();
                    }
                }
                //echo $message;
                $contentQueue->enqueue($contents);// enqueu '<'
            } else if ($contents==">") {// XML element end
                $contentQueue->enqueue($contents);
                if($LessThanSymbolAppear) {// '<' has appeared early time
                    while(!$contentQueue->isQueueEmpty()) {//dequeue all characters
                        $message.= $contentQueue->dequeue();
                    }
                    $LessThanSymbolAppear = false;
                } else if($CommentStart && $HyphenSymbolCnt>=4) {// comment end
                    while(!$contentQueue->isQueueEmpty()) {
                        $message.= $contentQueue->dequeue();
                    }
                    echo $message."\n";
                    $CommentStart = false;
                    $HyphenSymbolCnt = 0;
                }
                //echo $message."\n";
            } else if($contents=='-'&&$CommentStart) {
                $HyphenSymbolCnt++;
                $contentQueue->enqueue($contents);
            } else {
                $contentQueue->enqueue($contents);
                if($contents=='!'&&$LessThanSymbolAppear) {
                    if($lastCharacter!='<'){
                        //error comment format
                    }
                    $LessThanSymbolAppear = false;
                    $CommentStart = true;
                }
            }

            $message = trim ($message, "\t\n\r\0\x0B");
            if($message!='') {
                //echo $linenum.":".$message."\n";
                if(!preg_match($this->xmlHeaderPattern,$message)&&!preg_match($this->xmlCommentPattern,$message)) {
                    //echo "++++".$linenum.":".$message."+++++\n";
                    $messageArray[$messageCnt++] = $message;
                    if($xmlEnd) {
                        $errorMessage[] = "<b>Waring</b>: ".$this->classMethod[1]."(): ".$this->file.":".$linenum." parser error :  Extra content at the end of the document in <b>".$this->backTrace[0]["file"]."</b> on line <b>".$this->backTrace[0]["line"]."</b>";
                        $errorMessage[] = "<b>Waring</b>: ".$this->classMethod[1]."(): ".str_replace(">","&gt;",str_replace("<","&lt;",$message))." in <b>".$this->backTrace[0]["file"]."</b> on line <b>".$this->backTrace[0]["line"]."</b>";
                        $errorMessage[] = "<b>Waring</b>: ".$this->classMethod[1]."(): ^ in <b>".$this->backTrace[0]["file"]."</b> on line <b>".$this->backTrace[0]["line"]."</b>";
                        break;
                    }
                    
                    if(preg_match($this->xmlTagEndPattern,$message)) {//meet xml end tag
                        $xmlElementPairsCheck--;
                        $endTagNameTemp = preg_split("/[\s<\/>]+/",$message);
                        $endTagName = '';
                        $endTagName = $endTagNameTemp[1];
                        $depth --;
                        
                        //echo "end:+++++".$head->name.":".$message."+++++\n";
                        if($head->name!=$endTagName) {
                            if($head->parent!=NULL) {// It is tree head
                                $errorMessage[] = "<b>Waring</b>: ".$this->classMethod[1]."(): ".$this->file.":".$linenum." parser error :  Opening and ending tag mismatch: ".$head->name." line ".$head->lineInFile." and ".$endTagName." in <b>".$this->backTrace[0]["file"]."</b> on line <b>".$this->backTrace[0]["line"]."</b>";
                                $errorMessage[] = "<b>Waring</b>: ".$this->classMethod[1]."(): ".str_replace(">","&gt;",str_replace("<","&lt;",$message))." in <b>".$this->backTrace[0]["file"]."</b> on line <b>".$this->backTrace[0]["line"]."</b>";
                                $errorMessage[] = "<b>Waring</b>: ".$this->classMethod[1]."(): ^ in <b>".$this->backTrace[0]["file"]."</b> on line <b>".$this->backTrace[0]["line"]."</b>";
                            }
                        }
                        if($head->parent) {
                            $head = $head->parent;
                        }
                        //echo $head->name."\n";
                    } else if(preg_match($this->xmlTagStartPattern,$message)) {//meet xml start tag, pop all from stack first and then push xml start tag to stack
                        $xmlElementPairsCheck++;
                        $xmlTagStartAppear = true;
                        $startTagNametemp = preg_split("/[\s<>]+/",$message);
                        $startTagName = '';
                        $startTagName = $startTagNametemp[1];
                        $depth ++;
                        $item = new xmlListNode("");
                        $item->name = $startTagName;
                        $item->lineInFile = $linenum;
                        $item->parent = $head;
                        $item->depth = $depth;
                        //echo $item->name.":".$depth."\n";
                        //echo "start-1:+++++".$head->name.":".$message."+++++\n";
                        if($head->next!=NULL) {
                            $head = $head->next;
                            while($head->youngerBrother) {
                                $head->youngerBrother->olderBrother = $head;
                                $head = $head->youngerBrother;
                            }
                            $head->youngerBrother = $item;
                            $item->olderBrother = $head;
                        } else {
                            $head->next = $item;
                        }
                        $head = $item;
                        //echo "start-2:+++++".$head->name.":".$message."+++++\n";
                        
                        $this->xmlTreeHead->lastChild = $item;
                    } else {
                        $head->data = $message;
                        //echo "data:+++++".$head->name.":".$message."+++++\n";
                    }
                    if($xmlElementPairsCheck==-1) {
                        $xmlEnd = true;
                    }
                    //echo $xmlElementPairsCheck.":".$message."\n";
                }
            }
        }
        
        if(count($errorMessage)>0) {
            if($this->agent==0){
                foreach($errorMessage as $key => $value) {
                    echo "<br />\n";
                    echo $value."<br />\n";
                }
            }
            die(ERROR_DATABASE_FORMAT_INVALID);
        }
        fclose($handle);
        //$this->depth_first_trace($this->xmlTreeHead->next, $this->xmlTreeHead, $this->xmlTree);
        //$this->breadth_first_trace($this->xmlTreeHead->next, $this->xmlTreeHead, $this->xmlTreeArray);
        return $this->xmlTreeHead;
    }
    
    /*
     * MySimpleXml_generate_xml_array - convert the XML tree list to an array.
     */
    
    public function MySimpleXml_generate_xml_array() {
        if(!$this->xmlTreeHead){
            $this->MySimpleXml_load_file();
        }
        $this->breadth_first_trace($this->xmlTreeHead->next, $this->xmlTreeHead, $this->xmlTreeArray);
        return $this->xmlTreeArray;
    }
    
    /*
     * MySimpleXml_get_xmlNode - load a XML source file and parse it to a XML tree list.
     *	@treeHead:           XML tree head
     *  @targetParentName:   name of parent node of the target XML node to get
     *  @targetName:         name of the target XML node to get
     *  @targetData:         data of the target XML node to get
     *  @xmlNode:            the target XML node to return
     */
    
    public function MySimpleXml_get_xmlNode(&$treeHead, $targetParentName, $targetName, $targetData, &$xmlNode) {
        //echo $treeHead->name;
        //echo $targetName;
        $this->depth_first_search($treeHead, NULL, $targetParentName, $targetName, $targetData, $xmlNode);
        return $xmlNode;
    }
    
    public function MySimpleXml_create_xmlNode(xmlListNode &$xmlNode) {
    }
    
    /*
     * MySimpleXml_insert_childXmlNode_to - add a XML node as a child to a XML tree list.
     *	@xmlNode:     XML node to add
     *  @toXmlNode:   XML node as a parent to add to
     */
    
    public function MySimpleXml_insert_childXmlNode_to(xmlListNode &$xmlNode, xmlListNode &$toXmlNode){
        $child = $toXmlNode;
        while($child->next) {
            $child = $child->next;
        }
        $child->next = $xmlNode;
        $xmlNode->parent = $child;
    }
    
    /*
     * MySimpleXml_insert_youngerBrotherXmlNode_to - add a XML node as a younger brother (next node) to a XML tree list.
     *	@xmlNode:     XML node to add
     *  @toXmlNode:   XML node as a older brother (previous node) to add to
     */
    
    public function MySimpleXml_insert_youngerBrotherXmlNode_to(xmlListNode &$xmlNode, xmlListNode &$toXmlNode){
        $child = $toXmlNode; 
        while($child->youngerBrother){
            $child->youngerBrother->olderBrother = $child;
            $child = $child->youngerBrother;
        }
        $child->youngerBrother = $xmlNode;
        $xmlNode->olderBrother = $child;
        $xmlNode->parent = $child->parent;
    }
    
    /*
     * MySimpleXml_inser_xmlPhotoNode - Add a photograph as a node to a XML tree list.
     *  @xmlElement:           a photograph element to add as a XML node
     */
    
    public function MySimpleXml_inser_xmlPhotoNode(xmlPhotoElement $xmlElement){
        $photoIDXmlNode = new xmlListNode("");
        $this->MySimpleXml_get_xmlNode($this->xmlTreeHead, "root","photoId", "", $photoIDXmlNode);
        $photoIDXmlNode->data += 1;
        
        $xmlPhotoNode = new xmlListNode("");
        $xmlPhotoNode->name = "photo";
        
        $xmlPhotoNameNode = new xmlListNode($xmlElement->name);
        $xmlPhotoNameNode->name = "name";
        
        $this->MySimpleXml_insert_childXmlNode_to($xmlPhotoNameNode, $xmlPhotoNode);
        
        $xmlPhotoIDNode = new xmlListNode($photoIDXmlNode->data);
        $xmlPhotoIDNode->name = "id";
        
        $this->MySimpleXml_insert_youngerBrotherXmlNode_to($xmlPhotoIDNode, $xmlPhotoNameNode);
        $xmlPhotoOwnerNode = new xmlListNode("");
        $xmlPhotoOwnerNode->name = "owner";
        
        $xmlPhotoOwnerFirstNameNode = new xmlListNode($xmlElement->owner->firstName);
        $xmlPhotoOwnerFirstNameNode->name = "first_name";
        
        $this->MySimpleXml_insert_childXmlNode_to($xmlPhotoOwnerFirstNameNode, $xmlPhotoOwnerNode);
        
        $xmlPhotoOwnerLastNameNode = new xmlListNode($xmlElement->owner->lastName);
        $xmlPhotoOwnerLastNameNode->name = "last_name";
        
        $this->MySimpleXml_insert_youngerBrotherXmlNode_to($xmlPhotoOwnerLastNameNode, $xmlPhotoOwnerFirstNameNode);
        
        $this->MySimpleXml_insert_youngerBrotherXmlNode_to($xmlPhotoOwnerNode, $xmlPhotoIDNode);
        
        // add photo to xml tree
        $this->MySimpleXml_insert_youngerBrotherXmlNode_to($xmlPhotoNode, $this->xmlTreeHead->next->next);

        $xmlPhotoTreeArray = array();
        $this->breadth_first_trace($this->xmlTreeHead->next, $this->xmlTreeHead, $xmlPhotoTreeArray);
        //print_r($xmlPhotoTreeArray);
        
        return $this->MySimpleXml_save_file('database.xml');
    }
    
    /*
     * MySimpleXml_inser_xmlNode_by_contents - Add a photo to xml database by write xml file directly.
     *	@appendContents:     contents to add to XML source file
     *  @appendToTagName:    XML tag name to insert contents after
     */
    
    public function MySimpleXml_inser_xmlNode_by_contents($appendContents, $appendToTagName){
        $contentQueue = new myQueue();
        $handle = fopen($this->file, "r");
        $newFileHandle = fopen("new_database.xml","w");
        if(!$newFileHandle) {
            die(ERROR_DATABASE_ACCESS_DENY);
        }
        $contents = '';
        $message = '';
        $CommentStart = false;
        $linenum = 1;

        while (!feof($handle)){
            $contents = fread($handle, 1);
            if($contents=="\r"){
                $contents = fread($handle, 1);
                if($contents=="\n");{
                    $linenum++;
                    continue;
                }
            }
            $message = '';
            //echo $contents;
            if($contents=="<"){
                if(!$CommentStart){
                    $LessThanSymbolAppear = true;
                    while(!$contentQueue->isQueueEmpty()){
                        $message.= $contentQueue->dequeue();
                    }
                }
                //echo $message;
                $contentQueue->enqueue($contents);
            }else if ($contents==">"){
                $contentQueue->enqueue($contents);
                if($LessThanSymbolAppear){ //dequeue all contents   
                    while(!$contentQueue->isQueueEmpty()){
                        $message.= $contentQueue->dequeue();
                    }
                    $LessThanSymbolAppear = false;
                }else if($CommentStart&&$HyphenSymbolCnt>=4){  
                    while(!$contentQueue->isQueueEmpty()){
                        $message.= $contentQueue->dequeue();
                    }
                    $CommentStart = false;
                    $HyphenSymbolCnt = 0;
                }
                //echo $message;
            }else if($contents=='-'&&$CommentStart){
                $HyphenSymbolCnt++;
                $contentQueue->enqueue($contents);
            }else{
                $contentQueue->enqueue($contents);
                if($contents=='!'&&$LessThanSymbolAppear){
                    $LessThanSymbolAppear = false;
                    $CommentStart = true;
                }
            }
            $message = trim ($message, "\t\n\r\0\x0B");
            if($message=="</".$appendToTagName.">"){
                fwrite($newFileHandle, $appendContents, strlen($appendContents));
            }
            fwrite($newFileHandle, $message, strlen($message));
        }
        fclose($handle);
        fclose($newFileHandle);
        
        //It needs to take an action to save the new xml file back to the old one
        if (!copy("new_database.xml", "database.xml")){
            die(ERROR_DATABASE_WRITE_FAIL);
        }
    }
    
    /*
     * MySimpleXml_save_file - convert the XML tree list to a XML source file of database.
     *	@file:     target XML source file of database to be saved
     */
    
    public function MySimpleXml_save_file($file){
        $content = '';
        $this->create_xml_by_DFS($this->xmlTreeHead->next, $this->xmlTreeHead, $content);
        //echo $content;
        if (file_exists('database.xml')) {
            if (is_writable($file)){
                if (!$handle = fopen($file, 'w')){
                    return ERROR_DATABASE_ACCESS_DENY;//2
                }

                if (fwrite($handle, $content) === FALSE) {
                    return ERROR_DATABASE_WRITE_FAIL;//3
                }
                fclose($handle);
                return SUCCESS;
            }else{
                return ERROR_DATABASE_WRITE_DENY;//4
            }
        }else{
            return ERROR_DATABASE_NOT_FOUND;//1
        }
    }
    
    /*
     * create_xml_by_DFS - Generate xml contents from XML tree list.
     *	@contentRoot:           root tag name of XML source file 
     *	@parentOfContentRoot:   XML tree head
     *	@xmlContent:            to save contens of XML source file
     */
    
    public function create_xml_by_DFS($contentRoot, $parentOfContentRoot, &$xmlContent){
        if($contentRoot){
            $xmlContent .= "<".$contentRoot->name.">";
            if($contentRoot->next){
                $this->create_xml_by_DFS($contentRoot->next, $contentRoot, $xmlContent);
            }
            $xmlContent .= $contentRoot->data;
            $xmlContent .= "</".$contentRoot->name.">";
            if($contentRoot->youngerBrother){
                $this->create_xml_by_DFS($contentRoot->youngerBrother, $parentOfContentRoot, $xmlContent);
            }
        }
    }
    
    /*
     * (Ongoing)
     * depth_first_search - Depth First search nodes in XML tree list by parent name and node name.
     *	@root:           root of the tree to start for searching
     *	@rootParent:     parent of root
     *	@parentName:     parent name of root
     *	@nodeName:       name of the target node
     *	@elementData:    data of the target node
     *	@xmlNode:        target node to return
     */
    
    public function depth_first_search($root, $rootParent, $parentName, $nodeName, $nodeData, xmlListNode &$xmlNode){
        if($root){
            if($root->name == $nodeName && ($root->data == $nodeData || $nodeData == "") ){
                if($parentName==''){
                    $xmlNode = $root;
                    return $root;
                }else{
                    if($root->parent && $root->parent->name == $parentName){
                        //echo $root->parent->name."\n";
                        $xmlNode = $root;
                        return $root;
                    }
                }
            }else{
                if($root->next){
                    $this->depth_first_search($root->next, $root, $parentName, $nodeName, $nodeData, $xmlNode);
                }
                if($root->youngerBrother){
                    $this->depth_first_search($root->youngerBrother, $rootParent, $parentName, $nodeName, $nodeData, $xmlNode);
                }
            }
        }
        //$xmlNode =  NULL;
    }
    
    /*
     * (not done)
     * depth_first_trace - Depth First trace xml node list and convert it to an array.
     *	@root:           root of the tree to start for tarcing
     *	@rootParent:     parent of root
     *  @parentArray:    array to save these tree nodes
     */
    
    public function depth_first_trace(xmlListNode $root, xmlListNode $xmlParentNode, &$parentArray){
        if($root)
        {
            if($root->data!='')
            {
                $childArray[$root->name] = $root->data;
            }
            else
            {
                $childArray = array();
            }
            if($root->next)
            {
                $this->depth_first_trace($root->next, $root, $childArray);
            }
            if($root->youngerBrother)
            {
                $this->depth_first_trace($root->youngerBrother, $xmlParentNode, $parentArray);
            }
            /*echo "parent = ".$xmlParentNode->name.", child = ".$root->name."\n";
            echo "+++++ child array +++++\n";
            print_r($childArray);
            echo "----- child array -----\n";
            echo "+++++ parent array +++++\n";
            print_r($parentArray);
            echo "----- parent array -----\n\n";*/
            //echo $root->name.":".$root->data."<br/>\n";
        }
    }
    
    /*
     * depth_first_trace - Breadth First trace xml node list and convert it to an array.
     *	@root:           root of the tree to start for tarcing
     *	@rootParent:     parent of root
     *  @parentArray:    array to save these tree nodes
     */
    
    public function breadth_first_trace(xmlListNode $root, xmlListNode $xmlParentNode, &$parentArray){
        if($root){
            $repeat = false;
            if($root->data!=''){
                $childArray[$root->name] = $root->data;
            }
            else{
                $childArray = array();
            }
            /*echo "parent = ".$xmlParentNode->name.", child = ".$root->name."\n";
            echo "+++++ child array +++++\n";
            print_r($childArray);
            echo "----- child array -----\n";
            echo "+++++ parent array +++++\n";
            print_r($parentArray);
            echo "----- parent array -----\n\n";*/
            if($root->youngerBrother){
                $this->breadth_first_trace($root->youngerBrother, $xmlParentNode, $parentArray);
            }
            /*echo "+++++++++++++++++++++++++++++++++No Brothers:+++++++++++++++++++++++++++++++++\n";
            echo "I am ".$root->name.", my parent is ".$xmlParentNode->name."\n";
            echo "---------------------------------No Brothers:---------------------------------\n\n";*/
            if($root->next){           
                $this->breadth_first_trace($root->next, $root, $childArray);
            }
            foreach($parentArray as $key => $value){
                if($key == $root->name){
                    //echo $root->name."\n";
                    $repeat = true;
                    break;
                    //print_r($parentArray);
                }
            }
            if(!$repeat){
                if($root->data!=''){
                    $parentArray[$root->name] = $root->data;
                }else{
                    $parentArray[$root->name] = array_reverse($childArray);
                }
            }else{
                if (!empty($parentArray[$root->name][0])){
                    $tempForRepeat = array();
                    foreach($parentArray[$root->name] as $key => $value){
                        $tempForRepeat[] = $value;
                        unset($parentArray[$root->name][$key]);
                    }
                    $i=0;
                    $parentArray[$root->name][$i++] = (($root->data!='')?$root->data:array_reverse($childArray));
                    for($i=0;$i<count($tempForRepeat);$i++){
                        $parentArray[$root->name][$i+1] = $tempForRepeat[$i];
                    }
                }else{
                    $tempForRepeat = $parentArray[$root->name];
                    unset($parentArray[$root->name]);
                    $parentArray[$root->name][] = (($root->data!='')?$root->data:array_reverse($childArray));
                    $parentArray[$root->name][] = $tempForRepeat;
                }
                $repeat = false;
            }
            /*echo "parent = ".$xmlParentNode->name.", child = ".$root->name."\n";
            echo "+++++ child array +++++\n";
            print_r($childArray);
            echo "----- child array -----\n";
            echo "+++++ parent array +++++\n";
            print_r($parentArray);
            echo "----- parent array -----\n\n";*/
            /*echo "+++++++++++++++++++++++++++++++++No Children:+++++++++++++++++++++++++++++++++\n";
            echo "I am ".$root->name.", my parent is ".$xmlParentNode->name."\n";
            echo "---------------------------------No Children:---------------------------------\n\n";*/
            //print_r($item);
            //echo "<br/>\n";
            //echo $root->name.":".$root->data."<br/>\n";
        }
    }
}
?>