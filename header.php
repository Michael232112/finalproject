<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . " | MISO HELP PAGE" : "MISO HELP PAGE"; ?></title>
    <link rel="stylesheet" type="text/css" href="css/demo.css" />
    <link rel="stylesheet" type="text/css" href="css/style1.css" />
    <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css' />
    <style>
        :root {
            --primary-color: #4285f4;
            --secondary-color: #34a853;
            --accent-color: #ea4335;
            --light-bg: #f8f9fa;
            --dark-text: #202124;
            --light-text: #ffffff;
            --border-color: #dadce0;
        }
        
        body {
            font-family: 'Terminal Dosis', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
        }
        
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .header {
            background-color: var(--primary-color);
            color: var(--light-text);
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo-container img {
            height: 50px;
            margin-right: 15px;
            border: none;
        }
        
        .site-title {
            font-size: 24px;
            margin: 0;
        }
        
        .nav-menu {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        
        .nav-menu li {
            margin-left: 20px;
        }
        
        .nav-menu a {
            color: var(--light-text);
            text-decoration: none;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .nav-menu a:hover {
            background-color: rgba(255,255,255,0.2);
        }
        
        .page-title {
            text-align: center;
            margin: 30px 0;
            color: var(--primary-color);
            font-size: 32px;
        }
        
        .page-subtitle {
            text-align: center;
            margin-top: -15px;
            margin-bottom: 30px;
            color: #666;
            font-size: 18px;
        }
        
        @media screen and (max-width: 768px) {
            .header-content {
                flex-direction: column;
            }
            
            .nav-menu {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .nav-menu li {
                margin: 5px;
            }
        }
    </style>
    <?php if (isset($additionalStyles)) echo $additionalStyles; ?>
</head>
<body>
    <div class="header">
        <div class="main-container">
            <div class="header-content">
                <div class="logo-container">
                    <img src="Images/logo.jpg" alt="MISO Logo">
                    <h1 class="site-title">MISO Help Page</h1>
                </div>
                <ul class="nav-menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="send_ticket.html">Create Ticket</a></li>
                    <li><a href="search.php">Search Ticket</a></li>
                    <li><a href="diy_corner.html">DIY Corner</a></li>
                    <li><a href="viewguide.php">Guides</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <div class="main-container">
        <?php if (isset($pageTitle)): ?>
            <h1 class="page-title"><?php echo $pageTitle; ?></h1>
            <?php if (isset($pageSubtitle)): ?>
                <p class="page-subtitle"><?php echo $pageSubtitle; ?></p>
            <?php endif; ?>
        <?php endif; ?> 