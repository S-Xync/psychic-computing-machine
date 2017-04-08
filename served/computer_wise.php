<?php
/* SaiKumar Immadi */
$server = "localhost";
$username = "myuser";
$password = "mypassword";
$dbname = "pcm";
// creates connection
$conn=mysqli_connect($server,$username,$password);
$sql="USE ".$dbname;
mysqli_query($conn,$sql);
?>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/bootstrap-cosmo.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4>Computers With Same System!</h4>
      </div>
      <?php
      $rank=$_GET["rank"];
      $sql="SELECT D.computer,D.manufacturer FROM details D,ranks R WHERE R.green_rank=D.green_rank AND R.rank='".$rank."'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);
        $computer=$row["computer"];
        $manufacturer=$row["manufacturer"];
        echo "<div class=\"container\">
        <h2><b>System : </b> $computer</h2>
        <h3><b>Vendor : </b> $manufacturer</h3>
        </div>";
      }
      $sql="SELECT D.year, R.rank, D.site, L.country, N.total_cores, N.rmax, N.rpeak, N.power FROM ranks R, details D, numbers N, locations L WHERE D.manufacturer = '".$manufacturer."' AND D.computer = '".$computer."' AND R.green_rank = D.green_rank AND D.green_rank = N.green_rank AND D.location_id = L.location_id ORDER BY D.year ASC";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0){
        echo "<div class=\"table-responsive\">
        <table class=\"table table-bordered table-hover\">
        <thead>
        <tr>
        <th class=\"col-md-1\">Year</th>
        <th class=\"col-md-1\">Rank</th>
        <th class=\"col-md-4\">Site</th>
        <th class=\"col-md-2\">Country</th>
        <th class=\"col-md-1\">Cores</th>
        <th class=\"col-md-1\">Rmax (TFLOPS)</th>
        <th class=\"col-md-1\">RPeak (TFLOPS)</th>
        <th class=\"col-md-1\">Power (kW)</th>
        </tr>
        </thead>
        <tbody>";
        while($row=mysqli_fetch_assoc($result)){
          $year=$row["year"];
          $rank=$row["rank"];
          $site=$row["site"];
          $country=$row["country"];
          $total_cores=$row["total_cores"];
          $rmax=$row["rmax"];
          $rpeak=$row["rpeak"];
          $power=$row["power"];
          echo "<tr>
          <td class=\"col-md-1 hover_block\">$year</td>
          <td class=\"col-md-1 hover_block hover_cursor\" onclick=\"javascript:return rank_wise($rank)\">$rank</td>
          <td class=\"col-md-4 hover_block hover_cursor\" onclick=\"javascript:return site_wise($rank)\">$site</td>
          <td class=\"col-md-2 hover_block\">$country</td>
          <td class=\"col-md-1 hover_block\">$total_cores</td>
          <td class=\"col-md-1 hover_block\">$rmax</td>
          <td class=\"col-md-1 hover_block\">$rpeak</td>
          <td class=\"col-md-1 hover_block\">$power</td>
          </tr>";
        }
        echo "</tbody>
        </table>
        </div>";
      }else{
        echo "<h4 align=\"center\">0 Records Retrieved</h4>";
      }
      ?>
    </div>
  </div>
  <?php
  echo "<h3>Sql Command :</h3><h4>$sql ;</h4>";
  ?>
</body>
</html>
<?php
mysqli_free_result($result);
mysqli_close($conn);
?>
