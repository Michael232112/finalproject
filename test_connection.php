<?php
// Include the database connection
include 'db_connection.php';

// Test if connection is successful
if ($connection) {
    echo "<h2>Database Connection Successful!</h2>";
    
    // Test if tables exist
    $result_tickets = $connection->query("SHOW TABLES LIKE 'tickets'");
    $result_diy = $connection->query("SHOW TABLES LIKE 'diy'");
    
    if ($result_tickets->num_rows > 0) {
        echo "<p>✅ 'tickets' table exists</p>";
    } else {
        echo "<p>❌ 'tickets' table does not exist</p>";
    }
    
    if ($result_diy->num_rows > 0) {
        echo "<p>✅ 'diy' table exists</p>";
    } else {
        echo "<p>❌ 'diy' table does not exist</p>";
    }
} else {
    echo "<h2>Database Connection Failed!</h2>";
}

// Close connection
$connection->close();
?> 