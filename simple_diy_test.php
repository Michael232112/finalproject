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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $problem = $_POST['problem'];
    $troubleshooting = $_POST['troubleshooting'];
    
    // Try direct insert
    $sql = "INSERT INTO diy (problem, troubleshooting) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    
    if (!$stmt) {
        echo "<p>Prepare failed: " . $connection->error . "</p>";
    } else {
        $stmt->bind_param("ss", $problem, $troubleshooting);
        
        if ($stmt->execute()) {
            echo "<p>Success! Guide added with ID: " . $connection->insert_id . "</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple DIY Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Simple DIY Test Form</h1>
    
    <form method="post" action="">
        <div>
            <label for="problem">Problem:</label>
            <input type="text" id="problem" name="problem" required>
        </div>
        
        <div>
            <label for="troubleshooting">Troubleshooting:</label>
            <textarea id="troubleshooting" name="troubleshooting" required></textarea>
        </div>
        
        <button type="submit">Submit</button>
    </form>
    
    <p><a href="index.html">Back to Home</a></p>
</body>
</html> 