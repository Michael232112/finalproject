<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finalproject";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

echo "<h2>Testing DIY Table Insert</h2>";

// Test direct query
$test_problem = "Test Problem";
$test_troubleshooting = "Test Troubleshooting Steps";

// First, let's check the table structure
$result = $connection->query("DESCRIBE diy");
echo "<h3>DIY Table Structure:</h3>";
echo "<table border='1'>";
echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["Field"] . "</td>";
    echo "<td>" . $row["Type"] . "</td>";
    echo "<td>" . $row["Null"] . "</td>";
    echo "<td>" . $row["Key"] . "</td>";
    echo "<td>" . $row["Default"] . "</td>";
    echo "<td>" . $row["Extra"] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Try direct insert
$sql = "INSERT INTO diy (problem, troubleshooting) VALUES ('$test_problem', '$test_troubleshooting')";

if ($connection->query($sql) === TRUE) {
    echo "<p>Test record inserted successfully. ID: " . $connection->insert_id . "</p>";
    
    // Check if the data was actually inserted
    $check_sql = "SELECT * FROM diy WHERE id = " . $connection->insert_id;
    $check_result = $connection->query($check_sql);
    
    if ($check_result->num_rows > 0) {
        $row = $check_result->fetch_assoc();
        echo "<h3>Inserted Data:</h3>";
        echo "<p>ID: " . $row["id"] . "</p>";
        echo "<p>Problem: " . $row["problem"] . "</p>";
        echo "<p>Troubleshooting: " . $row["troubleshooting"] . "</p>";
        echo "<p>Created at: " . $row["created_at"] . "</p>";
    } else {
        echo "<p>Error: Could not find the inserted record.</p>";
    }
} else {
    echo "<p>Error: " . $sql . "<br>" . $connection->error . "</p>";
}

// Close connection
$connection->close();
?> 