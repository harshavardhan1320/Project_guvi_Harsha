<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "demo";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 $myFile = "/xampp/htdocs/guvi/assets/data.json";
 $arr_data = array(); // create empty array

$email = $_POST["email"];
$name = $_POST["name"];
$age = $_POST["age"];
$gender = $_POST["gender"];
$phone = $_POST["phone"];
$dob = $_POST["dob"];
$college = $_POST["college"];
$state = $_POST["state"];
$degree = $_POST["degree"];
$dept = $_POST["dept"];
$yop = $_POST["yop"];
$aoi = $_POST["aoi"];


$sql = $conn->prepare("UPDATE user SET name=?, age=?, gender=?, phone=?, dob=?, college=?, state=?, degree=?, department=?, yop=?, aoi=? WHERE email=?");

// Check for errors in prepare
if (!$sql) {
    die("Prepare failed: " . $conn->error);
}

$sql->bind_param("ssssssssssss", $name, $age, $gender, $phone, $dob, $college, $state, $degree, $dept, $yop, $aoi, $email);

// Check for errors in bind_param
if (!$sql) {
    die("Bind param failed: " . $conn->error);
}

$sql->execute();

// Check for errors in execute
if ($sql->error) {
    die("Execute failed: " . $sql->error);
}

// Commit changes if using transactions
$conn->commit();

// Close statement
$sql->close();

// Select and fetch data
$result = $conn->query("SELECT * FROM user");

// Check for errors in query
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Initialize array variable
$dbdata = array();

// Fetch into associative array
while ($row = $result->fetch_assoc()) {
    $dbdata[] = $row;
}

// Close result set
$result->close();

// Close connection
$conn->close();



$jsondata = json_encode($dbdata, JSON_PRETTY_PRINT);

// Assuming $myFile is defined somewhere
file_put_contents($myFile, $jsondata);


echo $jsondata;

echo "2";
?>
   
