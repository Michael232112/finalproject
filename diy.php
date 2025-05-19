<?php
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data - updated to match the form field names
    $problem = $_POST['problem'];
    $troubleshooting = $_POST['troubleshooting'];
    
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
    
    // Prepare and execute SQL statement - using the correct column names from your table
    $sql = "INSERT INTO diy (problem, troubleshooting) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    
    // Make sure we're binding the parameters correctly
    if (!$stmt) {
        die("Prepare failed: " . $connection->error);
    }
    
    $stmt->bind_param("ss", $problem, $troubleshooting);
    
    // Set up HTML for response
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>DIY Guide Submission</title>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style1.css" />
        <style>
            div.container {
                width: 100%;
                border: 1px solid white;
                height: 100%;
                background: linear-gradient(blue 30%, white, blue);
            }
            
            header {
                padding: 1em;
                color: black;
                background: linear-gradient(white);
                clear: left;
                text-align: center;
                border: 3px solid brown;
                font-family: "Times New Roman", Georgia, Serif;
            }
            
            img {
                margin: 5px;
                border: 1px solid #ccc;
                float: left;
                width: 180px;
            }
            
            article {
                margin: 0 auto;
                padding: 2em;
                overflow: hidden;
                width: 80%;
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 10px;
                text-align: center;
            }
            
            #myProgress {
                position: relative;
                width: 100%;
                height: 30px;
                background-color: #ddd;
                margin: 20px 0;
            }
            
            #myBar {
                position: absolute;
                width: 10%;
                height: 100%;
                background-color: #4CAF50;
            }
            
            #label {
                text-align: center;
                line-height: 30px;
                color: white;
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
                <a href="javascript:history.go(-1)">
                    <img class="img" style="float: right;" src="Images/back.jpg"/>
                </a>
                <div class="clr"></div>               
            </div>
            <header>
                <h1>SELF-HELP TROUBLESHOOTING GUIDES</h1>
            </header>
            <article>
                <?php
                // For debugging - display the values being submitted
                echo "<p style='display:none;'>Problem: " . htmlspecialchars($problem) . "</p>";
                echo "<p style='display:none;'>Troubleshooting: " . htmlspecialchars($troubleshooting) . "</p>";
                
                if ($stmt->execute()) {
                    echo "<h1>SELF-HELP TROUBLESHOOTING GUIDE SUCCESSFULLY ADDED!</h1>";
                    
                    // Get the ID of the inserted guide
                    $new_id = $connection->insert_id;
                    echo "<p>Your guide has been added with ID: <strong>" . $new_id . "</strong></p>";
                    
                    // Progress bar
                    echo '<div id="myProgress">
                            <div id="myBar">
                                <div id="label">10%</div>
                            </div>
                        </div>';
                } else {
                    echo "<h1>Error adding guide</h1>";
                    echo "<p>Error: " . $stmt->error . "</p>";
                    echo "<p>SQL: " . $sql . "</p>";
                }
                
                // Close statement and connection
                $stmt->close();
                $connection->close();
                ?>
                
                <div style="margin-top: 30px;">
                    <button class="button" onclick="window.location.href='viewguide.php'">View All Guides</button>
                    <button class="button blue" onclick="window.location.href='diy_corner.html'">Add Another Guide</button>
                    <button class="button" onclick="window.location.href='index.html'">Back to Home</button>
                </div>
                
                <script>
                    var elem = document.getElementById("myBar");
                    var width = 10;
                    var id = setInterval(frame, 30);
                    function frame() {
                        if (width >= 100) {
                            clearInterval(id);
                            // Redirect after 2 seconds when progress completes
                            setTimeout(function() {
                                window.location.href = "viewguide.php";
                            }, 2000);
                        } else {
                            width++;
                            elem.style.width = width + '%';
                            document.getElementById("label").innerHTML = width + '%';
                        }
                    }
                </script>
            </article>
        </div>
    </body>
    </html>
    <?php
}
?>
