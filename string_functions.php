<?php 
$username = "The Bro Code";
$phone = "123-456-789";
$username = strtolower($username); //lower case 
$username = strtoupper($username); //upper case
$username = trim($username); //trim the space
$username = str_pad($username, 20, "7"); //adds extra space 
$username = str_replace("-", "", $phone); //replace with the 1 with second
$username = strrev($username); //reverses the username
$username = str_shuffle($username); //shuffles the variable
$username = strcmp($username, "Bro Code"); //compares variables
$username = strpos($username, "o"); //finds the position of 2
$username = strlen($username); //counts usernames characters
$username = substr($username, 0, 3); //cuts the word within a 2 and 3
$lastname = substr($username, 4); //cuts words after 2 of character
echo $username;

$fullname = explode(" ", $username); //explodes the 1 of from the variable 
foreach($fullname as $name){
    echo $name; 
}

$username2 = array("The", "Bro","Code");
$fullname = implode(" ", $username2); //separates the strings in the array with 1
echo $fullname;


?>