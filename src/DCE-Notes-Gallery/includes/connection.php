<?php
$conn = mysqli_connect("localhost:8080","test","test","test" ) or die ("error".mysqli_error($conn));
$query = mysqli_query($conn, $sqlCommand) or die (mysqli_error());
//$conn = mysql_connect('localhost:8080', 'root', 'secret');

?>
