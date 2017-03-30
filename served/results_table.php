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
        <h4>Records Satisfying The Above Criteria!</h4>
      </div>
      <?php
      $year=$_GET["year"];
      $country=$_GET["country"];
      $manufacturer=$_GET["manufacturer"];
      $processor_generation=$_GET["processor_generation"];
      $architecture=$_GET["architecture"];
      $segment=$_GET["segment"];
      $interconnect_family=$_GET["interconnect_family"];
      $accelerator=$_GET["accelerator"];
      $operating_system_family=$_GET["operating_system_family"];
      $rank_from=$_GET["rank_from"];
      $rank_to=$_GET["rank_to"];
      $sql1="SELECT R.rank,D.site,L.country,D.computer,D.manufacturer,N.total_cores,N.power FROM details D,locations L,numbers N,ranks R";
      $sql2="WHERE R.green_rank=D.green_rank AND L.location_id=D.location_id AND D.green_rank=N.green_rank";
      if(strcmp($processor_generation,"All")!=0 || strcmp($architecture,"All")!=0 || strcmp($interconnect_family,"All")!=0 || strcmp($accelerator,"All")!=0 || strcmp($operating_system_family,"All")!=0){
        $sql1=$sql1.",geeky_details G";
        $sql2=$sql2." AND G.green_rank=N.green_rank";
      }
      if(strcmp($year,"All")!=0){
        $sql2=$sql2." AND D.year='".$year."'";
      }
      if(strcmp($country,"All")!=0){
        $sql2=$sql2." AND L.country='".$country."'";
      }
      if(strcmp($manufacturer,"All")!=0){
        $sql2=$sql2." AND D.manufacturer='".$manufacturer."'";
      }
      if(strcmp($processor_generation,"All")!=0){
        $sql2=$sql2." AND G.processor_generation='".$processor_generation."'";
      }
      if(strcmp($segment,"All")!=0){
        $sql2=$sql2." AND D.segment='".$segment."'";
      }
      if(strcmp($architecture,"All")!=0){
        $sql2=$sql2." AND G.architecture='".$architecture."'";
      }
      if(strcmp($interconnect_family,"All")!=0){
        $sql2=$sql2." AND G.interconnect_family='".$interconnect_family."'";
      }
      if(strcmp($accelerator,"All")!=0){
        if(strcmp($accelerator,"Null")==0){
          $sql2=$sql2." AND G.accelerator IS NULL";
        }else{
          $sql2=$sql2." AND G.accelerator='".$accelerator."'";
        }
      }
      if(strcmp($operating_system_family,"All")!=0){
        $sql2=$sql2." AND G.operating_system_family='".$operating_system_family."'";
      }
      $sql2=$sql2." AND R.rank>='".$rank_from."' AND R.rank<='".$rank_to."'";
      $sql=$sql1." ".$sql2." GROUP BY R.rank ASC";
      $result=mysqli_query($conn,$sql);
      $serial_no=0;
      if(mysqli_num_rows($result)>0){
        echo "<div class=\"table-responsive\">
        <table class=\"table table-bordered table-hover\">
        <thead>
        <tr>
        <th class=\"col-md-1\">#</th>
        <th class=\"col-md-1\">Rank</th>
        <th class=\"col-md-4\">Site</th>
        <th class=\"col-md-4\">System</th>
        <th class=\"col-md-1\">Cores</th>
        <th class=\"col-md-1\">Power (kW)</th>
        </tr>
        </thead>
        <tbody>";
        while($row=mysqli_fetch_assoc($result)){
          $serial_no=$serial_no+1;
          $rank=$row["rank"];
          $site=$row["site"];
          $country=$row["country"];
          $computer=$row["computer"];
          $manufacturer=$row["manufacturer"];
          $total_cores=$row["total_cores"];
          $power=$row["power"];
          echo "<tr>
          <td class=\"col-md-1 hover_block\"><div>$serial_no</div></td>
          <td class=\"col-md-1 hover_block hover_cursor\" onclick=\"javascript:return rank_wise($rank)\">$rank</td>
          <td class=\"col-md-4 hover_block hover_cursor\" onclick=\"javascript:return site_wise($rank)\">$site<p><b>$country</b></p></td>
          <td class=\"col-md-4 hover_block hover_cursor\" onclick=\"javascript:return computer_wise($rank)\">$computer<p><b>$manufacturer</b></p></td>
          <td class=\"col-md-1 hover_block\">$total_cores</td>
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
mysqli_close($conn);
?>
