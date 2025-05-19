    </div> <!-- End of main-container -->

    <footer class="site-footer">
        <div class="main-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="send_ticket.html">Create Ticket</a></li>
                        <li><a href="search.php">Search Ticket</a></li>
                        <li><a href="delete.php">Delete Ticket</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>DIY Resources</h3>
                    <ul>
                        <li><a href="diy_corner.html">Add Guide</a></li>
                        <li><a href="viewguide.php">Browse Guides</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact</h3>
                    <p>CTU-Argao Campus</p>
                    <p>Email: miso@ctu.edu.ph</p>
                    <p>Phone: (123) 456-7890</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date("Y"); ?> MISO Help Page | CTU-Argao Campus</p>
            </div>
        </div>
    </footer>

    <style>
        .site-footer {
            background-color: #333;
            color: #fff;
            padding: 40px 0 20px;
            margin-top: 50px;
        }
        
        .footer-content {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        
        .footer-section {
            flex: 1;
            min-width: 200px;
            margin-bottom: 20px;
            padding-right: 20px;
        }
        
        .footer-section h3 {
            color: var(--secondary-color);
            margin-bottom: 15px;
            font-size: 18px;
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li {
            margin-bottom: 8px;
        }
        
        .footer-section a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-section a:hover {
            color: var(--light-text);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            margin-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
            font-size: 14px;
        }
        
        @media screen and (max-width: 768px) {
            .footer-content {
                flex-direction: column;
            }
            
            .footer-section {
                margin-bottom: 30px;
            }
        }
    </style>

    <!-- Add any JavaScript here -->
    <script>
        // Add any common JavaScript functionality here
        document.addEventListener('DOMContentLoaded', function() {
            // Highlight current page in navigation
            const currentPage = window.location.pathname.split('/').pop();
            const navLinks = document.querySelectorAll('.nav-menu a');
            
            navLinks.forEach(link => {
                const linkHref = link.getAttribute('href');
                if (linkHref === currentPage) {
                    link.style.backgroundColor = 'rgba(255,255,255,0.2)';
                    link.style.fontWeight = 'bold';
                }
            });
        });
    </script>
</body>
</html> 