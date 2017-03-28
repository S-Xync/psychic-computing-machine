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
<body onload="javascript:return submit_btn_submit( document.getElementById('user_form').year.value, document.getElementById('user_form').country.value, document.getElementById('user_form').manufacturer.value, document.getElementById('user_form').processor_generation.value, document.getElementById('user_form').architecture.value, document.getElementById('user_form').segment.value, document.getElementById('user_form').interconnect_family.value, document.getElementById('user_form').accelerator.value, document.getElementById('user_form').operating_system_family.value, document.getElementById('user_form').rank_from.value, document.getElementById('user_form').rank_to.value )">
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
              <option value="Null">N/A</option>
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
            <input type="submit" name="submit" value="Submit" id="submit_btn" class="btn btn-default btn-lg" onclick="javascript:return submit_btn_submit( document.getElementById('user_form').year.value, document.getElementById('user_form').country.value, document.getElementById('user_form').manufacturer.value, document.getElementById('user_form').processor_generation.value, document.getElementById('user_form').architecture.value, document.getElementById('user_form').segment.value, document.getElementById('user_form').interconnect_family.value, document.getElementById('user_form').accelerator.value, document.getElementById('user_form').operating_system_family.value, document.getElementById('user_form').rank_from.value, document.getElementById('user_form').rank_to.value )">
          </div>
          <div class="col-md-6"></div>
        </div>
      </form>
    </div>
    <div id="result_table" class="container"><h2>Results table will be displayed here...</h2></div>
  </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
