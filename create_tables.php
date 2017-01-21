<?php
$server="localhost";
$username="myuser";
$password="mypassword";
$dbname="pcm";

//creates connection
$conn=mysqli_connect($server,$username,$password);

//checks connection
if(!$conn){
  die("Connection Failed : ".mysqli_connect_error());
}
echo "Connected Successfully using username : ".$username;

//creates database
$sql="CREATE DATABASE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Database : ".$dbname." created successfully";
}else{
  echo "Error creating database : ".$dbname." ".mysqli_error($conn);
}

//connects to the database created above
$sql="USE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Connected to database : ".$dbname." with user : ".$username;
}else{
  echo "Error connecting to database : ".$dbname." with user : ".$username." ".mysqli_error($conn);
}

//closes connection
mysqli_close($conn);
?>
