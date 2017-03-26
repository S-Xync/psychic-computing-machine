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
  <title>Psychic Computing Machine</title>
  <link rel="stylesheet" href="css/bootstrap-cosmo.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script type="text/javascript" src="js/jquery-3.2.0.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/functions.js"></script>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">Psychic Computing Machine</a>
      </div>
    </div>
  </nav>
  <div class="below-navbar-fixed-top" >
    <div class="jumbotron">
      <div class="container">
        <h1>Hello World!</h1>
        <p>Brace yourself for the amazing ride through the world of <b>Super Computers!</b></p>
      </div>
    </div>
    <div class="container">
      <form name="user_form" id="user_form" method="post">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="year">Year</label>
            <select class="form-control" name="year" id="year">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT year FROM details ORDER BY year DESC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $year=$row["year"];
                  echo "<option value=\"$year\">$year</option>";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="country">Country</label>
            <select class="form-control" name="country" id="country">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT country FROM locations ORDER BY country ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $country=$row["country"];
                  echo "<option value=\"$country\">$country</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-5">
            <label for="manufacturer">Vendor</label>
            <select class="form-control" name="manufacturer" id="manufacturer">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT manufacturer FROM details ORDER BY manufacturer ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $manufacturer=$row["manufacturer"];
                  echo "<option value=\"$manufacturer\">$manufacturer</option>";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="processor_generation">Processor Generation</label>
            <select class="form-control" name="processor_generation" id="processor_generation">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT processor_generation FROM geeky_details ORDER BY processor_generation ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $processor_generation=$row["processor_generation"];
                  echo "<option value=\"$processor_generation\">$processor_generation</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-5">
            <label for="architecture">Architecture</label>
            <select class="form-control" name="architecture" id="architecture">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT architecture FROM geeky_details ORDER BY architecture ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $architecture=$row["architecture"];
                  echo "<option value=\"$architecture\">$architecture</option>";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="segment">Segment</label>
            <select class="form-control" name="segment" id="segment">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT segment FROM details ORDER BY segment ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $segment=$row["segment"];
                  echo "<option value=\"$segment\">$segment</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-5">
            <label for="interconnect_family">Interconnect Family</label>
            <select class="form-control" name="interconnect_family" id="interconnect_family">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT interconnect_family FROM geeky_details ORDER BY interconnect_family ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $interconnect_family=$row["interconnect_family"];
                  echo "<option value=\"$interconnect_family\">$interconnect_family</option>";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="accelerator">Accelerator/Co-Processor Family</label>
            <select class="form-control" name="accelerator" id="accelerator">
              <option value="All" selected="selected">All</option>
              <option value="NULL">N/A</option>
              <?php
              $sql="SELECT DISTINCT accelerator FROM geeky_details WHERE accelerator IS NOT NULL ORDER BY accelerator ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $accelerator=$row["accelerator"];
                  echo "<option value=\"$accelerator\">$accelerator</option>";
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group col-md-5">
            <label for="operating_system_family">Operating System Family</label>
            <select class="form-control" name="operating_system_family" id="operating_system_family">
              <option value="All" selected="selected">All</option>
              <?php
              $sql="SELECT DISTINCT operating_system_family FROM geeky_details ORDER BY operating_system_family ASC";
              $result=mysqli_query($conn,$sql);
              if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  $operating_system_family=$row["operating_system_family"];
                  echo "<option value=\"$operating_system_family\">$operating_system_family</option>";
                }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-5">
            <label for="rank_from">Rank From</label>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></span>
              <?php
              $sql="SELECT MIN(rank) FROM ranks";
              $result=mysqli_query($conn,$sql);
              $row=mysqli_fetch_assoc($result);
              $min_rank=$row["MIN(rank)"];
              echo "<input type=\"text\" class=\"form-control\" placeholder=\"Rank\" name=\"rank_from\" value=\"$min_rank\" id=\"rank_from\" aria-describedby=\"basic-addon1\">";
              ?>
            </div>
          </div>
          <div class="form-group col-md-5">
            <label for="rank_to">Rank To</label>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></span>
              <?php
              $sql="SELECT MAX(rank) FROM ranks";
              $result=mysqli_query($conn,$sql);
              $row=mysqli_fetch_assoc($result);
              $max_rank=$row["MAX(rank)"];
              echo "<input type=\"text\" class=\"form-control\" placeholder=\"Rank\" name=\"rank_to\" value=\"$max_rank\" id=\"rank_to\" aria-describedby=\"basic-addon1\">";
              ?>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="form-group col-md-2" align="center">
            <input type="submit" name="submit" value="Submit" id="submit_btn" class="btn btn-default btn-lg">
          </div>
          <div class="col-md-6"></div>
        </div>
      </form>
    </div>
    <?php
    if(isset($_POST["submit"])){
      $year=$_POST["year"];
      $country=$_POST["country"];
      $manufacturer=$_POST["manufacturer"];
      $processor_generation=$_POST["processor_generation"];
      $architecture=$_POST["architecture"];
      $segment=$_POST["segment"];
      $interconnect_family=$_POST["interconnect_family"];
      $accelerator=$_POST["accelerator"];
      $operating_system_family=$_POST["operating_system_family"];
      $rank_from=$_POST["rank_from"];
      $rank_to=$_POST["rank_to"];
      ?>
      <div class="container">
        <div class="row">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Results!</h4>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th class="col-md-4">dshf</th>
                    <th class="col-md-4">kjgkdsfd</th>
                    <th class="col-md-4">sdifuh</th>
                  </tr>
                </thead>
                <tbody>
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
      </div>
      <?php
    }
    ?>
  </div>
</body>
</html>
