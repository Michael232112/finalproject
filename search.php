<?php
// Include common functions
require_once 'functions.php';

// Set page title
$pageTitle = "Search Ticket";
$pageSubtitle = "Find and view your support ticket details";

// Include header
include 'header.php';

// Process ticket search
if (isset($_GET["id"])) {
    $id = clean_input($_GET["id"]);
    $ticket = get_ticket($id);
    
    if ($ticket) {
        ?>
        <div class="ticket-details-container">
            <div class="ticket-header">
                <h2>Ticket #<?php echo $ticket["id"]; ?></h2>
                <span class="ticket-date">Created: <?php echo format_datetime($ticket["created_at"]); ?></span>
            </div>
            
            <div class="ticket-info">
                <div class="info-row">
                    <div class="info-label">Issue:</div>
                    <div class="info-value"><?php echo htmlspecialchars($ticket["issue"]); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value"><?php echo htmlspecialchars($ticket["fname"] . " " . $ticket["lname"]); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?php echo htmlspecialchars($ticket["email"]); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Phone:</div>
                    <div class="info-value"><?php echo htmlspecialchars($ticket["phone_no"]); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Department:</div>
                    <div class="info-value"><?php echo get_department_name($ticket["dept"]); ?></div>
                </div>
                
                <div class="info-row">
                    <div class="info-label">Priority:</div>
                    <div class="info-value">
                        <span class="priority <?php echo get_priority_class($ticket["priority"]); ?>">
                            <?php echo get_priority_name($ticket["priority"]); ?>
                        </span>
                    </div>
                </div>
                
                <div class="info-row description-row">
                    <div class="info-label">Description:</div>
                    <div class="info-value description-text">
                        <?php echo nl2br(htmlspecialchars($ticket["description"])); ?>
                    </div>
                </div>
            </div>
            
            <div class="ticket-actions">
                <a href="search.php" class="btn btn-primary">Search Another Ticket</a>
                <a href="index.php" class="btn btn-secondary">Back to Home</a>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="not-found-container">
            <div class="not-found-icon">❓</div>
            <h2>Ticket Not Found</h2>
            <p>No ticket found with ID: <?php echo $id; ?></p>
            <div class="not-found-actions">
                <a href="search.php" class="btn btn-primary">Try Again</a>
                <a href="send_ticket.html" class="btn btn-secondary">Create New Ticket</a>
            </div>
        </div>
        <?php
    }
} else {
    // Display search form
    ?>
    <div class="search-container">
        <div class="search-box">
            <h2>Find Your Ticket</h2>
            <p>Enter your ticket ID to view the details</p>
            
            <form method="GET" action="search.php">
                <div class="form-group">
                    <input type="number" name="id" required placeholder="Enter Ticket ID" min="1">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
            
            <div class="search-help">
                <p>Don't have a ticket yet? <a href="send_ticket.html">Create a new support ticket</a></p>
            </div>
        </div>
    </div>
    <?php
}
?>

<style>
    .search-container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 0;
    }
    
    .search-box {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .search-box h2 {
        color: var(--primary-color);
        margin-bottom: 10px;
    }
    
    .search-box p {
        color: #666;
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group input {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 16px;
        box-sizing: border-box;
    }
    
    .form-actions {
        margin-bottom: 20px;
    }
    
    .search-help {
        font-size: 14px;
        color: #666;
    }
    
    .search-help a {
        color: var(--primary-color);
        text-decoration: none;
    }
    
    .search-help a:hover {
        text-decoration: underline;
    }
    
    .ticket-details-container {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        max-width: 800px;
        margin: 0 auto;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .ticket-header {
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 15px;
        margin-bottom: 20px;
    }
    
    .ticket-header h2 {
        color: var(--primary-color);
        margin-bottom: 5px;
    }
    
    .ticket-date {
        color: #666;
        font-size: 14px;
    }
    
    .ticket-info {
        margin-bottom: 30px;
    }
    
    .info-row {
        display: flex;
        margin-bottom: 15px;
        align-items: flex-start;
    }
    
    .info-label {
        width: 120px;
        font-weight: bold;
        color: #333;
    }
    
    .info-value {
        flex: 1;
    }
    
    .description-row {
        margin-top: 20px;
    }
    
    .description-text {
        background-color: var(--light-bg);
        padding: 15px;
        border-radius: 5px;
        white-space: pre-wrap;
        line-height: 1.6;
    }
    
    .priority {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: bold;
    }
    
    .priority-normal {
        background-color: #4caf50;
        color: white;
    }
    
    .priority-high {
        background-color: #ff9800;
        color: white;
    }
    
    .priority-urgent {
        background-color: #f44336;
        color: white;
    }
    
    .ticket-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    .btn {
        display: inline-block;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        text-align: center;
        transition: background-color 0.3s;
    }
    
    .btn-primary {
        background-color: var(--primary-color);
        color: white;
    }
    
    .btn-primary:hover {
        background-color: #3367d6;
    }
    
    .btn-secondary {
        background-color: #757575;
        color: white;
    }
    
    .btn-secondary:hover {
        background-color: #616161;
    }
    
    .not-found-container {
        background-color: white;
        border-radius: 10px;
        padding: 40px 30px;
        max-width: 500px;
        margin: 0 auto;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .not-found-icon {
        font-size: 48px;
        margin-bottom: 20px;
        color: #f44336;
    }
    
    .not-found-container h2 {
        color: #f44336;
        margin-bottom: 10px;
    }
    
    .not-found-container p {
        color: #666;
        margin-bottom: 25px;
    }
    
    .not-found-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
    }
    
    @media screen and (max-width: 768px) {
        .ticket-details-container,
        .not-found-container,
        .search-box {
            padding: 20px;
        }
        
        .info-row {
            flex-direction: column;
        }
        
        .info-label {
            width: 100%;
            margin-bottom: 5px;
        }
        
        .ticket-actions,
        .not-found-actions {
            flex-direction: column;
            gap: 10px;
        }
    }
</style>

<?php
// Include footer
include 'footer.php';
?>
