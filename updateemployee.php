
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Employee</title>
</head>

<body>
        <h2>Update an Employee Record</h2>
        <hr>
        <?php
                echo "<h3>PHP Code Generates This:</h3>";

                //some variables
                $servername = "localhost";  //mysql is on the same host as apache (not realistic) this would more likely be an IP address
                //$username = "<put your db username here>";    //username for database
                $username = "jarmatt";
                //$password = "<put your db password here>";            //password for the user
                $password = "?wmz9ih6";
                $dbname = "employees";          //which db you're going to use

                //this is the php object oriented style of creating a mysql connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                //check for connection success
                if ($conn->connect_error) {
                        die("MySQL Connection Failed: " . $conn->connect_error);
                }
                echo "MySQL Connection Succeeded<br><br>";

                //pull the attribute that was passed with the html form GET request and put into a local variable.
                $number = $_GET["number"];
		$lastname = $_GET["lastname"];
		$firstname = $_GET["firstname"];
		$birthdate = $_GET["birthdate"];
		$hiredate = $_GET["hiredate"];
		$gender = $_GET["gender"];
                echo "Searching for: " . $number;

                echo "<br><br>";

                //create the SQL select statement, notice the funky string concat at the end to variablize the query
                //based on using the GET attribute
                $sql = "SELECT * FROM employees where emp_no = '".$number."'";

                //put the resultset into a variable, again object oriented way of doing things here
                $result = $conn->query($sql);

                //if there were no records found say so, otherwise create a while loop that loops through all rows
                //and echos each line to the screen. You do this by creating some crazy looking echo statements
                // in the form of HTMLText . row[column] . HTMLText . row[column].   etc...
                // the dot "." is PHP's string concatenator operator
                echo "<strong>Employee Information</strong><br><br>";
                echo "<table style=\"width:45%\">";
                echo "<tr><td><strong>Employee Number</strong></td><td><strong>Birth Date</strong></td><td><strong>First Name</strong></td><td><strong>Last Name</strong></td><td><strong>Hire Date</strong></td><td><strong>Gender</strong></td></tr>";
                if ($result->num_rows > 0){
                        //print rows
                        while($row = $result->fetch_assoc()){
                                echo "<tr><td>" . $row["emp_no"]. "</td><td>" . $row["birth_date"]. "</td><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td><td>" . $row["hire_date"]. "</td><td>" . $row["gender"]. "</td></tr>";
                        }
                        
			if ($lastname != NULL){
				$update = "UPDATE employees set last_name = '".$lastname."' where emp_no = '".$number."'";
				$conn->query($update);
			}
			if ($firstname != NULL){
                                $update = "UPDATE employees set first_name = '".$firstname."' where emp_no = '".$number."'";
                                $conn->query($update);
                        }
			if ($hiredate != NULL){
                                $update = "UPDATE employees set hire_date = '".$hiredate."' where emp_no = '".$number."'";
                                $conn->query($update);
                        }
			if ($gender != NULL){
                                $update = "UPDATE employees set gender = '".$gender."' where emp_no = '".$number."'";
                                $conn->query($update);
                        }
			if ($birthdate != NULL){
                                $update = "UPDATE employees set birth_date = '".$birthdate."' where emp_no = '".$number."'";
                                $conn->query($update);
                        }
                } else {
                        echo "No Records Found";
                }
                echo "</table>";
		$result = $conn->query($sql);
		echo "<br><br>";
		echo "Updated Employee";
		echo "<br><br>";
		echo "<strong>Employee Information</strong><br><br>";
                echo "<table style=\"width:45%\">";
                echo "<tr><td><strong>Employee Number</strong></td><td><strong>Birth Date</strong></td><td><strong>First Name</strong></td><td><strong>Last Name</strong></td><td><strong>Hire Date</strong></td><td><strong>Gender</strong></td></tr>";
                if ($result->num_rows > 0){
                        //print rows
                        while($row = $result->fetch_assoc()){
                                echo "<tr><td>" . $row["emp_no"]. "</td><td>" . $row["birth_date"]. "</td><td>" . $row["first_name"]. "</td><td>" . $row["last_name"]. "</td><td>" . $row["hire_date"]. "</td><td>" . $row["gender"]. "</td></tr>";
                        }
		} else {
                        echo "No Records Found";
                }
                //always close the DB connections, don't leave 'em hanging
                $conn->close();

        ?>
</body>
</html>



