<?php 
include 'header.php'; 

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
if (!$slug) {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}

// Fetch Category Details
$cat_stmt = $conn->prepare("SELECT * FROM categories WHERE slug = ?");
$cat_stmt->execute([$slug]);
$category = $cat_stmt->fetch();

if (!$category) {
    echo "<script>window.location.href = 'index.php';</script>";
    exit;
}

// Fetch Articles for this category
$articles_stmt = $conn->prepare("SELECT a.*, c.name as category_name FROM articles a JOIN categories c ON a.category_id = c.id WHERE c.slug = ? ORDER BY a.published_at DESC");
$articles_stmt->execute([$slug]);
$articles = $articles_stmt->fetchAll();
?>

<style>
    .cat-header {
        background-color: var(--cnn-light-gray);
        padding: 4rem 2rem;
        border-bottom: 2px solid var(--cnn-black);
        margin-bottom: 3rem;
    }

    .cat-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    .cat-header h1 {
        font-size: 4rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: -2px;
    }

    .articles-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 3rem;
    }

    .article-item {
        cursor: pointer;
        display: flex;
        flex-direction: column;
    }

    .article-item-img {
        width: 100%;
        height: 240px;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .article-item-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .article-item:hover .article-item-img img {
        transform: scale(1.05);
    }

    .article-item h2 {
        font-size: 1.8rem;
        line-height: 1.2;
        margin-bottom: 1rem;
        font-weight: 900;
    }

    .article-item:hover h2 {
        color: var(--cnn-red);
    }

    .article-item p {
        color: var(--text-muted);
        line-height: 1.6;
        font-size: 1rem;
    }

    .empty-state {
        text-align: center;
        padding: 5rem 0;
        color: var(--text-muted);
    }

    @media (max-width: 768px) {
        .cat-header h1 {
            font-size: 2.5rem;
        }
    }
</style>

<div class="cat-header">
    <div class="cat-container">
        <h1><?php echo $category['name']; ?></h1>
    </div>
</div>

<main class="cat-container" style="padding: 0 2rem;">
    <?php if (empty($articles)): ?>
        <div class="empty-state">
            <h2>No articles found in this category.</h2>
            <p>Check back later for more updates.</p>
        </div>
    <?php else: ?>
        <div class="articles-list">
            <?php foreach($articles as $article): ?>
            <div class="article-item" onclick="navigateTo('article.php?slug=<?php echo $article['slug']; ?>')">
                <div class="article-item-img">
                    <img src="<?php echo $article['thumbnail']; ?>" alt="<?php echo $article['title']; ?>">
                </div>
                <h2><?php echo $article['title']; ?></h2>
                <p><?php echo $article['excerpt']; ?></p>
                <div style="margin-top: 1rem; font-size: 0.8rem; color: #888; font-weight: 700; text-transform: uppercase;">
                    <?php echo formatDate($article['published_at']); ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>

<?php include 'footer.php'; ?>
