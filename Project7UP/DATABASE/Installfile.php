<?php

include 'Config_Database.php';

//-------CREATE A DATABASE -------

$sql = 'CREATE DATABASE`'. $db['database'] .'` COLLATE "latin1_general_ci"';

echo $sql ."<br>";

mysqli_query($conn,$sql);

echo mysqli_error($conn) ."<br>"; 

//------- CREATE A TABLE -------

mysqli_select_db($conn, $db['database']);

$sql = "CREATE TABLE `Users`(
       `UserID` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
       `UserEmail` VARCHAR(250) UNIQUE KEY,
       `UserName` VARCHAR(250) UNIQUE KEY,
       `UserPassword` VARCHAR(500),
       `UserType` VARCHAR(2)
       )";

//UserType -
//OW = Owner
//AD = Admin
//NU = Normal user

echo $sql ."<br>";

mysqli_query($conn,$sql);

echo mysqli_error($conn) ."<br>";
//------- CREATE Projecten -------

$sql = "CREATE TABLE `Projecten`(
       `ProjectID` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
       `ProjectName` VARCHAR(255),
       `ProjectDescription` text,
       `Category` VARCHAR(255),
       `ProjectNameImage` MEDIUMTEXT, 
       `ProjectDataImage` LONGBLOB
       )";

echo $sql ."<br>";

mysqli_query($conn,$sql);

echo mysqli_error($conn) ."<br>";
//------- CREATE LOG -------

$sql = "CREATE TABLE `Log`(
       `LogID` MEDIUMINT NOT NULL PRIMARY KEY,
       `UserID` MEDIUMINT,
       `IpAdress` VARCHAR(255),
       `Inlogtijd` time,
       `uitlogtijd` time
       )";

echo $sql ."<br>";

mysqli_query($conn,$sql);

echo mysqli_error($conn) ."<br>";

//------- INSERT ADMIN -------

$IN_UserEmail = "Admin@klantservice.nl";
$IN_UserName = "Admin";
$IN_UserPassword = "Welkom01";

$IN_Type = "OW";

$IN_UserPassword = password_hash($IN_UserPassword, PASSWORD_DEFAULT);

$sql = "INSERT INTO `Users` SET 
       `UserEmail` = '". $IN_UserEmail ."',
       `UserName` = '". $IN_UserName ."',
       `UserPassword` = '". $IN_UserPassword ."',
       `UserType` = '". $IN_Type ."'
       ";

echo $sql ."<br>";

mysqli_query($conn,$sql);

echo mysqli_error($conn) ."<br>";

//---------------------------------


//------- END CODE -------
?>
<br><a href="../Home/">< to back</a>