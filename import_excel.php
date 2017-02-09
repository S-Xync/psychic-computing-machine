<?php
/* SaiKumar Immadi */
$server = “localhost”;
$username = “myuser”;
$password = “mypassword”;
$dbname = “pcm”;

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
<style type=”text/css”>
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
<div class=”top-bar”>
<div class=”inside-top-bar”>Import Excel Sheet into MYSQL<br><br>
</div>
</div>
<div style=”text-align:left; border:1px solid #333333; width:300px; margin:0 auto; padding:10px;”>

<form name=”import” method=”post” enctype=”multipart/form-data”>
<input type=”file” name=”file” /><br />
<input type=”submit” name=”submit” value=”Submit” />
</form>
<?php
if(isset($_POST[“submit”]))
{
$file = $_FILES[‘file’][‘tmp_name’];
$handle = fopen($file, “r”);
$c = 0;
while(($filesop = fgetcsv($handle, “,”)) !== false)
{
$green_rank = $filesop[0];
$rank = $filesop[1];
$previous_rank = $filesop[2];
$first_appearance= $filesop[3];
$first_rank = $filesop[4];
$machine_name = $filesop[5];
$computer_name = $filesop[6];
$site_name = $filesop[7];
$manufacturer_name = $filesop[8];
$country_name = $filesop[9];
$year = $filesop[10];
$segment_name = $filesop[11];
$total_cores = $filesop[12];
$accelerator_cores = $filesop[13];
$rmax = $filesop[14];
$rpeak = $filesop[15];
$nmax = $filesop[16];
$nhalf = $filesop[17];
$power = $filesop[18];
$power_source_name = $filesop[19];
$mflops_per_watt = $filesop[20];
$architecture_name = $filesop[21];
$processor_name = $filesop[22];
$processor_technology_name = $filesop[23];
$processor_speed = $filesop[24];
$operating_system_name = $filesop[25];
$operating_system_family_name = $filesop[26];
$accelerator_name = $filesop[27];
$cores_per_socket = $filesop[28];
$processor_generation_name = $filesop[29];
$system_model_name = $filesop[30];
$system_family_name = $filesop[31];
$interconnect_family_name = $filesop[32];
$interconnect_name = $filesop[33];
$region_name = $filesop[34];
$continent_name = $filesop[35];

$sql = "INSERT INTO machines (green_rank) VALUES ($green_rank)";
if(mysqli_query($conn,$sql)){

}else{
  echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
}
$sql="SELECT machine_id FROM machine WHERE green_rank=".'$green_rank'."";
$c = $c + 1;
}

if($sql){
echo “You database has imported successfully. You have inserted “. $c .” recoreds”;
}else{
echo “Sorry! There is some problem.”;
}

}
?>
</div>
</body>
</html>
