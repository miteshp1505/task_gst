<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>

				<div class="col-md-4" style="margin-top: 15px;">
					<div class="row">
					<div class="col-md-12" id="msg">
					</div>
					</div>
			        <form action="" method="post">
			   <?php 
			  
// database connection
			    $servername = "localhost";
				$username = "root";
				$password = "";
				$dbname="task";

				// Create connection
				$conn = new mysqli($servername, $username, $password,$dbname);
				// select your database
				$result = $conn->query("SHOW TABLE STATUS LIKE 'demo'");
				$data = $result->fetch_assoc();
				$next_increment = $data['Auto_increment'];
				

			    ?>
					<div class="form-gsroup">
					  Serial No:<input type="text" class="form-control" name="sr_no" value="<?php echo $next_increment; ?>" readonly="">
					</div>
					<div class="form-group">
						<?php
							// database connection
			    $servername = "localhost";
				$username = "root";
				$password = "";
				$dbname="task";

				// Create connection
				$conn = new mysqli($servername, $username, $password,$dbname);
				// select your database
				$result = $conn->query("SELECT MAX(year)+1 FROM demo");
				
				$row =$result->fetch_row();
						?>
					  Select Year:<input type="number" class="form-control" id="year" name="year" value="<?php echo $row['0']; ?>" readonly="">
					</div>
					
					<div class="form-group">
					  Employees:<input type="number" class="form-control" name="emp">
					</div>
					<br><br>
			<button type="button" class="btn btn-default" id="add_data">Submit</button>
			<button type="button" class="btn btn-default" id="view" style="float: right;">View</button>
				
			</form>
			</div>
			<div class="col-md-4"></div>
        </div>
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4" id="data">
           <?php 
		        $servername = "localhost";
					$username = "root";
					$password = "";
					$dbname="task";

					// Create connection
					$conn = new mysqli($servername, $username, $password,$dbname);

           	$sql="select year,(employees-employees) as diff from demo where year in (select min(year) from demo) UNION SELECT t1.year, (t1.employees-t2.employees) as Diff FROM demo t1, demo t2 where t1.year=t2.year+1";
 				?>	
 					<table class='table' id='show'>
				    <thead>
				      <tr>
				        <th>Year</th>
				        <th>Difference</th>
				      </tr>
				    </thead>
				    <tbody id="body">
				<?php
				$result=$conn->query($sql);
				while($rows=$result->fetch_array()){
            ?>
            	    <tr>
				    <td><?php echo $rows['0']; ?></td>
				    <td><?php echo $rows['1']; ?></td>
				    </tr>
				<?php } ?>
			</tbody>
				</table>
			</div>
            <div class="col-md-4">
			</div>
            
        </div>
    </div>
<script>
	$(document).ready(function(){
		var da=$('#year').val();
	$("#add_data").click(function(event){
		event.preventDefault();
		$.ajax({
			url    :  "insert.php",
			method :  "POST",
			data   :  $("form").serialize(),
			success : function(data){
$('#body').append(data);
			}
		})
	})
});
</script>
</body>
</html>