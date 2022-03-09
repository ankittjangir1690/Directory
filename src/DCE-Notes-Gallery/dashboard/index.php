<?php include ('includes/connection.php'); ?>
<?php include('includes/adminheader.php');  ?>
<?php
        //password:test@123
//$conn = mysqli_connect("localhost", "root", "","shikin");
//mysql_select_db("shikin", $conn);
//search code
error_reporting(0);
if($_REQUEST['submit']){
$namee = ( $_REQUEST['namee'] ? $_REQUEST['namee'] : '' );

if(empty($namee)){
    $make = 'echo <script>alert("You must type a word to search!")</script>';
	//$make = '<h4>You must type a word to search!</h4>';
}else{
    // echo '<script>alert("Welcome to Geeks for Geeks")</script>';
	//$make = '<h4>No match found!</h4>';
    $make = 'echo <script>alert("No match found!")</script>';
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
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/searchicon.png');
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

    <div id="wrapper">
       
       <?php include 'includes/adminnav.php';?>
        <div id="page-wrapper">

            <div class="container-fluid">

                
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome 
                            <small><?php echo $_SESSION['name']; ?></small>
                        </h1>
                        <?php if($_SESSION['role'] == 'admin') {
                        ?>
                        <h3 class="page-header">
                            <center> <marquee width = 70% ><font color="green" > Notes uploaded by various users</font></marquee></center>
                        </h3>
            <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">

            <form action="" method="post">
            <table class="table table-bordered table-striped table-hover">


            <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Type </th>
                        <th>Uploaded on</th>
                        <th>Uploaded by </th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Approve</th>
                        <th>Delete</th>
                        
                    </tr>
            </thead>
            <tbody>

                <?php
                    
                    $query = "SELECT * FROM uploads ORDER BY file_uploaded_on DESC";
                    $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    if (mysqli_num_rows($run_query) > 0) {
                    while ($row = mysqli_fetch_array($run_query)) {
                        $file_id = $row['file_id'];
                        $file_name = $row['file_name'];
                        $file_description = $row['file_description'];
                        $file_type = $row['file_type'];
                        $file_date = $row['file_uploaded_on'];
                        $file_uploader = $row['file_uploader'];
                        $file_status = $row['status'];
                        $file = $row['file'];

                        echo "<tr>";
                        echo "<td>$file_name</td>";
                        echo "<td>$file_description</td>";
                        echo "<td>$file_type</td>";
                        echo "<td>$file_date</td>";
                        echo "<td><a href='viewprofile.php?name=$file_uploader' target='_blank'> $file_uploader </a></td>";
                        echo "<td>$file_status</td>";
                        echo "<td><a href='allfiles/$file' target='_blank' style='color:green'>View </a></td>";
                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to approve this note?')\"href='?approve=$file_id'><i class='fa fa-times' style='color: red;'></i>Approve</a></td>";

                        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$file_id'><i class='fa fa-times' style='color: red;'></i>delete</a></td>";

                        echo "</tr>";

                    }
                    }
                ?>


            </tbody>
            </table>
            </form>
            </div>
        </div>
    </div>
 <?php
 
    if (isset($_GET['del'])) {
        $note_del = mysqli_real_escape_string($conn, $_GET['del']);
        $file_uploader = $_SESSION['username'];
        $del_query = "DELETE FROM uploads WHERE file_id='$note_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('note deleted successfully');
            window.location.href='index.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }

         if (isset($_GET['approve'])) {
        $note_approve = mysqli_real_escape_string($conn,$_GET['approve']);
        $approve_query = "UPDATE uploads SET status='approved' WHERE file_id='$note_approve'";
        $run_approve_query = mysqli_query($conn, $approve_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) {
            echo "<script>alert('note approved successfully');
            window.location.href='index.php';</script>";
        }
        else {
         echo "<script>alert('error occured.try again!');</script>";   
        }
        }
       

        ?>
        <?php 
        }
        else {
        ?>


        <h3 class="page-header">
                <center> <marquee width = 70% ><font color="green" ><?php echo $_SESSION['course']; ?> Engineering </font><font color="brown"> notes uploaded by various users</font></marquee></center>
        </h3>

        </div>
        </div>
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<form action="">
<td><input type="text" id="myInput" name="namee" size="100"></td>
                <td><input type="submit" id="myInput" name="submit"></td>
</form>
<!--<form action="" method="post">-->
            <table class="table table-bordered table-striped table-hover">


            <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Type </th>
                        <th>Uploaded by</th>
                        <th>Uploaded on</th>
                        <th>Download</th>
                        
                    </tr>
            </thead>
            <tbody>

                <?php
                $currentusercourse = $_SESSION['course'];
                $q = ( ( $namee ) ? 'AND file_uploader LIKE "%'.$namee.'%"' : '' );
                    //$query = "SELECT * FROM users ".$q." ORDER BY name ASC ";
                $query = "SELECT * FROM uploads WHERE file_uploaded_to = '$currentusercourse' AND status = 'approved' ".$q." ORDER BY file_uploaded_on DESC";
                $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($run_query) > 0) {
                while ($row = mysqli_fetch_array($run_query)) {
                    $file_id = $row['file_id'];
                    $file_name = $row['file_name'];
                    $file_description = $row['file_description'];
                    $file_type = $row['file_type'];
                    $file_date = $row['file_uploaded_on'];
                    $file = $row['file'];
                    $file_uploader = $row['file_uploader'];

                    echo "<tr>";
                    echo "<td>$file_name</td>";
                    echo "<td>$file_description</td>";
                    echo "<td>$file_type</td>";
                    echo "<td><a href='viewprofile.php?name=$file_uploader' target='_blank'> $file_uploader </a></td>";
                    echo "<td>$file_date</td>";
                    echo "<td><a href='allfiles/$file' target='_blank' style='color:green'>Download </a></td>";
                echo "</tr>";


                }
                }
                ?>
            </tbody>
            </table>
<!--</form>-->
</div>
</div>
</div>

<?php }
    
 
 ?>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>