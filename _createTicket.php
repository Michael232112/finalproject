<?php
// Database connection
$connection = new mysqli("localhost", "root", "", "finalproject");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $issue = $_POST["issue"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $dept = $_POST["dept"];
    $phone_no = $_POST["phone_no"];
    $priority = $_POST["priority"];
    $desc = $_POST["desc"];
    
    // Prepare SQL statement
    $sql = "INSERT INTO tickets (fname, lname, email, dept, phone_no, priority, issue, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare and bind parameters
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("sssissss", $fname, $lname, $email, $dept, $phone_no, $priority, $issue, $desc);
    
    // Execute query
    if ($stmt->execute()) {
        $ticket_id = $connection->insert_id;
        
        // HTML output
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>MIS HELP PAGE | Ticket Created</title>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
            <link rel="shortcut icon" href="../favicon.ico"> 
            <link rel="stylesheet" type="text/css" href="css/demo.css" />
            <link rel="stylesheet" type="text/css" href="css/style1.css" />
            <style>
                .success-container {
                    background-color: #f2f2f2;
                    border-radius: 10px;
                    padding: 20px;
                    margin: 20px auto;
                    width: 80%;
                    max-width: 600px;
                    text-align: center;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                }
                
                .success-icon {
                    color: #4CAF50;
                    font-size: 48px;
                    margin-bottom: 20px;
                }
                
                .ticket-details {
                    background-color: white;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    padding: 15px;
                    margin: 20px 0;
                    text-align: left;
                }
                
                .ticket-details h3 {
                    margin-top: 0;
                    color: #333;
                }
                
                .button {
                    background-color: #4CAF50;
                    color: white;
                    padding: 12px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                    margin: 10px;
                    text-decoration: none;
                    display: inline-block;
                }
                
                .button.blue {
                    background-color: #008CBA;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <img class="img" style="float: left;" src="Images/logo.jpg"/>
                    <div class="clr"></div>
                </div>
                
                <div class="success-container">
                    <div class="success-icon">✓</div>
                    <h2>Ticket Created Successfully!</h2>
                    <p>Your IT support ticket has been submitted.</p>
                    
                    <div class="ticket-details">
                        <h3>Ticket Details</h3>
                        <p><strong>Ticket ID:</strong> <?php echo $ticket_id; ?></p>
                        <p><strong>Issue:</strong> <?php echo $issue; ?></p>
                        <p><strong>Name:</strong> <?php echo $fname . " " . $lname; ?></p>
                        <p><strong>Email:</strong> <?php echo $email; ?></p>
                        <p><strong>Department:</strong> <?php 
                            switch($dept) {
                                case 1: echo "College of Education"; break;
                                case 2: echo "College of Agriculture"; break;
                                case 3: echo "College of Forestry"; break;
                                case 4: echo "College of Hospitality and Tourism"; break;
                                case 5: echo "College of Arts and Science"; break;
                                case 6: echo "Registrar's Office"; break;
                                case 7: echo "Administrative Office"; break;
                                case 8: echo "Cashier's/Accounting Office"; break;
                                case 9: echo "College of Technology and Engineering"; break;
                                default: echo "Unknown";
                            }
                        ?></p>
                        <p><strong>Priority:</strong> <?php echo $priority; ?></p>
                    </div>
                    
                    <p>Please keep your Ticket ID for future reference.</p>
                    
                    <div>
                        <a href="index.html" class="button">Back to Home</a>
                        <a href="search.php" class="button blue">Search Tickets</a>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $connection->close();
}
?> 