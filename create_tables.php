<?php
$server="localhost";
$username="myuser";
$password="mypassword";
$dbname="pcm";

//creates connection
$conn=mysqli_connect($server,$username,$password);

//checks connection
if(!$conn){
  die("\nConnection Failed : ".mysqli_connect_error()."\r\n\n");
}
echo "\nConnected Successfully using username : ".$username."\r\n";

//creates database
$sql="CREATE DATABASE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Database : ".$dbname." created successfully\r\n";
}else{
  echo "Error creating database : ".$dbname." ".mysqli_error($conn)."\r\n\n";
}

//connects to the database created above
$sql="USE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Connected to database : ".$dbname." with user : ".$username."\r\n";
}else{
  echo "Error connecting to database : ".$dbname." with user : ".$username." ".mysqli_error($conn)."\r\n\n";
}

//drops database
$sql="DROP DATABASE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Dropped database : ".$dbname." successfully\r\n";
}else{
  echo "Error dropping database : ".$dbname." ".mysqli_error($conn)."\r\n\n";
}

//creates tables
$tbname="names";
$sql="CREATE TABLE '".$tbname."'(
  cid int AUTO_INCREMENT,
  cname varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY(cid)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}
//closes connection
mysqli_close($conn);
echo "Succesfully Closed MYSQL Connection\r\n\n";
?>
