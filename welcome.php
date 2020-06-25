<?php
// Initialize the session
session_start();
 
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: index.php");
  exit;
}
?>

<?php
error_reporting(0);
$user = "root";
$pass = "Root@1234567";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=sellers', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
$limit = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 5;
$page  = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
$links = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$a=$_SESSION['username'];
$query = "SELECT * FROM sellers where `FOS NAME`='$a' ";

require_once 'paginator.class.php';
$paginator  = new Paginator($dbh, $query);
$results    = $paginator->getData($limit, $page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
html { 
    background: url(images/ecomm.jpeg) no-repeat center center fixed #000; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
</style>
	<title>Welcome</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/creative.min.css">
</head>
<body>
<div class="container" align="right">   
      <a href="logout.php"><button style='color:red'><h2>Log Out</h2></button> </a>
    </div> 
	
<br><br><br><br><br>
   
        <table class="table table-bordered" border="1" bgcolor="white">
            <thead>
			<h1 style='color:green' align="center">Details</h1><br>
			<?php
			if($results->data)
			{
				echo "<div style='color:green'>";
				
               echo "<tr>";
                    echo "<th>Order ID</th><th >Shiprocket Created At</th>  <th >Product Quantity</th><th>Customer Name</th><th>Customer Mobile</th><th>Address City</th><th>Address State</th><th>Product Price</th><th>Order Total</th><th>Courier Company</th><th>AWB Code</th><th>FOS NAME</th><th>Track Order</th>";
                echo "</tr>";
				for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                        <tr>
                                <td><?php echo $results->data[$i]['Order ID']; ?></td>
                                <td><?php echo $results->data[$i]['Shiprocket Created At']; ?></td>
                                
								<td><?php echo $results->data[$i]['Product Quantity']; ?></td>
								<td><?php echo $results->data[$i]['Customer Name']; ?></td>
								<td><?php echo $results->data[$i]['Customer Mobile']; ?></td>
								<td><?php echo $results->data[$i]['Address City']; ?></td>
								<td><?php echo $results->data[$i]['Address State']; ?></td>
								<td><?php echo $results->data[$i]['Product Price']; ?></td>
								<td><?php echo $results->data[$i]['Order Total']; ?></td>
								<td><?php echo $results->data[$i]['Courier Company']; ?></td>
								<td><?php echo $results->data[$i]['AWB Code']; ?></td>
								<td><?php echo $results->data[$i]['FOS NAME']; ?></td>
								<td> <a href="https://shiprocket.co/tracking/<?php echo $results->data[$i]['AWB Code'];?>" target="_blank"><button type="button" class="btn btn-success" name="b1" style="color:red" value="approve" >Track</button></a></td>
			
                        </tr>
                <?php endfor;  ?>
				</table>
				<?php echo $paginator->createLinks($links);
			}
				else
					echo "<h1 style='color:green' align='center'>No Records Found</h1>";	
					echo "</div>";		?>
        
</body>
</html>