<?php
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pass = $_POST['password'];
$cpass = $_POST['cpassword'];

if($name && $email && $phone && $pass && $cpass){
    if($pass==$cpass){
        mysql_connect("localhost","root","") or die("we couldn't connect");
        mysql_select_db("registration");
        $u=mysql_query("select name from user where name='$name'");
        // $count=mysql_num_rows($u);

        mysql_query("insert into user(name,email,pass,cpass,phone) values('$name','$email','$pass','$cpass','$phone')");
        echo "you have successfully registered";
    }else{
        echo "your password doesn't match";

    }
}else{
    echo "you have to complete the form!";
}
