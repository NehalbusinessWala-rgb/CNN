
Back (accesskey b)   Save (accesskey s)   
Normal textarea
File: /public_html/CNN/footer.php
 	Status: This file has not yet been saved
    <style>
        footer {
            background-color: var(--cnn-black);
            color: white;
            padding: 5rem 2rem 3rem;
            margin-top: 5rem;
        }

        .footer-container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 4rem;
            border-bottom: 1px solid #333;
            padding-bottom: 4rem;
        }

        .footer-logo {
            background-color: var(--cnn-red);
            color: white;
            font-weight: 900;
            font-size: 2rem;
            padding: 5px 15px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 2rem;
        }

        .footer-col h4 {
            color: #fff;
            text-transform: uppercase;
            margin-bottom: 2rem;
            font-size: 0.85rem;
            letter-spacing: 1.5px;
            font-weight: 900;
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 1rem;
        }

        .footer-col ul li a {
            color: #ccc;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .footer-col ul li a:hover {
            color: #fff;
            padding-left: 5px;
        }

        .footer-bottom {
            padding-top: 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .social-links {
            display: flex;
            gap: 2rem;
        }

        .social-links a {
            color: #ccc;
            font-size: 1.2rem;
            transition: var(--transition);
            text-decoration: none;
        }

        .social-links a:hover {
            color: var(--cnn-red);
            transform: translateY(-3px);
        }

        @media (max-width: 1024px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 3rem;
            }
        }

        @media (max-width: 600px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
            .footer-bottom {
                flex-direction: column;
                gap: 2rem;
                text-align: center;
            }
        }
    </style>
    
    <footer>
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-col" style="max-width: 400px;">
                    <a href="index.php" class="footer-logo">CNN</a>
                    <p style="color: #999; font-size: 0.95rem; line-height: 1.8; margin-top: 1rem;">
                        © 2026 Cable News Network. A Warner Bros. Discovery Company. All Rights Reserved. CNN Sans ™ & © 2026 Cable News Network.
                    </p>
                    <div class="social-links" style="margin-top: 2.5rem;">
                        <a href="#">FB</a>
                        <a href="#">TW</a>
                        <a href="#">IG</a>
                        <a href="#">YT</a>
                        <a href="#">LI</a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4>Sections</h4>
                    <ul>
                        <?php
                        foreach($footer_cats as $cat):
                        ?>
                        <li><a onclick="navigateTo('category.php?slug=<?php echo $cat['slug']; ?>')" style="cursor: pointer;"><?php echo $cat['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>About</h4>
                    <ul>
                        <li><a href="#">CNN Business</a></li>
                        <li><a href="#">CNN Health</a></li>
                        <li><a href="#">CNN Entertainment</a></li>
                        <li><a href="#">CNN Style</a></li>
                        <li><a href="#">CNN Travel</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">AdChoices</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">CNN Store</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div>
                    Developed by Irfan &bull; Project CNN Clone &bull; PHP & MySQL
                </div>
                <div>
                    Internal CSS Architecture &bull; JS Navigation Engine
                </div>
            </div>
        </div>
    </footer>
</body>
</html>


