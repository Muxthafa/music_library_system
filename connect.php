<?php
$serv="localhost";
$username="root";
$pass="";
$db="music";

$conn=new mysqli($serv,$username,$pass,$db);
if($conn->connect_error){
	die("connection failed:".$conn->connect_error);
}
$sql="select * from track";
$res=$conn->query($sql);

if($res->num_row > 0){
	while ($row=$res->fetch_assoc()){
		echo"id:".$row["track_id"]."name".$row["track_name"];
	}
}
else{
echo "0 results";
}
$conn->close();
?>
