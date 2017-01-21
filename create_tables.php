<?php
$server="localhost";
$username="myuser";
$password="mypassword";
$dbname="pcm";

//creates connection
$conn=mysqli_connect($server,$username,$password);

//checks connection
if(!$conn){
  die("Connection Failed : ".mysqli_connect_error()."\r\n");
}
echo "Connected Successfully using username : ".$username."\r\n";

//creates database
$sql="CREATE DATABASE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Database : ".$dbname." created successfully\r\n";
}else{
  echo "Error creating database : ".$dbname." ".mysqli_error($conn)."\r\n";
}

//connects to the database created above
$sql="USE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Connected to database : ".$dbname." with user : ".$username."\r\n";
}else{
  echo "Error connecting to database : ".$dbname." with user : ".$username." ".mysqli_error($conn)."\r\n";
}

//drops database
$sql="DROP DATABASE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Dropped database : ".$dbname." successfully\r\n";
}else{
  echo "Error dropping database : ".$dbname." ".mysqli_error($conn)."\r\n";
}

//closes connection
mysqli_close($conn);
ehco "Succesfully Closed MYSQL Connection";
?>
