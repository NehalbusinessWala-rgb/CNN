<?php 
include 'header.php'; 

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
if (!$slug) {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}

// Fetch Article Details
$stmt = $conn->prepare("SELECT a.*, c.name as category_name, c.slug as category_slug FROM articles a JOIN categories c ON a.category_id = c.id WHERE a.slug = ?");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}

// Fetch Related Articles (same category, excluding current)
$related_stmt = $conn->prepare("SELECT * FROM articles WHERE category_id = ? AND id != ? LIMIT 3");
$related_stmt->execute([$article['category_id'], $article['id']]);
$related_news = $related_stmt->fetchAll();
?>

<style>
    .article-container {
        max-width: 900px;
        margin: 4rem auto;
        padding: 0 2rem;
    }

    .article-meta {
        margin-bottom: 2rem;
    }

    .article-meta .cat-tag {
        color: var(--cnn-red);
        font-weight: 900;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
        cursor: pointer;
    }

    .article-meta h1 {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1.1;
        margin: 1rem 0;
    }

    .article-author-info {
        display: flex;
        align-items: center;
        gap: 15px;
        color: var(--text-muted);
        font-size: 0.9rem;
        border-top: 1px solid var(--cnn-border);
        border-bottom: 1px solid var(--cnn-border);
        padding: 1rem 0;
        margin: 2rem 0;
    }

    .author-img {
        width: 40px;
        height: 40px;
        background: #eee;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .main-article-img {
        width: 100%;
        margin-bottom: 3rem;
    }

    .main-article-img img {
        width: 100%;
        height: auto;
        border-radius: 4px;
    }

    .article-body {
        font-size: 1.25rem;
        line-height: 1.8;
        color: #222;
    }

    .article-body p {
        margin-bottom: 1.5rem;
    }

    /* Related News Section */
    .related-section {
        margin-top: 5rem;
        border-top: 4px solid var(--cnn-black);
        padding-top: 3rem;
    }

    .related-title {
        font-size: 1.5rem;
        font-weight: 900;
        text-transform: uppercase;
        margin-bottom: 2rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .related-card {
        cursor: pointer;
    }

    .related-card-img {
        width: 100%;
        height: 150px;
        margin-bottom: 1rem;
    }

    .related-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .related-card h4 {
        font-size: 1.1rem;
        line-height: 1.3;
    }

    .related-card:hover h4 {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .article-meta h1 {
            font-size: 2.2rem;
        }
        .article-body {
            font-size: 1.1rem;
        }
    }
</style>

<main class="article-container">
    <div class="article-meta">
        <span class="cat-tag" onclick="navigateTo('category.php?slug=<?php echo $article['category_slug']; ?>')">
            <?php echo $article['category_name']; ?>
        </span>
        <h1><?php echo $article['title']; ?></h1>
        <p style="font-size: 1.3rem; color: var(--text-muted); line-height: 1.5;">
            <?php echo $article['excerpt']; ?>
        </p>
    </div>

    <div class="article-author-info">
        <div class="author-img">C</div>
        <div>
            <div style="color: #000; font-weight: 700;">By <?php echo $article['author']; ?></div>
            <div>Published <?php echo formatDate($article['published_at']); ?></div>
        </div>
    </div>

    <div class="main-article-img">
        <img src="<?php echo $article['thumbnail']; ?>" alt="Article Image">
    </div>

    <article class="article-body">
        <?php echo nl2br($article['content']); ?>
        
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        
        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

        <div style="background: #f4f4f4; padding: 2rem; border-left: 5px solid var(--cnn-red); margin: 3rem 0; font-style: italic;">
            "This development represents a major turning point in how we view global events," says an industry expert who wished to remain anonymous.
        </div>

        <p>Stay tuned to CNN for more updates on this developing story as it unfolds. Our team of reporters is on the ground bringing you the latest information.</p>
    </article>

    <?php if (!empty($related_news)): ?>
    <div class="related-section">
        <h2 class="related-title">Related News</h2>
        <div class="related-grid">
            <?php foreach($related_news as $related): ?>
            <div class="related-card" onclick="navigateTo('article.php?slug=<?php echo $related['slug']; ?>')">
                <div class="related-card-img">
                    <img src="<?php echo $related['thumbnail']; ?>" alt="Related">
                </div>
                <h4><?php echo $related['title']; ?></h4>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
