<?php
/* SaiKumar Immadi */
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

//start first table

//machines
$tbname="machines";
$sql="CREATE TABLE ".$tbname."(
machine_id int AUTO_INCREMENT,
green_rank int NOT NULL UNIQUE,
CHECK(green_rank>0),
PRIMARY KEY(machine_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//end of first table

//start of second table

//ranks
$tbname="ranks";
$sql="CREATE TABLE ".$tbname."(
machine_id int NOT NULL UNIQUE,
rank int NOT NULL UNIQUE,
previous_rank int,
first_appearance int NOT NULL,
first_rank int NOT NULL,
FOREIGN KEY (machine_id) REFERENCES machines(machine_id),
CHECK(rank>0 AND previous_rank>0 AND first_appearance AND first_rank>0)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//end of second table

//start of third table

//details
$tbname="details";
$sql="CREATE TABLE ".$tbname."(
machine_id int NOT NULL UNIQUE,
machine varchar(255),
computer varchar(255) NOT NULL,
site varchar(255) NOT NULL,
manufacturer varchar(255) NOT NULL,
country varchar(255) NOT NULL,
region varchar(255) NOT NULL,
continent varchar(255) NOT NULL,
year year NOT NULL,
segment varchar(255) NOT NULL,
power_source varchar(255) NOT NULL,
FOREIGN KEY (machine_id) REFERENCES machines(machine_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//end of third table

//start of fourth table

//numbers
$tbname="numbers";
$sql="CREATE TABLE ".$tbname."(
machine_id int NOT NULL UNIQUE,
total_cores int NOT NULL,
accelerator_cores int NOT NULL,
rmax real NOT NULL,
rpeak real NOT NULL,
nmax real NOT NULL,
nhalf real NOT NULL,
power real NOT NULL,
mflops_per_watt real NOT NULL,
FOREIGN KEY (machine_id) REFERENCES machines(machine_id),
CHECK(total_cores>0 AND accelerator_cores>=0 AND rmax>0 AND rpeak>0 AND namx>=0 AND nmax>=0 AND power>0 AND mflops_per_watt>0)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//end of fourth table

//start of fifth table

//geeky_details
$tbname="geeky_details";
$sql="CREATE TABLE ".$tbname."(
machine_id int NOT NULL UNIQUE,
architecture varchar(255) NOT NULL,
processor varchar(255) NOT NULL,
processor_technology varchar(255) NOT NULL,
processor_speed int NOT NULL,
operating_system varchar(255) NOT NULL,
operating_system_family varchar(255) NOT NULL,
accelerator varchar(255) NOT NULL,
cores_per_socket int NOT NULL,
processor_generation varchar(255) NOT NULL,
system_model varchar(255) NOT NULL,
system_family varchar(255) NOT NULL,
interconnect varchar(255) NOT NULL,
interconnect_family varchar(255) NOT NULL,
FOREIGN KEY (machine_id) REFERENCES machines(machine_id),
CHECK(processor_speed>0 AND cores_per_socket>0)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//end of fifth table







//this sql statement can be removed when everything works
//drops database
// $sql="DROP DATABASE ".$dbname;
// if(mysqli_query($conn,$sql)){
// echo "Dropped database : ".$dbname." successfully\r\n";
// }else{
// echo "Error dropping database : ".$dbname." ".mysqli_error($conn)."\r\n\n";
// }

//closes connection
mysqli_close($conn);
echo "Succesfully Closed MYSQL Connection\r\n\n";
?>
