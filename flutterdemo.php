<?php
// Database connection parameters
$servername = "205.76.898.56";
$username = "flutter";
$password = "flutter@123";
$dbname = "flutterdemo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to create a new employee
function createEmployee($name, $address, $mobile, $email, $dob, $salary, $isMarried, $gender, $photo, $resume, $departmentId) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO employees (name, address, mobile, email, dob, salary, isMarried, gender, photo, resume, departmentId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssdisssi", $name, $address, $mobile, $email, $dob, $salary, $isMarried, $gender, $photo, $resume, $departmentId);
    $stmt->execute();
    $stmt->close();
}

// Function to read all employees
function readEmployees() {
    global $conn;
    $sql = "SELECT * FROM employees";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["name"] . " - Address: " . $row["address"] . "<br>";
        }
    } else {
        echo "0 results";
    }
}

// Function to update an employee
function updateEmployee($id, $name, $address, $mobile, $email, $dob, $salary, $isMarried, $gender, $photo, $resume, $departmentId) {
    global $conn;
    $stmt = $conn->prepare("UPDATE employees SET name=?, address=?, mobile=?, email=?, dob=?, salary=?, isMarried=?, gender=?, photo=?, resume=?, departmentId=? WHERE id=?");
    $stmt->bind_param("sssssdisssii", $name, $address, $mobile, $email, $dob, $salary, $isMarried, $gender, $photo, $resume, $departmentId, $id);
    $stmt->execute();
    $stmt->close();
}

// Function to delete an employee
function deleteEmployee($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM employees WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Example usage
// Uncomment these lines to use the functions
// createEmployee('John Doe', '123 Main St', '555-555-5555', 'john@example.com', '1990-01-01', 50000, 0, 'M', 'path/to/photo.jpg', 'path/to/resume.pdf', 1);
// readEmployees();
// updateEmployee(1, 'Jane Doe', '123 Main St', '555-555-5555', 'jane@example.com', '1990-01-01', 60000, 1, 'F', 'path/to/photo.jpg', 'path/to/resume.pdf', 1);
// deleteEmployee(1);

$conn->close();
?>
