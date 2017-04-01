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
        <h4>About The Computer!</h4>
      </div>
      <?php
      $rank=$_GET["rank"];
      $sql="SELECT D.machine, D.computer, D.site, D.manufacturer, L.country, D.year, D.power_source, G.architecture, G.processor, G.processor_speed, G.operating_system, G.accelerator, G.system_model, G.interconnect, N.total_cores, N.accelerator_cores, N.rmax, N.rpeak, N.nmax, N.power, N.mflops_per_watt FROM details D, ranks R, locations L, geeky_details G, numbers N WHERE R.rank = '".$rank."' AND R.green_rank = D.green_rank AND D.location_id = L.location_id AND D.green_rank = G.green_rank AND G.green_rank = N.green_rank";
      $result=mysqli_query($conn,$sql);
      if (mysqli_num_rows($result)==1) {
        $row=mysqli_fetch_assoc($result);
        $machine=$row["machine"];
        $computer=$row["computer"];
        $site=$row["site"];
        $manufacturer=$row["manufacturer"];
        $country=$row["country"];
        $year=$row["year"];
        $power_source=$row["power_source"];
        $architecture=$row["architecture"];
        $processor=$row["processor"];
        $processor_speed=$row["processor_speed"];
        $operating_system=$row["operating_system"];
        $accelerator=$row["accelerator"];
        $system_model=$row["system_model"];
        $interconnect=$row["interconnect"];
        $total_cores=$row["total_cores"];
        $accelerator_cores=$row["accelerator_cores"];
        $rmax=$row["rmax"];
        $rpeak=$row["rpeak"];
        $nmax=$row["nmax"];
        $power=$row["power"];
        $mflops_per_watt=$row["mflops_per_watt"];

        echo "<h2 align=\"center\" class=\"hover_cursor\" onclick=\"javascript:return computer_wise($rank)\">$computer</h2>";

        echo "<div class=\"container table-responsive\">
        <table class=\"table table-hover table-condensed\">
        <tbody>";

        echo "<tr>
        <th class=\"col-md-5\">Rank</th><td class=\"col-md-7\">$rank</td>
        </tr>";

        if($machine===null){
          echo "<tr>
          <th class=\"col-md-5\">Name</th><td class=\"col-md-7\">Not Available</td>
          </tr>";
        }else{
          echo "<tr>
          <th class=\"col-md-5\">Name</th><td class=\"col-md-7\">$machine</td>
          </tr>";
        }

        echo "<tr class=\"hover_cursor\" onclick=\"javascript:return site_wise($rank)\">
        <th class=\"col-md-5\">Site</th><td class=\"col-md-7\">$site</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Country</th><td class=\"col-md-7\">$country</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Vendor</th><td class=\"col-md-7\">$manufacturer</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Year</th><td class=\"col-md-7\">$year</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Processor (Architecture)</th><td class=\"col-md-7\">$processor ($architecture)</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Total No. of Cores</th><td class=\"col-md-7\">$total_cores</td>
        </tr>";

        if($accelerator===null){
          echo "<tr>
          <th class=\"col-md-5\">Accelerator / Co-Processor</th><td class=\"col-md-7\">Not Available</td>
          </tr>";
        }else{
          echo "<tr>
          <th class=\"col-md-5\">Accelerator / Co-Processor</th><td class=\"col-md-7\">$accelerator</td>
          </tr>";
        }

        echo "<tr>
        <th class=\"col-md-5\">No. of Accelerator / Co-Processor Cores</th><td class=\"col-md-7\">$accelerator_cores</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Operating System</th><td class=\"col-md-7\">$operating_system</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">System Model</th><td class=\"col-md-7\">$system_model</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Interconnect</th><td class=\"col-md-7\">$interconnect</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Processor Speed</th><td class=\"col-md-7\">$processor_speed Ghz</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Power (Power Source)</th><td class=\"col-md-7\">$power kW ($power_source)</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Performance per Watt</th><td class=\"col-md-7\">$mflops_per_watt MFLOPS/watt</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Linpack Performance (Rmax)</th><td class=\"col-md-7\">$rmax TFLOPS</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Theoretical Peak (Rpeak)</th><td class=\"col-md-7\">$rpeak TFLOPS</td>
        </tr>";

        echo "<tr>
        <th class=\"col-md-5\">Nmax</th><td class=\"col-md-7\">$nmax</td>
        </tr>";

        echo "</tbody>
        </table>
        </div>";
      }else{
        echo "<h4 align=\"center\">Error Retrieving Data!</h4>";
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
