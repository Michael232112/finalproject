<?php
/**
 * MISO Help Page - Common Functions
 * This file contains reusable functions for the MISO Help Page system
 */

// Start session if not already started
function start_session_if_needed() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Database connection function
function get_db_connection() {
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
    
    // Set character set to utf8
    $connection->set_charset("utf8");
    
    return $connection;
}

// Clean input data to prevent SQL injection
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Format date/time
function format_datetime($datetime, $format = 'M d, Y h:i A') {
    $date = new DateTime($datetime);
    return $date->format($format);
}

// Get department name by ID
function get_department_name($dept_id) {
    $departments = [
        1 => "College of Education",
        2 => "College of Agriculture",
        3 => "College of Forestry",
        4 => "College of Hospitality and Tourism",
        5 => "College of Arts and Science",
        6 => "Registrar's Office",
        7 => "Administrative Office",
        8 => "Cashier's/Accounting Office",
        9 => "College of Technology and Engineering"
    ];
    
    return isset($departments[$dept_id]) ? $departments[$dept_id] : "Unknown";
}

// Get priority level name
function get_priority_name($priority_id) {
    $priorities = [
        1 => "Normal",
        2 => "High",
        3 => "Urgent"
    ];
    
    return isset($priorities[$priority_id]) ? $priorities[$priority_id] : "Unknown";
}

// Get priority class for styling
function get_priority_class($priority_id) {
    $classes = [
        1 => "priority-normal",
        2 => "priority-high",
        3 => "priority-urgent"
    ];
    
    return isset($classes[$priority_id]) ? $classes[$priority_id] : "";
}

// Display success message
function show_success_message($message) {
    return '<div class="alert alert-success">' . $message . '</div>';
}

// Display error message
function show_error_message($message) {
    return '<div class="alert alert-error">' . $message . '</div>';
}

// Get all DIY guides
function get_all_diy_guides($limit = null, $offset = 0) {
    $conn = get_db_connection();
    
    $sql = "SELECT * FROM diy ORDER BY id ASC";
    if ($limit !== null) {
        $sql .= " LIMIT $offset, $limit";
    }
    
    $result = $conn->query($sql);
    $guides = [];
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $guides[] = $row;
        }
    }
    
    $conn->close();
    return $guides;
}

// Get a specific DIY guide by ID
function get_diy_guide($id) {
    $conn = get_db_connection();
    
    $stmt = $conn->prepare("SELECT * FROM diy WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $guide = null;
    
    if ($result->num_rows > 0) {
        $guide = $result->fetch_assoc();
    }
    
    $stmt->close();
    $conn->close();
    
    return $guide;
}

// Get a specific ticket by ID
function get_ticket($id) {
    $conn = get_db_connection();
    
    $stmt = $conn->prepare("SELECT * FROM tickets WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $ticket = null;
    
    if ($result->num_rows > 0) {
        $ticket = $result->fetch_assoc();
    }
    
    $stmt->close();
    $conn->close();
    
    return $ticket;
}

// Count total number of tickets
function count_tickets() {
    $conn = get_db_connection();
    $result = $conn->query("SELECT COUNT(*) as total FROM tickets");
    $row = $result->fetch_assoc();
    $conn->close();
    
    return $row['total'];
}

// Count total number of DIY guides
function count_guides() {
    $conn = get_db_connection();
    $result = $conn->query("SELECT COUNT(*) as total FROM diy");
    $row = $result->fetch_assoc();
    $conn->close();
    
    return $row['total'];
}
?> 