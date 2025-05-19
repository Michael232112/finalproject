<?php
// Include common functions
require_once 'functions.php';

// Set page title
$pageTitle = "Welcome";
$pageSubtitle = "IT Support System for CTU-Argao Campus";

// Get statistics
$ticketCount = count_tickets();
$guideCount = count_guides();

// Include header
include 'header.php';
?>

<!-- Main Content -->
<div class="dashboard">
    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-icon ticket-icon">🎫</div>
            <div class="stat-number"><?php echo $ticketCount; ?></div>
            <div class="stat-title">Support Tickets</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon guide-icon">📚</div>
            <div class="stat-number"><?php echo $guideCount; ?></div>
            <div class="stat-title">DIY Guides</div>
        </div>
    </div>

    <div class="services-container">
        <h2 class="section-title">Our Services</h2>
        <div class="services-grid">
            <a href="send_ticket.html" class="service-card">
                <div class="service-icon">✉️</div>
                <h3>Create a Ticket</h3>
                <p>Submit an IT support request for technical issues</p>
            </a>
            <a href="search.php" class="service-card">
                <div class="service-icon">🔍</div>
                <h3>Search a Ticket</h3>
                <p>Find and check the status of your existing tickets</p>
            </a>
            <a href="delete.php" class="service-card">
                <div class="service-icon">🗑️</div>
                <h3>Delete a Ticket</h3>
                <p>Remove resolved or outdated support tickets</p>
            </a>
            <a href="diy_corner.html" class="service-card">
                <div class="service-icon">🛠️</div>
                <h3>DIY Corner</h3>
                <p>Share your troubleshooting knowledge with others</p>
            </a>
            <a href="viewguide.php" class="service-card">
                <div class="service-icon">📖</div>
                <h3>Guides Repository</h3>
                <p>Browse all available troubleshooting guides</p>
            </a>
        </div>
    </div>

    <div class="about-section">
        <h2 class="section-title">About MISO Help Page</h2>
        <p>The Management Information System Office (MISO) Help Page is designed to streamline IT support services for CTU-Argao Campus. Our platform allows users to submit support tickets, search for existing tickets, and access a repository of DIY troubleshooting guides.</p>
        <p>Our goal is to provide efficient technical support while empowering users to solve common issues through shared knowledge and self-help resources.</p>
    </div>
</div>

<style>
    .dashboard {
        padding: 20px 0;
    }
    
    .stats-container {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 40px;
    }
    
    .stat-card {
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        width: 200px;
        transition: transform 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
    }
    
    .stat-icon {
        font-size: 36px;
        margin-bottom: 10px;
    }
    
    .ticket-icon {
        color: var(--primary-color);
    }
    
    .guide-icon {
        color: var(--secondary-color);
    }
    
    .stat-number {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 5px;
        color: var(--dark-text);
    }
    
    .stat-title {
        color: #666;
        font-size: 16px;
    }
    
    .section-title {
        text-align: center;
        margin: 40px 0 20px;
        color: var(--primary-color);
    }
    
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    
    .service-card {
        background-color: white;
        border-radius: 10px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        color: var(--dark-text);
    }
    
    .service-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
    }
    
    .service-icon {
        font-size: 40px;
        margin-bottom: 15px;
    }
    
    .service-card h3 {
        margin: 10px 0;
        color: var(--primary-color);
    }
    
    .service-card p {
        color: #666;
        font-size: 14px;
    }
    
    .about-section {
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 40px;
    }
    
    .about-section p {
        line-height: 1.6;
        margin-bottom: 15px;
    }
    
    @media screen and (max-width: 768px) {
        .stats-container {
            flex-direction: column;
            align-items: center;
        }
        
        .stat-card {
            width: 80%;
            max-width: 250px;
        }
    }
</style>

<?php
// Include footer
include 'footer.php';
?> 