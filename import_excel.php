<?php
/* SaiKumar Immadi */
$server = "localhost";
$username = "myuser";
$password = "mypassword";
$dbname = "pcm";

//creates connection
$conn=mysqli_connect($server,$username,$password);

//checks connection
if(!$conn){
die("\nConnection Failed : ".mysqli_connect_error()."\r\n\n");
}
echo "\nConnected Successfully using username : ".$username."\r\n";

//connects to the database created above
$sql="USE ".$dbname;
if(mysqli_query($conn,$sql)){
echo "Connected to database : ".$dbname." with user : ".$username."\r\n";
}else{
echo "Error connecting to database : ".$dbname." with user : ".$username." ".mysqli_error($conn)."\r\n\n";
}

?>
<html>
<head>
<style type="text/css">
body
{
margin: 0;
padding: 0;
background-color:#FFFFFF;
text-align:center;
}
.top-bar
{
width: 100%;
height: auto;
text-align: center;
background-color:#FFF;
border-bottom: 1px solid #000;
margin-bottom: 20px;
}
.inside-top-bar
{
margin-top: 5px;
margin-bottom: 5px;
}
.link
{
font-size: 18px;
text-decoration: none;
background-color: #000;
color: #FFF;
padding: 5px;
}
.link:hover
{
background-color: #FCF3F3;
}
</style>

</head>
<body>
<div class="top-bar">
<div class="inside-top-bar">Import Excel Sheet into MYSQL<br><br>
</div>
</div>
<div style="text-align:left; border:1px solid #333333; width:300px; margin:0 auto; padding:10px;">

<form name="import" method="post" enctype="multipart/form-data">
<input type="file" name="file" /><br />
<input type="submit" name="submit" value="Submit" />
</form>
<?php
if(isset($_POST["submit"]))
{
$file = $_FILES['file']['tmp_name'];
$handle = fopen($file, "r");
$c = 0;
while(($filesop = fgetcsv($handle, ",")) !== false)
{
$rank = $filesop[1];
$previous_rank = $filesop[2];
$first_appearance= $filesop[3];
$first_rank = $filesop[4];
$machine = $filesop[5];
$computer = $filesop[6];
$site = $filesop[7];
$manufacturer = $filesop[8];
$country = $filesop[9];
$year = $filesop[10];
$segment = $filesop[11];
$total_cores = $filesop[12];
$accelerator_cores = $filesop[13];
$rmax = $filesop[14];
$rpeak = $filesop[15];
$nmax = $filesop[16];
$nhalf = $filesop[17];
$power = $filesop[18];
$power_source = $filesop[19];
$mflops_per_watt = $filesop[20];
$architecture = $filesop[21];
$processor = $filesop[22];
$processor_technology = $filesop[23];
$processor_speed = $filesop[24];
$operating_system = $filesop[25];
$operating_system_family = $filesop[26];
$accelerator = $filesop[27];
$cores_per_socket = $filesop[28];
$processor_generation = $filesop[29];
$system_model = $filesop[30];
$system_family = $filesop[31];
$interconnect_family = $filesop[32];
$interconnect = $filesop[33];
$region = $filesop[34];
$continent = $filesop[35];
//insert into ranks table
if(strlen($previous_rank)==0){
  $sql = "INSERT INTO ranks (rank,first_appearance,first_rank) VALUES ('".$rank."','".$first_appearance."','".$first_rank."')";
}else{
  $sql = "INSERT INTO ranks (rank,previous_rank,first_appearance,first_rank) VALUES ('".$rank."','".$previous_rank."','".$first_appearance."','".$first_rank."')";
}
if(mysqli_query($conn,$sql)){
}else{
  echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
}
//retrieve green_rank from ranks table
$sql="SELECT green_rank FROM ranks WHERE rank='".$rank."'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==1){
  $row = mysqli_fetch_assoc($result);
  $green_rank=$row["green_rank"];
}else{
  echo "Error inserting rows into database ".$dbname."\r\n\n";
}
//insert into locations table
$sql="INSERT INTO locations (country,region,continent) VALUES ('".$country."','".$region."','".$continent."')";
mysqli_query($conn,$sql);
//retrieve location_id from locations table
$sql="SELECT location_id FROM locations WHERE country='".$country."'";
$result=mysqli_query($conn,$sql);
if(mysqli_num_rows($result)==1){
  $row = mysqli_fetch_assoc($result);
  $location_id=$row["location_id"];
}else{
  echo "Error inserting rows into database ".$dbname."\r\n\n";
}
//insert into details table
if(strlen($machine)==0){
  $sql="INSERT INTO details (green_rank,computer,site,manufacturer,location_id,year,segment,power_source) VALUES ('".$green_rank."','".$computer."','".$site."','".$manufacturer."','".$location_id."','".$year."','".$segment."','".$power_source."')";
}else{
  $sql="INSERT INTO details (green_rank,machine,computer,site,manufacturer,location_id,year,segment,power_source) VALUES ('".$green_rank."','".$machine."','".$computer."','".$site."','".$manufacturer."','".$location_id."','".$year."','".$segment."','".$power_source."')";
}
if(mysqli_query($conn,$sql)){
}else{
  echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
}
//insert into numbers table
$sql="INSERT INTO numbers (green_rank,total_cores,accelerator_cores,rmax,rpeak,nmax,nhalf,power,mflops_per_watt) VALUES ('".$green_rank."','".$total_cores."','".$accelerator_cores."','".$rmax."','".$rpeak."','".$nmax."','".$nhalf."','".$power."','".$mflops_per_watt."')";
if(mysqli_query($conn,$sql)){
}else{
  echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
}
//insert into geeky_details table
if(strlen($accelerator)==0){
  $sql="INSERT INTO geeky_details (green_rank,architecture,processor,processor_technology,processor_speed,operating_system,operating_system_family,cores_per_socket,processor_generation,system_model,system_family,interconnect,interconnect_family) VALUES ('".$green_rank."','".$architecture."','".$processor."','".$processor_technology."','".$processor_speed."','".$operating_system."','".$operating_system_family."','".$cores_per_socket."','".$processor_generation."','".$system_model."','".$system_family."','".$interconnect."','".$interconnect_family."')";
}else{
  $sql="INSERT INTO geeky_details (green_rank,architecture,processor,processor_technology,processor_speed,operating_system,operating_system_family,accelerator,cores_per_socket,processor_generation,system_model,system_family,interconnect,interconnect_family) VALUES ('".$green_rank."','".$architecture."','".$processor."','".$processor_technology."','".$processor_speed."','".$operating_system."','".$operating_system_family."','".$accelerator."','".$cores_per_socket."','".$processor_generation."','".$system_model."','".$system_family."','".$interconnect."','".$interconnect_family."')";
}
if(mysqli_query($conn,$sql)){
}else{
  echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
}
$c = $c + 1;
}
echo "You database has imported successfully. You have inserted ". $c ." records";
}
?>
</div>
</body>
</html>
