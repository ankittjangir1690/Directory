<?php include ('includes/connection.php'); 
include "includes/adminheader.php"; ?>

<html>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myTable {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}

#myTable th, #myTable td {
  text-align: left;
  padding: 12px;
}

#myTable tr {
  border-bottom: 1px solid #ddd;
}

#myTable tr.header, #myTable tr:hover {
  background-color: #f1f1f1;
}
</style>
<?php if($_SESSION['role'] == 'admin')  
{ 
	?>
	 <div id="wrapper">

    
    <?php include "includes/adminnav.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-lg-12">

                        
                        <h1 class="page-header">
                            All Users
                        </h1>
                        <form >
 
                        <td><input type="text" id="myInput" name="namee" size="100" placeholder="Search By Name..."></td>
	                      <td><input type="submit" id="myInput" name="submit"></td>
                        
                        </form>
<table class="table table-bordered table-hover">
        <?php
        //password:test@123
//$conn = mysqli_connect("localhost", "root", "","shikin");
//mysql_select_db("shikin", $conn);
//search code
error_reporting(0);
if($_REQUEST['submit']){
$namee = ( $_REQUEST['namee'] ? $_REQUEST['namee'] : '' );

if(empty($namee)){
	$make = '<h4>You must type a word to search!</h4>';
}else{
	$make = '<h4>No match found!</h4>';
	$sele = "SELECT * FROM users WHERE name LIKE '%$namee%'";
	$result = mysqli_query($conn,$sele);
	
	if($row = mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
            // $user_id = $row['id'];
            // $username = $row['username'];
            // $name = $row['name'];
            // $user_email = $row['email'];
            // $user_role = $row['role'];
            // $user_course = $row['course'];
            // echo "<tr>";
            // echo "<td>$user_id</td>";
            // echo "<td><a href='viewprofile.php?name=$username' target='_blank'> $username</a></td>";
            // echo "<td>$name</td>";
            // echo "<td>$user_email</td>";
            // echo "<td>$user_role</td>";
            // echo "<td>$user_course</td>";
            // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'><i class='fa fa-times fa-lg'></i>delete</a></td>";
            // echo "</tr>";
	}
}else{
//echo'<h2> Search Result</h2>';

print ($make);
}
// mysqli_free_result($result);
// mysqli_close($conn);
}
}

?>
</table>
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Course</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>
        
        <?php 
            $q = ( ( $namee ) ? 'WHERE  name LIKE "%'.$namee.'%"' : '' );
            $query = "SELECT * FROM users ".$q." ORDER BY name ASC ";
            $select_users = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($select_users) > 0 ) {
            while ($row = mysqli_fetch_array($select_users)) {
                $user_id = $row['id'];
                $username = $row['username'];
                $name = $row['name'];
                $user_email = $row['email'];
                $user_role = $row['role'];
                $user_course = $row['course'];
                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td><a href='viewprofile.php?name=$username' target='_blank'> $username</a></td>";
                echo "<td>$name</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                echo "<td>$user_course</td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'><i class='fa fa-times fa-lg'></i>delete</a></td>";
                echo "</tr>";
             }
        ?>

    </tbody>
 </table>

<?php 
}

    if (isset($_GET['delete'])) {
        $the_user_id = mysqli_real_escape_string($conn , $_GET['delete']);
        $query0 = "SELECT role FROM users WHERE id = '$the_user_id'";
        $result = mysqli_query($conn , $query0) or die(mysqli_error($conn));
        if (mysqli_num_rows($result) > 0 ) {
            $row = mysqli_fetch_array($result);
            $id1 = $row['role'];
        }
        if ($id1 == 'admin') {
            echo "<script>alert('admin cannot be deleted');</script>";
        }
        else {

        $query = "DELETE FROM users WHERE id = '$the_user_id'";

        $delete_query = mysqli_query($conn, $query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0 ) {
            echo "<script>alert('user deleted successfully');
            window.location.href= 'users.php';</script>";
        }
        else {
        	 echo "<script>alert('error');
            window.location.href= 'users.php';</script>";
        }
    }
}
    ?>

    <?php } else {
    	header("location: index.php");
    }
    ?>
<table class="table table-bordered table-hover">
    <!-- <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Course</th>
            <th>Delete</th>
        </tr>
    </thead> -->

    <tbody>
<?php
//$conn = mysqli_connect("localhost", "root", "","shikin");
//mysql_select_db("shikin", $conn);
//search code
//error_reporting(0);
if($_REQUEST['submit']){
$namee = $_REQUEST['namee'];

if(empty($namee)){
	$make = '<h4>You must type a word to search!</h4>';
}else{
	$make = '<h4>No match found!</h4>';
	$sele = "SELECT * FROM users WHERE name LIKE '%$namee%'";
	$result = mysqli_query($conn,$sele);
	
	if($row = mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_assoc($result)){
            // $user_id = $row['id'];
            // $username = $row['username'];
            // $name = $row['name'];
            // $user_email = $row['email'];
            // $user_role = $row['role'];
            // $user_course = $row['course'];
            // echo "<tr>";
            // echo "<td>$user_id</td>";
            // echo "<td><a href='viewprofile.php?name=$username' target='_blank'> $username</a></td>";
            // echo "<td>$name</td>";
            // echo "<td>$user_email</td>";
            // echo "<td>$user_role</td>";
            // echo "<td>$user_course</td>";
            // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this user?')\" href='users.php?delete=$user_id'><i class='fa fa-times fa-lg'></i>delete</a></td>";
            // echo "</tr>";
	}
}else{
//echo'<h2> Search Result</h2>';

//print ($make);
}
mysqli_free_result($result);
mysqli_close($conn);
}
}

?>
</table>

    </div>
    </div>
    </div>
    </div>

    </div>
    <script src="js/jquery.js"></script>

    
    <script src="js/bootstrap.min.js"></script> -->

    
<!-- <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script> -->

</body>

</html>