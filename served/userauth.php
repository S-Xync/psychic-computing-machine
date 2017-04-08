<?php
/* SaiKumar Immadi */
// Start the session
session_start();
$server = "localhost";
$username = "myuser";
$password = "mypassword";
$dbname = "pcm";

// creates connection
$conn=mysqli_connect($server,$username,$password);

// checks connection
if(!$conn){
  die("\nConnection Failed : ".mysqli_connect_error()."\r\n\n");
  echo "<br>";
}
echo "\nConnected Successfully using username : ".$username."\r\n";
echo "<br>";

// connects to the database created above
$sql="USE ".$dbname;
if(mysqli_query($conn,$sql)){
  echo "Connected to database : ".$dbname." with user : ".$username."\r\n";
  echo "<br>";
}else{
  echo "Error connecting to database : ".$dbname." with user : ".$username." ".mysqli_error($conn)."\r\n\n";
  echo "<br>";
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
    <div class="inside-top-bar"><b>Admin Login Page</b><br><br>
    </div>
  </div>
  <div style="text-align:left; border:1px solid #333333; width:450px; margin:2px auto; padding:10px;">
    <h4>Admin Login</h4>
    <form name="login" method="post" enctype="multipart/form-data">
      <table>
        <tr>
          <td align="right">Username :</td>
          <td align="left"><input type="text" name="user" required/></td>
        </tr>
        <tr>
          <td align="right">Password :</td>
          <td align="left"><input type="password" name="pass" required/></td>
        </tr>
        <tr>
          <td align="right"></td>
          <td align="left"><input type="submit" name="login" value="Login" /></td>
        </tr>
      </table>
    </form>
    <?php
    if(isset($_POST["login"])){//when login button is clicked
      $username=$_POST["user"];
      $password=$_POST["pass"];
      $sql="SELECT hash_password from users WHERE username=?";
      $stmt=mysqli_stmt_init($conn);
      if(mysqli_stmt_prepare($stmt,$sql)){
        mysqli_stmt_bind_param($stmt,"s",$username);
        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)==1){
          $row = mysqli_fetch_array($result,MYSQLI_BOTH);//numbers and also variables
          $hash_password=$row["hash_password"];
          if(password_verify($password,$hash_password)){
            $_SESSION["user"]="admin";
            header('Location: data_entry.php');
            exit;
          }else{
            echo "User Authentication Failed\n";
          }
        }else{
          echo "Username Error\r\n";
        }
        mysqli_free_result($result);
      }
    }
    ?>
  </body>
  </html>
  <?php
  mysqli_close($conn);
  ?>
