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

//creates tables

//names
$tbname="names";
$sql="CREATE TABLE ".$tbname."(
  id int AUTO_INCREMENT,
  name varchar(255) NOT NULL UNIQUE,
  PRIMARY KEY(id)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//green_ranks
$tbname="green_ranks";
$sql="CREATE TABLE ".$tbname."(
  id int NOT NULL UNIQUE,
  green_rank int NOT NULL UNIQUE,
  CHECK(green_rank>0),
  FOREIGN KEY (id) REFERENCES names(id)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//ranks
$tbname="ranks";
$sql="CREATE TABLE ".$tbname."(
  id int NOT NULL UNIQUE,
  rank int NOT NULL UNIQUE,
  CHECK(rank>0),
  FOREIGN KEY (id) REFERENCES names(id)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//previous_ranks
$tbname="previous_ranks";
$sql="CREATE TABLE ".$tbname."(
  id int NOT NULL UNIQUE,
  previous_rank int,
  CHECK(previous_rank>0),
  FOREIGN KEY (id) REFERENCES names(id)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//first_appearances
$tbname="first_appearances";
$sql="CREATE TABLE ".$tbname."(
  id int NOT NULL UNIQUE,
  first_appearance int NOT NULL,
  CHECK(first_appearance>0),
  FOREIGN KEY (id) REFERENCES names(id)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//first_ranks
$tbname="first_ranks";
$sql="CREATE TABLE ".$tbname."(
  id int NOT NULL UNIQUE,
  first_rank int NOT NULL,
  CHECK(first_rank>0),
  FOREIGN KEY (id) REFERENCES names(id)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//computer_names
$tbname="computer_names";
$sql="CREATE TABLE ".$tbname."(
  cid int AUTO_INCREMENT,
  cname varchar(255) NOT NULL,
  PRIMARY KEY(cid)
)";
if(mysqli_query($conn,$sql)){
  echo "Table : ".$tbname." created successfully\r\n";
}else{
  echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//computers
$tbname="computers";
$sql="CREATE TABLE ".$tbname."(
  id int NOT NULL UNIQUE
)";



//drops database
$sql="DROP DATABASE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Dropped database : ".$dbname." successfully\r\n";
}else{
  echo "Error dropping database : ".$dbname." ".mysqli_error($conn)."\r\n\n";
}

//closes connection
mysqli_close($conn);
echo "Succesfully Closed MYSQL Connection\r\n\n";
?>
