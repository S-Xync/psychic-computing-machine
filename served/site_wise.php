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
        <h4>Computers From The Same Site!</h4>
      </div>
      <?php
      $rank=$_GET["rank"];
      $sql="SELECT D.site,L.country FROM details D,ranks R,locations L WHERE R.green_rank=D.green_rank D.location_id=L.location_id AND R.rank='".$rank."'";
      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==1){
        $row=mysqli_fetch_assoc($result);
        $site=$row["site"];
        $country=$row["country"];
      }
      // $sql="SELECT R.rank,D.year,D.manufacturer,D.computer,N.total_cores,N.power,N.rmax,N.rpeak FROM ranks R, details D,numbers N,locations L WHERE L.country"
      ?>
    </div>
  </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
