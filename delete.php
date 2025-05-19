<?php
// Include common functions
require_once 'functions.php';

// Set page title
$pageTitle = "Delete Ticket";
$pageSubtitle = "Remove a support ticket from the system";

// Include header
include 'header.php';

if (isset($_POST["id"])) {
    $id = clean_input($_POST["id"]);
    $conn = get_db_connection();
    
    // First check if the ticket exists
    $stmt = $conn->prepare("SELECT id FROM tickets WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Delete the ticket
        $delete_stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
        $delete_stmt->bind_param("i", $id);
        $delete_stmt->execute();
        $deleted = true;
        $delete_stmt->close();
    } else {
        $deleted = false;
    }
    
    $stmt->close();
    $conn->close();
    
    // Display result
    ?>
    <div class="result-container">
        <?php if ($deleted): ?>
            <div class="success-icon">✓</div>
            <h2>Ticket Deleted Successfully</h2>
            <p>Ticket #<?php echo $id; ?> has been removed from the system.</p>
        <?php else: ?>
            <div class="error-icon">✗</div>
            <h2>Ticket Not Found</h2>
            <p>No ticket found with ID: <?php echo $id; ?></p>
        <?php endif; ?>
        
        <div class="result-actions">
            <a href="index.php" class="btn btn-primary">Back to Home</a>
            <a href="delete.php" class="btn btn-secondary">Delete Another Ticket</a>
        </div>
    </div>
    <?php
} else {
    // Display delete form
    ?>
    <div class="delete-container">
        <div class="delete-box">
            <h2>Delete Ticket</h2>
            <p>Enter the ticket ID you want to delete</p>
            
            <div class="warning-box">
                <div class="warning-icon">⚠️</div>
                <p>Warning: This action cannot be undone!</p>
            </div>
            
            <form method="POST" action="delete.php">
                <div class="form-group">
                    <label for="id">Ticket ID</label>
                    <input type="number" id="id" name="id" required placeholder="Enter Ticket ID" min="1">
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Delete Ticket</button>
                    <a href="index.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <?php
}
?>

<style>
    .delete-container {
        display: flex;
        justify-content: center;
        padding: 20px 0;
    }
    
    .delete-box {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: center;
    }
    
    .delete-box h2 {
        color: var(--primary-color);
        margin-bottom: 10px;
    }
    
    .delete-box p {
        color: #666;
        margin-bottom: 20px;
    }
    
    .warning-box {
        background-color: #fff3e0;
        border: 1px solid #ffe0b2;
        border-radius: 5px;
        padding: 15px;
        margin: 20px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .warning-icon {
        font-size: 24px;
    }
    
    .warning-box p {
        color: #e65100;
        margin: 0;
        font-weight: 500;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
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
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 30px;
    }
    
    .result-container {
        background-color: white;
        border-radius: 10px;
        padding: 40px 30px;
        max-width: 500px;
        margin: 0 auto;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .success-icon {
        font-size: 48px;
        color: #4caf50;
        margin-bottom: 20px;
    }
    
    .error-icon {
        font-size: 48px;
        color: #f44336;
        margin-bottom: 20px;
    }
    
    .result-container h2 {
        margin-bottom: 15px;
    }
    
    .result-container p {
        color: #666;
        margin-bottom: 25px;
    }
    
    .result-actions {
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
    
    .btn-danger {
        background-color: #f44336;
        color: white;
    }
    
    .btn-danger:hover {
        background-color: #d32f2f;
    }
    
    @media screen and (max-width: 768px) {
        .delete-box,
        .result-container {
            padding: 20px;
        }
        
        .form-actions,
        .result-actions {
            flex-direction: column;
        }
    }
</style>

<?php
// Include footer
include 'footer.php';
?>
