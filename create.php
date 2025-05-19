<?php
// Include common functions
require_once 'functions.php';

// Set page title
$pageTitle = "Create Ticket";
$pageSubtitle = "Submit a new support ticket";

// Include header
include 'header.php';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = clean_input($_POST["fname"]);
    $lname = clean_input($_POST["lname"]);
    $email = clean_input($_POST["email"]);
    $phone = clean_input($_POST["phone"]);
    $dept = clean_input($_POST["dept"]);
    $issue = clean_input($_POST["issue"]);
    $priority = clean_input($_POST["priority"]);
    $description = clean_input($_POST["description"]);
    
    $conn = get_db_connection();
    $stmt = $conn->prepare("INSERT INTO tickets (fname, lname, email, phone_no, dept, issue, priority, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $fname, $lname, $email, $phone, $dept, $issue, $priority, $description);
    
    if ($stmt->execute()) {
        $ticket_id = $conn->insert_id;
        ?>
        <div class="success-container">
            <div class="success-icon">✓</div>
            <h2>Ticket Created Successfully!</h2>
            <p>Your ticket has been submitted and will be processed shortly.</p>
            <div class="ticket-info">
                <p><strong>Ticket ID:</strong> <?php echo $ticket_id; ?></p>
                <p><strong>Issue:</strong> <?php echo htmlspecialchars($issue); ?></p>
                <p><strong>Priority:</strong> <?php echo get_priority_name($priority); ?></p>
            </div>
            <div class="success-actions">
                <a href="search.php?id=<?php echo $ticket_id; ?>" class="btn btn-primary">View Ticket</a>
                <a href="create.php" class="btn btn-secondary">Create Another Ticket</a>
            </div>
        </div>
        <?php
    } else {
        echo '<div class="alert alert-error">Error creating ticket. Please try again.</div>';
    }
    
    $stmt->close();
    $conn->close();
} else {
    // Display form
    ?>
    <div class="form-container">
        <div class="form-box">
            <h2>Create Support Ticket</h2>
            <p>Fill out the form below to submit your support request</p>
            
            <form method="POST" action="create.php">
                <div class="form-row">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname" required>
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="dept">Department</label>
                        <select id="dept" name="dept" required>
                            <option value="">Select Department</option>
                            <option value="1">College of Education</option>
                            <option value="2">College of Agriculture</option>
                            <option value="3">College of Forestry</option>
                            <option value="4">College of Hospitality and Tourism</option>
                            <option value="5">College of Arts and Science</option>
                            <option value="6">Registrar's Office</option>
                            <option value="7">Administrative Office</option>
                            <option value="8">Cashier's/Accounting Office</option>
                            <option value="9">College of Technology and Engineering</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Priority Level</label>
                        <select id="priority" name="priority" required>
                            <option value="">Select Priority</option>
                            <option value="1">Normal</option>
                            <option value="2">High</option>
                            <option value="3">Urgent</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="issue">Issue Title</label>
                    <input type="text" id="issue" name="issue" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="5" required></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Submit Ticket</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php
}
?>

<style>
    .form-container {
        display: flex;
        justify-content: center;
        padding: 20px 0;
    }
    
    .form-box {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        width: 100%;
        max-width: 800px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .form-box h2 {
        color: var(--primary-color);
        margin-bottom: 10px;
        text-align: center;
    }
    
    .form-box p {
        color: #666;
        margin-bottom: 30px;
        text-align: center;
    }
    
    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .form-group {
        flex: 1;
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }
    
    .form-group textarea {
        resize: vertical;
    }
    
    .form-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 30px;
    }
    
    .success-container {
        background-color: white;
        border-radius: 10px;
        padding: 40px 30px;
        max-width: 600px;
        margin: 0 auto;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .success-icon {
        font-size: 48px;
        color: #4caf50;
        margin-bottom: 20px;
    }
    
    .success-container h2 {
        color: #4caf50;
        margin-bottom: 15px;
    }
    
    .ticket-info {
        background-color: var(--light-bg);
        border-radius: 5px;
        padding: 20px;
        margin: 20px 0;
        text-align: left;
    }
    
    .ticket-info p {
        margin: 10px 0;
    }
    
    .success-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
    
    .alert {
        padding: 15px;
        margin: 20px auto;
        max-width: 600px;
        border-radius: 5px;
        text-align: center;
    }
    
    .alert-error {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }
    
    @media screen and (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .form-box {
            padding: 20px;
        }
        
        .success-actions {
            flex-direction: column;
        }
    }
</style>

<?php
// Include footer
include 'footer.php';
?>
