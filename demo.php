<?php
if (isset($_POST['submit'])){
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pass = $_POST['password'];
$cpass =$_POST['cpassword'];

if(!empty($name) || !empty($phone) || !empty($email) || !empty($pass) || !empty($cpass)){
    if($pass!=$cpass){
        echo "password doesn't match";
        die();
    }else{
$host="localhost";
$user="root";
$pass="";
$db="music";
$con = new mysqli($host,$user,$pass,$db);
if(mysqli_connect_error()){
    die('connect error('.mysqli_connect_errorno().')'.mysqli_connect_error());
}else{
    $SELECT = "SELECT email from demo where email= ? limit 1";
    $insert= "INSERT into demo (name,number,email,password,cpassword) values(?,?,?,?,?)";
    $stmnt=$con->prepare($SELECT);
   $stmnt->bind_param("s",$email);
    $stmnt->execute();
    $stmnt->bind_result($email);
    $stmnt->store_result();
    $rnum=$stmnt->num_rows;
    if($rnum==0)
    {
        mysqli_query($con, $insert);
        $stmnt->close();
        $stmnt=$con->prepare($insert);
      $stmnt->bind_param("sisss",$name,$phone,$email,$pass,$cpass);
        $stmnt->execute();
        echo "new record is inserted ";
    $_SESSION['name'] = $name;
    $_SESSION['success'] = "You are now logged in";
   header('location: index.php');
    }else{
        echo "someone already registered";
    }
    $stmnt->close();
    $con->close();
}
}   
}else{
    echo "all fields required";
    die();
}
}


$host="localhost";
$user="root";
$pass="";
$db="music";
$con = new mysqli($host,$user,$pass,$db);

if(mysqli_connect_error()){
    die('connect error('.mysqli_connect_errorno().')'.mysqli_connect_error());
}
$errors = array();

if (isset($_POST['Login'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = mysqli_real_escape_string($con, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
if (empty($password)) {
    array_push($errors, "Password is required");
  }

     if (count($errors) == 0){
    $password = md5($password);
    $query = "SELECT * FROM demo WHERE name='$username' AND cpassword='$password'";
    $results = mysqli_query($con, $query);
    if (mysqli_num_rows($results) == 1) {
         $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now logged in";
     echo "you are logged in ";
      header('location: index.php');

    }

    else {
        array_push($errors, "Wrong username/password combination");
    }
  }
}

?>
