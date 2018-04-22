<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="task";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

 $sr_no=$_POST['sr_no'];
 $year=$_POST['year'];
 $emp=$_POST['emp'];
 //$number = "/^(201[6-9]\d|20[2-4]\d|2050)$/";
$sql="INSERT INTO `demo` 
		(`serial_no`, `year`, `employees`) 
		VALUES ('$sr_no', '$year', '$emp')";
        $result = $conn->query($sql);
        if($result)
        {
        	
        }
        else
        {
        	echo "query failed";
        }
  
 $sql="SELECT t1.year, (t1.employees-t2.employees) as Diff FROM demo t1, demo t2 where t1.year=$year order by t1.year limit 1";
 
				$result=$conn->query($sql);
				while($rows=$result->fetch_array()){
					
				    echo "<tr>";
				    echo "<td>".$rows['0']."</td>";
				    echo "<td>".$rows['1']."</td>";
				    echo   "</tr>";
				  } 

?>