<?php
/* SaiKumar Immadi */
// Start the session
session_start();
$server = 'localhost';
$username = 'myuser';
$password = 'mypassword';
$dbname = 'pcm';
// creates connection
$conn=mysqli_connect($server,$username,$password);

// checks connection
if(!$conn){
  die("\nConnection Failed : ".mysqli_connect_error()."\r\n\n");
  echo "<br>";
}
echo "\nConnected Successfully using username : ".$username."\r\n";
echo "<br>";

// connects to the database
$sql="USE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Connected to database : ".$dbname." with user : ".$username."\r\n";
  echo "<br>";
}else{
  echo "Error connecting to database : ".$dbname." with user : ".$username." ".mysqli_error($conn)."\r\n\n";
  echo "<br>";
}
if(strcmp($_SESSION["user"],"admin")==0){
  echo "Admin Logged In\r\n";
}else{
  echo "Admin Not Logged In\r\n";
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
    <?php
    if(strcmp($_SESSION["user"],"admin")==0){
      ?>
      <div class="inside-top-bar">
        <form name="logout" method="post" enctype="multipart/form-data">
          <input type="submit" name="logout" value="Logout" />
        </form>
      </div>
      <?php
    }else{
      ?>
      <div class="inside-top-bar">
        <form name="login" method="post" enctype="multipart/form-data">
          <input type="submit" name="login" value="Login" />
        </form>
      </div>
      <?php
    }
    if(isset($_POST["logout"])){
      unset($_SESSION["user"]);
      header('Location: userauth.php');
      exit;
    }
    if(isset($_POST["login"])){
      header('Location: userauth.php');
      exit;
    }
    ?>
    <div class="inside-top-bar"><b>Data Entry into Database</b><br></div>
  </div>
  <div style="text-align:left; border:1px solid #333333; width:450px; margin:2px auto; padding:10px;">
    <h4>Bulk Loading</h4>
    <form name="import_csv" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td align="right">CSV File :</td>
          <td align="left"><input type="file" name="file" required/></td>
        </tr>
        <tr>
          <td align="right"></td>
          <td align="left"><input type="submit" name="submitb" value="Submit" /></td>
        </tr>
      </table>
      <!-- CSV File: <input type="file" name="file" required/><br /> -->
      <!-- <input type="submit" name="submitb" value="Submit" /> -->
    </form>
    <?php
    // function for inserting each row of data into database
    function row_entry( $conn, $dbname, $rank, $previous_rank, $first_appearance, $first_rank, $machine, $computer, $site, $manufacturer, $country, $year, $segment, $total_cores, $accelerator_cores, $rmax, $rpeak, $nmax, $nhalf, $power, $power_source, $mflops_per_watt, $architecture, $processor, $processor_technology, $processor_speed, $operating_system, $operating_system_family, $accelerator, $cores_per_socket, $processor_generation, $system_model, $system_family, $interconnect_family, $interconnect, $region, $continent) {
      // insert into ranks table
      if(strlen($previous_rank)==0){
        $sql = "INSERT INTO ranks (rank,first_appearance,first_rank) VALUES ('".$rank."','".$first_appearance."','".$first_rank."')";
      }else{
        $sql = "INSERT INTO ranks (rank,previous_rank,first_appearance,first_rank) VALUES ('".$rank."','".$previous_rank."','".$first_appearance."','".$first_rank."')";
      }
      if(mysqli_query($conn,$sql)){
      }else{
        echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
      }
      // retrieve green_rank from ranks table
      $sql="SELECT green_rank FROM ranks WHERE rank='".$rank."'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        $green_rank=$row["green_rank"];
      }else{
        echo "Error inserting rows into database ".$dbname."\r\n\n";
      }
      mysqli_free_result($result);
      // insert into locations table
      $sql="SELECT * FROM locations WHERE country='".$country."'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==0){//checking if same country is there in the table
        $sql="INSERT INTO locations (country,region,continent) VALUES ('".$country."','".$region."','".$continent."')";
        mysqli_query($conn,$sql);
      }
      mysqli_free_result($result);
      // retrieve location_id from locations table
      $sql="SELECT location_id FROM locations WHERE country='".$country."'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==1){
        $row = mysqli_fetch_assoc($result);
        $location_id=$row["location_id"];
      }else{
        echo "Error inserting rows into database ".$dbname."\r\n\n";
      }
      mysqli_free_result($result);
      // insert into details table
      if(strlen($machine)==0){
        $sql="INSERT INTO details (green_rank,computer,site,manufacturer,location_id,year,segment,power_source) VALUES ('".$green_rank."','".$computer."','".$site."','".$manufacturer."','".$location_id."','".$year."','".$segment."','".$power_source."')";
      }else{
        $sql="INSERT INTO details (green_rank,machine,computer,site,manufacturer,location_id,year,segment,power_source) VALUES ('".$green_rank."','".$machine."','".$computer."','".$site."','".$manufacturer."','".$location_id."','".$year."','".$segment."','".$power_source."')";
      }
      if(mysqli_query($conn,$sql)){
      }else{
        echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
      }
      // insert into numbers table
      $sql="INSERT INTO numbers (green_rank,total_cores,accelerator_cores,rmax,rpeak,nmax,nhalf,power,mflops_per_watt) VALUES ('".$green_rank."','".$total_cores."','".$accelerator_cores."','".$rmax."','".$rpeak."','".$nmax."','".$nhalf."','".$power."','".$mflops_per_watt."')";
      if(mysqli_query($conn,$sql)){
      }else{
        echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
      }
      // insert into geeky_details table
      if(strlen($accelerator)==0){
        $sql="INSERT INTO geeky_details (green_rank,architecture,processor,processor_technology,processor_speed,operating_system,operating_system_family,cores_per_socket,processor_generation,system_model,system_family,interconnect,interconnect_family) VALUES ('".$green_rank."','".$architecture."','".$processor."','".$processor_technology."','".$processor_speed."','".$operating_system."','".$operating_system_family."','".$cores_per_socket."','".$processor_generation."','".$system_model."','".$system_family."','".$interconnect."','".$interconnect_family."')";
      }else{
        $sql="INSERT INTO geeky_details (green_rank,architecture,processor,processor_technology,processor_speed,operating_system,operating_system_family,accelerator,cores_per_socket,processor_generation,system_model,system_family,interconnect,interconnect_family) VALUES ('".$green_rank."','".$architecture."','".$processor."','".$processor_technology."','".$processor_speed."','".$operating_system."','".$operating_system_family."','".$accelerator."','".$cores_per_socket."','".$processor_generation."','".$system_model."','".$system_family."','".$interconnect."','".$interconnect_family."')";
      }
      if(mysqli_query($conn,$sql)){
      }else{
        echo "Error inserting rows into database ".$dbname." ".mysqli_error($conn)."\r\n\n";
      }
    }

    if(isset($_POST["submitb"])){//request for bulk loading
      if(strcmp($_SESSION["user"],"admin")==0){
        $file = $_FILES['file']['tmp_name'];//uploaded file is temporarily stored
        $handle = fopen($file, "r");
        $c = 0;
        while(($filesop = fgetcsv($handle, ",")) !== false){
          // breaking down each row from csv file
          // $green_rank = $filesop[0] is autogenerated
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
          // calling the function for entering each row into database
          row_entry( $conn, $dbname, $rank, $previous_rank, $first_appearance, $first_rank, $machine, $computer, $site, $manufacturer, $country, $year, $segment, $total_cores, $accelerator_cores, $rmax, $rpeak, $nmax, $nhalf, $power, $power_source, $mflops_per_watt, $architecture, $processor, $processor_technology, $processor_speed, $operating_system, $operating_system_family, $accelerator, $cores_per_socket, $processor_generation, $system_model, $system_family, $interconnect_family, $interconnect, $region, $continent);
          $c = $c + 1;
        }
        echo "You database has been imported successfully. You have inserted ". $c ." records\r\n";
      }else{
        echo "Admin Not Logged In\r\n";
      }
    }
    ?>
  </div>
  <div style="text-align:left; border:1px solid #333333; width:450px; margin:2px auto; padding:10px;">
    <h4>Row Entry</h4>
    <form name="row_entry" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td align="right">Rank :</td>
          <td align="left"><input type="text" name="rank" required/></td>
        </tr>
        <tr>
          <td align="right">Previous Rank :</td>
          <td align="left"><input type="text" name="previous_rank"/></td>
        </tr>
        <tr>
          <td align="right">First Appearance :</td>
          <td align="left"><input type="text" name="first_appearance" required/></td>
        </tr>
        <tr>
          <td align="right">First Rank :</td>
          <td align="left"><input type="text" name="first_rank" required/></td>
        </tr>
        <tr>
          <td align="right">Machine :</td>
          <td align="left"><input type="text" name="machine"/></td>
        </tr>
        <tr>
          <td align="right">Computer :</td>
          <td align="left"><input type="text" name="computer" required/></td>
        </tr>
        <tr>
          <td align="right">Site :</td>
          <td align="left"><input type="text" name="site" required/><br/></td>
        </tr>
        <tr>
          <td align="right">Manufacturer :</td>
          <td align="left"><input type="text" name="manufacturer" required/></td>
        </tr>
        <tr>
          <td align="right">Country :</td>
          <td align="left"><input type="text" name="country" required/></td>
        </tr>
        <tr>
          <td align="right">Year :</td>
          <td align="left"><input type="text" name="year" required/></td>
        </tr>
        <tr>
          <td align="right">Segment :</td>
          <td align="left"><input type="text" name="segment" required/></td>
        </tr>
        <tr>
          <td align="right">Total Cores :</td>
          <td align="left"><input type="text" name="total_cores" required/></td>
        </tr>
        <tr>
          <td align="right">Accelerator / Co-Processor Cores :</td>
          <td align="left"><input type="text" name="accelerator_cores" required/></td>
        </tr>
        <tr>
          <td align="right">Rmax :</td>
          <td align="left"><input type="text" name="rmax" required/></td>
        </tr>
        <tr>
          <td align="right">Rpeak :</td>
          <td align="left"><input type="text" name="rpeak" required/></td>
        </tr>
        <tr>
          <td align="right">Nmax :</td>
          <td align="left"><input type="text" name="nmax" required/></td>
        </tr>
        <tr>
          <td align="right">Nhalf :</td>
          <td align="left"><input type="text" name="nhalf" required/></td>
        </tr>
        <tr>
          <td align="right">Power :</td>
          <td align="left"><input type="text" name="power" required/></td>
        </tr>
        <tr>
          <td align="right">Power Source :</td>
          <td align="left"><input type="text" name="power_source" required/></td>
        </tr>
        <tr>
          <td align="right">Mflops/Watt :</td>
          <td align="left"><input type="text" name="mflops_per_watt" required/></td>
        </tr>
        <tr>
          <td align="right">Architecture :</td>
          <td align="left"><input type="text" name="architecture" required/></td>
        </tr>
        <tr>
          <td align="right">Processor :</td>
          <td align="left"><input type="text" name="processor" required/></td>
        </tr>
        <tr>
          <td align="right">Processor Technology :</td>
          <td align="left"><input type="text" name="processor_technology" required/></td>
        </tr>
        <tr>
          <td align="right">Processor Speed :</td>
          <td align="left"><input type="text" name="processor_speed" required/></td>
        </tr>
        <tr>
          <td align="right">Operating System :</td>
          <td align="left"><input type="text" name="operating_system" required/></td>
        </tr>
        <tr>
          <td align="right">Operating System Family :</td>
          <td align="left"><input type="text" name="operating_system_family" required/></td>
        </tr>
        <tr>
          <td align="right">Accelerator / Co-Processor :</td>
          <td align="left"><input type="text" name="accelerator"/></td>
        </tr>
        <tr>
          <td align="right">Cores per Socket :</td>
          <td align="left"><input type="text" name="cores_per_socket" required/></td>
        </tr>
        <tr>
          <td align="right">Processor Generation :</td>
          <td align="left"><input type="text" name="processor_generation" required/></td>
        </tr>
        <tr>
          <td align="right">System Model :</td>
          <td align="left"><input type="text" name="system_model" required/></td>
        </tr>
        <tr>
          <td align="right">System Family :</td>
          <td align="left"><input type="text" name="system_family" required/></td>
        </tr>
        <tr>
          <td align="right">Interconnect :</td>
          <td align="left"><input type="text" name="interconnect" required/></td>
        </tr>
        <tr>
          <td align="right">Interconnect Family :</td>
          <td align="left"><input type="text" name="interconnect_family" required/></td>
        </tr>
        <tr>
          <td align="right">Region :</td>
          <td align="left"><input type="text" name="region" required/><br/></td>
        </tr>
        <tr>
          <td align="right">Continent :</td>
          <td align="left"><input type="text" name="continent" required/></td>
        </tr>
        <tr>
          <td align="right"></td>
          <td align="left"><input type="submit" name="submitr" value="Submit" /></td>
        </tr>

      </table>
    </form>
    <?php
    if(isset($_POST["submitr"])){//request for row wise loading
      if(strcmp($_SESSION["user"],"admin")==0){
        $rank = $_POST["rank"];
        $previous_rank = $_POST["previous_rank"];
        $first_appearance= $_POST["first_appearance"];
        $first_rank = $_POST["first_rank"];
        $machine = $_POST["machine"];
        $computer = $_POST["computer"];
        $site = $_POST["site"];
        $manufacturer = $_POST["manufacturer"];
        $country = $_POST["country"];
        $year = $_POST["year"];
        $segment = $_POST["segment"];
        $total_cores = $_POST["total_cores"];
        $accelerator_cores = $_POST["accelerator_cores"];
        $rmax = $_POST["rmax"];
        $rpeak = $_POST["rpeak"];
        $nmax = $_POST["nmax"];
        $nhalf = $_POST["nhalf"];
        $power = $_POST["power"];
        $power_source = $_POST["power_source"];
        $mflops_per_watt = $_POST["mflops_per_watt"];
        $architecture = $_POST["architecture"];
        $processor = $_POST["processor"];
        $processor_technology = $_POST["processor_technology"];
        $processor_speed = $_POST["processor_speed"];
        $operating_system = $_POST["operating_system"];
        $operating_system_family = $_POST["operating_system_family"];
        $accelerator = $_POST["accelerator"];
        $cores_per_socket = $_POST["cores_per_socket"];
        $processor_generation = $_POST["processor_generation"];
        $system_model = $_POST["system_model"];
        $system_family = $_POST["system_family"];
        $interconnect_family = $_POST["interconnect_family"];
        $interconnect = $_POST["interconnect"];
        $region = $_POST["region"];
        $continent = $_POST["continent"];
        row_entry( $conn, $dbname, $rank, $previous_rank, $first_appearance, $first_rank, $machine, $computer, $site, $manufacturer, $country, $year, $segment, $total_cores, $accelerator_cores, $rmax, $rpeak, $nmax, $nhalf, $power, $power_source, $mflops_per_watt, $architecture, $processor, $processor_technology, $processor_speed, $operating_system, $operating_system_family, $accelerator, $cores_per_socket, $processor_generation, $system_model, $system_family, $interconnect_family, $interconnect, $region, $continent);
        echo "Record inserted successfully\r\n";
      }else{
        echo "Admin Not Logged In\r\n";
      }
    }
    ?>
  </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
