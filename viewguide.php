<?php
// Include common functions
require_once 'functions.php';

// Set page title
$pageTitle = "Troubleshooting Guides";
$pageSubtitle = "Browse all available DIY solutions";

// Include header
include 'header.php';

// Get guides
$guides = get_all_diy_guides();

// Handle single guide view
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $guide = get_diy_guide($id);
    
    if ($guide) {
        ?>
        <div class="guide-details">
            <div class="guide-header">
                <h2><?php echo htmlspecialchars($guide["problem"]); ?></h2>
                <span class="guide-date">Added on: <?php echo format_datetime($guide["created_at"]); ?></span>
            </div>
            
            <div class="guide-content">
                <h3>Troubleshooting Steps:</h3>
                <div class="guide-steps">
                    <?php echo nl2br(htmlspecialchars($guide["troubleshooting"])); ?>
                </div>
            </div>
            
            <div class="guide-actions">
                <a href="viewguide.php" class="btn btn-primary">View All Guides</a>
                <a href="diy_corner.html" class="btn btn-secondary">Add New Guide</a>
            </div>
        </div>
        <?php
    } else {
        echo '<div class="alert alert-error">No guide found with that ID.</div>';
        echo '<p class="text-center"><a href="viewguide.php" class="btn btn-primary">View All Guides</a></p>';
    }
} else {
    // Display all guides
    ?>
    <div class="search-form">
        <form method="GET" action="viewguide.php">
            <div class="form-group">
                <input type="text" name="search" placeholder="Search guides..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
                <?php if (isset($_GET['search'])): ?>
                    <a href="viewguide.php" class="btn btn-secondary">Clear</a>
                <?php endif; ?>
            </div>
        </form>
    </div>
    
    <div class="guides-container">
        <?php if (empty($guides)): ?>
            <div class="no-guides">
                <p>No guides available yet. Be the first to share your knowledge!</p>
                <a href="diy_corner.html" class="btn btn-primary">Add Guide</a>
            </div>
        <?php else: ?>
            <table class="guides-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Problem</th>
                        <th>Troubleshooting Steps</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guides as $guide): ?>
                        <tr>
                            <td><?php echo $guide["id"]; ?></td>
                            <td><?php echo htmlspecialchars($guide["problem"]); ?></td>
                            <td>
                                <?php 
                                    $steps = htmlspecialchars($guide["troubleshooting"]);
                                    echo (strlen($steps) > 100) ? substr($steps, 0, 100) . '...' : $steps;
                                ?>
                            </td>
                            <td><?php echo format_datetime($guide["created_at"]); ?></td>
                            <td>
                                <a href="viewguide.php?id=<?php echo $guide["id"]; ?>" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div class="guides-actions">
                <a href="diy_corner.html" class="btn btn-primary">Add New Guide</a>
            </div>
        <?php endif; ?>
    </div>
    <?php
}
?>

<style>
    .search-form {
        margin: 20px 0;
        text-align: center;
    }
    
    .form-group {
        display: flex;
        justify-content: center;
        gap: 10px;
        max-width: 600px;
        margin: 0 auto;
    }
    
    .form-group input[type="text"] {
        flex: 1;
        padding: 10px;
        border: 1px solid var(--border-color);
        border-radius: 4px;
        font-size: 16px;
    }
    
    .guides-container {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .guides-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    
    .guides-table th, .guides-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid var(--border-color);
    }
    
    .guides-table th {
        background-color: var(--light-bg);
        font-weight: bold;
        color: var(--primary-color);
    }
    
    .guides-table tr:hover {
        background-color: rgba(66, 133, 244, 0.05);
    }
    
    .guides-actions {
        margin-top: 20px;
        text-align: center;
    }
    
    .no-guides {
        text-align: center;
        padding: 40px 0;
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
    
    .btn-sm {
        padding: 5px 10px;
        font-size: 14px;
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
    
    .guide-details {
        background-color: white;
        border-radius: 10px;
        padding: 25px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    
    .guide-header {
        margin-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 15px;
    }
    
    .guide-header h2 {
        margin-bottom: 10px;
        color: var(--primary-color);
    }
    
    .guide-date {
        color: #666;
        font-size: 14px;
    }
    
    .guide-content {
        margin-bottom: 30px;
    }
    
    .guide-steps {
        background-color: var(--light-bg);
        padding: 20px;
        border-radius: 5px;
        white-space: pre-wrap;
        line-height: 1.6;
    }
    
    .guide-actions {
        display: flex;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
    }
    
    .text-center {
        text-align: center;
    }
    
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }
    
    .alert-error {
        background-color: #ffebee;
        color: #c62828;
        border: 1px solid #ffcdd2;
    }
    
    @media screen and (max-width: 768px) {
        .guides-table {
            display: block;
            overflow-x: auto;
        }
        
        .form-group {
            flex-direction: column;
        }
    }
</style>

<?php
// Include footer
include 'footer.php';
?>
