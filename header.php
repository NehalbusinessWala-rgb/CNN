<?php include 'db_config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CNN Clone | Breaking News, Latest News and Videos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --cnn-red: #cc0000;
            --cnn-black: #000000;
            --cnn-dark-gray: #1a1a1a;
            --cnn-gray: #404040;
            --cnn-light-gray: #f2f2f2;
            --cnn-border: #e2e2e2;
            --text-main: #222222;
            --text-muted: #555555;
            --shadow: 0 4px 12px rgba(0,0,0,0.08);
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: white;
            color: var(--text-main);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Top Bar for User & Date */
        .top-bar {
            background: #fff;
            padding: 8px 2rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            font-size: 13px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--cnn-border);
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: var(--cnn-light-gray);
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 700;
            color: var(--cnn-black);
        }

        /* Navigation */
        nav {
            background-color: var(--cnn-black);
            color: white;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 50px;
        }

        .logo {
            background-color: var(--cnn-red);
            color: white;
            font-weight: 900;
            font-size: 2.2rem;
            padding: 0 12px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            transition: var(--transition);
        }

        .logo:hover {
            opacity: 0.9;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
            height: 100%;
        }

        .nav-links li {
            height: 100%;
            display: flex;
            align-items: center;
        }

        .nav-links li a {
            color: #fff;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: var(--transition);
            cursor: pointer;
            padding: 0 5px;
            position: relative;
        }

        .nav-links li a::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 0;
            height: 4px;
            background: var(--cnn-red);
            transition: var(--transition);
        }

        .nav-links li a:hover::after {
            width: 100%;
        }

        .search-icon {
            cursor: pointer;
            font-size: 1.2rem;
            opacity: 0.8;
            transition: var(--transition);
        }

        .search-icon:hover {
            opacity: 1;
        }

        /* Breaking News Ticker */
        .breaking-ticker {
            background: #fff;
            border-bottom: 2px solid var(--cnn-border);
            padding: 12px 2rem;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
        }

        .breaking-label {
            background: var(--cnn-red);
            color: white;
            padding: 2px 10px;
            font-weight: 900;
            font-size: 11px;
            text-transform: uppercase;
            white-space: nowrap;
            letter-spacing: 1px;
        }

        .breaking-content {
            color: var(--cnn-black);
            font-weight: 700;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: color 0.3s;
        }

        .breaking-content:hover {
            color: var(--cnn-red);
        }

        /* Utility Classes */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Responsive Mobile Nav */
        @media (max-width: 900px) {
            .nav-links {
                display: none;
            }
            .top-bar {
                display: none;
            }
        }
    </style>
    <script>
        // Redirect function using JS as requested
        function navigateTo(url) {
            // Simple animation before redirect
            document.body.style.opacity = '0.5';
            setTimeout(() => {
                window.location.href = url;
            }, 100);
        }
    </script>
</head>
<body>
    <div class="top-bar">
        <div style="margin-right: auto;"><?php echo date('l, F j, Y'); ?></div>
        <div class="user-pill">
            <span style="font-size: 10px; text-transform: uppercase; opacity: 0.6;">Welcome back,</span>
            <span>Irfan</span>
        </div>
    </div>
    <nav>
        <div class="nav-container">
            <div style="display: flex; align-items: center; height: 100%; gap: 30px;">
                <a href="index.php" class="logo" onclick="event.preventDefault(); navigateTo('index.php')">CNN</a>
                <ul class="nav-links">
                    <?php
                    $categories = getCategories($conn);
                    foreach($categories as $cat):
                    ?>
                    <li><a onclick="navigateTo('category.php?slug=<?php echo $cat['slug']; ?>')"><?php echo $cat['name']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div style="display: flex; align-items: center; gap: 20px;">
                <span class="search-icon">🔍</span>
                <div style="width: 1px; height: 20px; background: rgba(255,255,255,0.2);"></div>
                <div style="font-weight: 900; font-size: 0.8rem; cursor: pointer;">LIVE TV</div>
            </div>
        </div>
    </nav>


    <?php
    // Fetch one breaking news for the ticker
    $breaking_stmt = $conn->query("SELECT title, slug FROM articles WHERE is_breaking = 1 LIMIT 1");
    $breaking_news = $breaking_stmt->fetch();
    if ($breaking_news):
    ?>
    <div class="breaking-ticker">
        <span class="breaking-label">Breaking News</span>
        <span class="breaking-content" style="cursor: pointer;" onclick="navigateTo('article.php?slug=<?php echo $breaking_news['slug']; ?>')">
            <?php echo $breaking_news['title']; ?>
        </span>
    </div>
    <?php endif; ?>
