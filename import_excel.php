<?php
$hostname = “localhost”;
$username = “myuser”;
$password = “mypassword”;
$database = “pcm”;

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
while(($filesop = fgetcsv($handle, 1000, “,”)) !== false)
{
$name = $filesop[0];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];
$project = $filesop[1];

$sql = mysql_query(“INSERT INTO mytask (name, project) VALUES (‘$name’,’$project’)”);
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