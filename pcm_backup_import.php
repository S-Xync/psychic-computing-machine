<?php
/* SaiKumar Immadi */
$server="localhost";
$username="myuser";
$password="mypassword";
$dbname="pcm_backup";

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
echo "The user used for importing already BackedUp Database is ->myuser<-\r\n";
system("mysql -umyuser -p pcm_backup < pcm_backup.sql");
?>
