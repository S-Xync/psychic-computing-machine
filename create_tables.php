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

//start first table

//machines
$tbname="machines";
$sql="CREATE TABLE ".$tbname."(
machine_id int AUTO_INCREMENT,
machine_name varchar(255) NOT NULL UNIQUE,
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
green_rank int NOT NULL UNIQUE,
rank int NOT NULL UNIQUE,
previous_rank int,
first_appearance int NOT NULL,
first_rank int NOT NULL,
FOREIGN KEY (machine_id) REFERENCES machines(machine_id),
CHECK(green_rank>0 AND rank>0 AND previous_rank>0 AND first_appearance AND first_rank>0)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//end of second table

//start of third table

//computers
$tbname="computers";
$sql="CREATE TABLE ".$tbname."(
computer_id int AUTO_INCREMENT,
computer_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY(computer_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//sites
$tbname="sites";
$sql="CREATE TABLE ".$tbname."(
site_id int AUTO_INCREMENT,
site_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (site_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//manufacturers
$tbname="manufacturers";
$sql="CREATE TABLE ".$tbname."(
manufacturer_id int AUTO_INCREMENT,
manufacturer_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (manufacturer_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//countries
$tbname="countries";
$sql="CREATE TABLE ".$tbname."(
country_id int AUTO_INCREMENT,
country_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (country_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//regions
$tbname="regions";
$sql="CREATE TABLE ".$tbname."(
region_id int AUTO_INCREMENT,
region_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (region_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//continents
$tbname="continents";
$sql="CREATE TABLE ".$tbname."(
continent_id int AUTO_INCREMENT,
continent_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (continent_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//segments
$tbname="segments";
$sql="CREATE TABLE ".$tbname."(
segment_id int AUTO_INCREMENT,
segment_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (segment_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//power_sources
$tbname="power_sources";
$sql="CREATE TABLE ".$tbname."(
power_source_id int AUTO_INCREMENT,
power_source_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (power_source_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//details
$tbname="details";
$sql="CREATE TABLE ".$tbname."(
machine_id int NOT NULL UNIQUE,
computer_id int NOT NULL,
site_id int NOT NULL,
manufacturer_id int NOT NULL,
country_id int NOT NULL,
region_id int NOT NULL,
continent_id int NOT NULL,
year year NOT NULL,
segment_id int NOT NULL,
power_source_id int NOT NULL,
FOREIGN KEY (machine_id) REFERENCES machines(machine_id),
FOREIGN KEY (computer_id) REFERENCES computers(computer_id),
FOREIGN KEY (site_id) REFERENCES sites(site_id),
FOREIGN KEY (manufacturer_id) REFERENCES manufacturers(manufacturer_id),
FOREIGN KEY (country_id) REFERENCES countries(country_id),
FOREIGN KEY (region_id) REFERENCES regions(region_id),
FOREIGN KEY (continent_id) REFERENCES continents(continent_id),
FOREIGN KEY (segment_id) REFERENCES segments(segment_id),
FOREIGN KEY (power_source_id) REFERENCES power_sources(power_source_id)
)";

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

//architectures
$tbname="architectures";
$sql="CREATE TABLE ".$tbname."(
architecture_id int AUTO_INCREMENT,
architecture_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (architecture_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//processors
$tbname="processors";
$sql="CREATE TABLE ".$tbname."(
processor_id int AUTO_INCREMENT,
processor_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (processor_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//processor_technologies
$tbname="processor_technologies";
$sql="CREATE TABLE ".$tbname."(
processor_technology_id int AUTO_INCREMENT,
processor_technology_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (processor_technology_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//operating_systems
$tbname="operating_systems";
$sql="CREATE TABLE ".$tbname."(
operating_system_id int AUTO_INCREMENT,
operating_system_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (operating_system_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//operating_system_families
$tbname="operating_system_families";
$sql="CREATE TABLE ".$tbname."(
operating_system_family_id int AUTO_INCREMENT,
operating_system_family_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (operating_system_family_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//accelerators
$tbname="accelerators";
$sql="CREATE TABLE ".$tbname."(
accelerator_id int AUTO_INCREMENT,
accelerator_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (accelerator_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//processor_generations
$tbname="processor_generations";
$sql="CREATE TABLE ".$tbname."(
processor_generation_id int AUTO_INCREMENT,
processor_generation_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (processor_generation_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//system_models
$tbname="system_models";
$sql="CREATE TABLE ".$tbname."(
system_model_id int AUTO_INCREMENT,
system_model_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (system_model_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//system_families
$tbname="system_families";
$sql="CREATE TABLE ".$tbname."(
system_family_id int AUTO_INCREMENT,
system_family_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (system_family_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//interconnects
$tbname="interconnects";
$sql="CREATE TABLE ".$tbname."(
interconnect_id int AUTO_INCREMENT,
interconnect_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (interconnect_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//interconnect_families
$tbname="interconnect_families";
$sql="CREATE TABLE ".$tbname."(
interconnect_family_id int AUTO_INCREMENT,
interconnect_family_name varchar(255) NOT NULL UNIQUE,
PRIMARY KEY (interconnect_family_id)
)";
if(mysqli_query($conn,$sql)){
echo "Table : ".$tbname." created successfully\r\n";
}else{
echo "Table : ".$tbname." not created ".mysqli_error($conn)."\r\n";
}

//geeky_details
$tbname="geeky_details";
$sql="CREATE TABLE ".$tbname."(
machine_id int NOT NULL UNIQUE,
architecture_id int NOT NULL,
processor_id int NOT NULL,
processor_technology_id int NOT NULL,
processor_speed int NOT NULL,
operating_system_id int NOT NULL,
operating_system_family_id int NOT NULL,
accelerator_id int NOT NULL,
cores_per_socket int NOT NULL,
processor_generation_id int NOT NULL,
system_model_id int NOT NULL,
system_family_id int NOT NULL,
interconnect_id int NOT NULL,
interconnect_family_id int NOT NULL,
FOREIGN KEY (machine_id) REFERENCES machines(machine_id),
FOREIGN KEY (architecture_id) REFERENCES architectures(architecture_id),
FOREIGN KEY (processor_id) REFERENCES processors(processor_id),
FOREIGN KEY (processor_technology_id) REFERENCES processor_technologies(processor_technology_id),
FOREIGN KEY (operating_system_id) REFERENCES operating_systems(operating_system_id),
FOREIGN KEY (operating_system_family_id) REFERENCES operating_system_families(operating_system_family_id),
FOREIGN KEY (accelerator_id) REFERENCES accelerators(accelerator_id),
FOREIGN KEY (processor_generation_id) REFERENCES processor_generations(processor_generation_id),
FOREIGN KEY (system_model_id) REFERENCES system_models(system_model_id),
FOREIGN KEY (system_family_id) REFERENCES system_families(system_family_id),
FOREIGN KEY (interconnect_id) REFERENCES interconnects(interconnect_id),
FOREIGN KEY (interconnect_family_id) REFERENCES interconnect_families(interconnect_family_id),
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
