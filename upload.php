<?php

//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);
include("lib/xmllib.php");

$firstname = $_POST["firstname"];
//$middlename = $_POST["middlename"]);
$lastname = $_POST["lastname"];
$filename = $_POST["filename"];

if($filename==""){
    die(ERROR_EMPTY_PHOTO_NAME);
}

$timestamp = mktime();

if (file_exists(DATABASE)) {
    $mySimpleXml = new MySimpleXml(DATABASE,1);
    $xmlTreeHead = $mySimpleXml->MySimpleXml_load_file();
    $xmlTreeArray = $mySimpleXml->MySimpleXml_generate_xml_array();

    /* Method 1 to get current Photo ID: */
    //echo $xmlTreeArray["root"]["photoId"];
    
    /* Method 2 to get current Photo ID: */
    //echo $photoIDXmlNode->data;
    
    /* Method 3 to get current Photo ID: */
    //$mySimpleXml->depth_first_search($xmlTreeHead->next, $xmlTreeHead, "root", "photoId", $xmlNode);
    //echo $xmlNode->data;
    
    /* Method 1 to add a photo to xml database */
    $owner = new xmlPhotoOwnerElement($firstname, "", $lastname);
    $photo = new xmlPhotoElement($filename, "", $timestamp, $owner);
    echo $mySimpleXml->MySimpleXml_inser_xmlPhotoNode($photo);
    
    /* Method 2 to add a photo to xml database */
    //$photoElementContents = "<photo><name>789.jpg</name><id>3</id><time>20150721</time><owner>                <first_name>Daniel</first_name><last_name>Daniel</last_name></owner></photo>";
    //$mySimpleXml->MySimpleXml_inser_xmlNode_by_contents($photoElementContents, "root");
}else{
    die(ERROR_DATABASE_NOT_FOUND);
}

?>