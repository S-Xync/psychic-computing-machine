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
        <h4>Results!</h4>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead>
            <tr>
              <th class="col-md-1">#</th>
              <th class="col-md-1">Rank</th>
              <th class="col-md-3">Site</th>
              <th class="col-md-4">System</th>
              <th class="col-md-2">Cores</th>
              <th class="col-md-1">Power (kW)</th>
            </tr>
          </thead>
          <tbody>
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
            echo $sql;
            ?>

            <tr>
              <td class="col-md-4">dskghfj</td>
              <td class="col-md-4">dskughlkndsg</td>
              <td class="col-md-4">ksduhgkjgdh</td>
            </tr>
            <tr>
              <td class="col-md-4">sdhgldsg</td>
              <td class="col-md-4">kdsfuyglusdfh</td>
              <td class="col-md-4">dksuffushiudf</td>
            </tr>
            <tr>
              <td class="col-md-4">kdshgflujghsdu</td>
              <td class="col-md-4">dkjfhgj</td>
              <td class="col-md-4">jhgsdhskdg</td>
            </tr>
            <tr>
              <td class="col-md-4">kdshgflujghsdu</td>
              <td class="col-md-4">dkjfhgj</td>
              <td class="col-md-4">jhgsdhskdg</td>
            </tr>
            <tr>
              <td class="col-md-4">kdshgflujghsdu</td>
              <td class="col-md-4">dkjfhgj</td>
              <td class="col-md-4">jhgsdhskdg</td>
            </tr>
            <tr>
              <td class="col-md-4">kdshgflujghsdu</td>
              <td class="col-md-4">dkjfhgj</td>
              <td class="col-md-4">jhgsdhskdg</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
