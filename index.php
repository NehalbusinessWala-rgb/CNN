<?php include 'header.php'; ?>

<style>
    .main-container {
        max-width: 1400px;
        margin: 2rem auto;
        padding: 0 2rem;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }

    /* Featured Big Card */
    .featured-card {
        cursor: pointer;
        position: relative;
        overflow: hidden;
        border-bottom: 2px solid var(--cnn-red);
    }

    .featured-img-wrapper {
        width: 100%;
        height: 500px;
        overflow: hidden;
    }

    .featured-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .featured-card:hover img {
        transform: scale(1.03);
    }

    .featured-content {
        padding: 1.5rem 0;
    }

    .featured-content h1 {
        font-size: 3rem;
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 1rem;
        transition: color 0.3s;
    }

    .featured-card:hover h1 {
        color: var(--cnn-red);
    }

    .featured-content p {
        font-size: 1.1rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Side Articles */
    .side-articles {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .side-article-card {
        display: flex;
        gap: 1rem;
        cursor: pointer;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--cnn-border);
    }

    .side-article-img {
        width: 120px;
        height: 80px;
        flex-shrink: 0;
    }

    .side-article-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .side-article-info h3 {
        font-size: 1.1rem;
        line-height: 1.3;
        font-weight: 700;
    }

    .side-article-info:hover h3 {
        color: var(--cnn-red);
    }

    /* More News Grid */
    .news-section-title {
        font-size: 1.5rem;
        font-weight: 900;
        border-bottom: 4px solid var(--cnn-black);
        padding-bottom: 5px;
        margin-bottom: 2rem;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: -1px;
    }

    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 3rem;
    }

    .news-card {
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        transform: translateY(-5px);
    }

    .news-card-img {
        width: 100%;
        height: 200px;
        margin-bottom: 1.2rem;
        overflow: hidden;
        border-radius: 4px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .news-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .news-card:hover .news-card-img img {
        transform: scale(1.1);
    }

    .news-card h3 {
        font-size: 1.15rem;
        line-height: 1.3;
        margin-bottom: 0.8rem;
        font-weight: 700;
    }

    .news-card:hover h3 {
        color: var(--cnn-red);
    }

    .news-card p {
        color: var(--text-muted);
        font-size: 0.9rem;
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .hero-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .featured-content h1 {
            font-size: 2rem;
        }
        .main-container {
            padding: 0 1rem;
        }
    }
</style>

<main class="main-container">
    <?php
    // Get Featured Article
    $featured_stmt = $conn->query("SELECT a.*, c.name as category_name FROM articles a JOIN categories c ON a.category_id = c.id WHERE a.is_featured = 1 LIMIT 1");
    $featured = $featured_stmt->fetch();

    // Get Side Articles
    $side_stmt = $conn->query("SELECT a.*, c.name as category_name FROM articles a JOIN categories c ON a.category_id = c.id WHERE a.is_featured = 0 AND a.is_breaking = 0 LIMIT 3");
    $side_news = $side_stmt->fetchAll();

    // Get More News
    $more_stmt = $conn->query("SELECT a.*, c.name as category_name FROM articles a JOIN categories c ON a.category_id = c.id WHERE a.is_featured = 0 ORDER BY a.published_at DESC LIMIT 6 OFFSET 3");
    $more_news = $more_stmt->fetchAll();
    ?>

    <div class="hero-grid">
        <!-- Featured Main -->
        <div class="featured-card" onclick="navigateTo('article.php?slug=<?php echo $featured['slug']; ?>')">
            <div class="featured-img-wrapper">
                <img src="<?php echo $featured['thumbnail']; ?>" alt="Featured">
            </div>
            <div class="featured-content">
                <h1><?php echo $featured['title']; ?></h1>
                <p><?php echo $featured['excerpt']; ?></p>
            </div>
        </div>

        <!-- Side Stories -->
        <div class="side-articles">
            <h2 class="news-section-title" style="border-color: var(--cnn-red); font-size: 1.1rem; margin-bottom: 1rem;">Top Stories</h2>
            <?php foreach($side_news as $news): ?>
            <div class="side-article-card" onclick="navigateTo('article.php?slug=<?php echo $news['slug']; ?>')">
                <div class="side-article-img">
                    <img src="<?php echo $news['thumbnail']; ?>" alt="News">
                </div>
                <div class="side-article-info">
                    <h3><?php echo $news['title']; ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- More News Section -->
    <h2 class="news-section-title">More Top Stories</h2>
    <div class="news-grid">
        <?php foreach($more_news as $news): ?>
        <div class="news-card" onclick="navigateTo('article.php?slug=<?php echo $news['slug']; ?>')">
            <div class="news-card-img">
                <img src="<?php echo $news['thumbnail']; ?>" alt="News">
            </div>
            <div class="tag" style="color: var(--cnn-red); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; margin-bottom: 5px;">
                <?php echo $news['category_name']; ?>
            </div>
            <h3><?php echo $news['title']; ?></h3>
            <p><?php echo $news['excerpt']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include 'footer.php'; ?>
