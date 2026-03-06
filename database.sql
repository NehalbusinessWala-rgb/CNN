CREATE DATABASE IF NOT EXISTS rsoa_rsoa324_03;
USE rsoa_rsoa324_03;

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT,
    thumbnail VARCHAR(255),
    author VARCHAR(100) DEFAULT 'CNN News Staff',
    published_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_breaking BOOLEAN DEFAULT FALSE,
    is_featured BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

-- Insert Categories
INSERT INTO categories (name, slug) VALUES 
('World', 'world'),
('Sports', 'sports'),
('Technology', 'technology'),
('Entertainment', 'entertainment'),
('Politics', 'politics'),
('Health', 'health');

-- Insert Sample Articles
INSERT INTO articles (category_id, title, slug, excerpt, content, thumbnail, is_breaking, is_featured) VALUES 
(1, 'Global Summit Addresses Climate Emergency', 'global-summit-climate', 'World leaders gather to discuss urgent actions to combat rising temperatures.', 'The 2026 Global Climate Summit opened today with a stark warning from scientists: immediate action is required to prevent irreversible damage. Delegates from over 190 nations are meeting to negotiate new emission targets and financial aid for developing countries.', 'https://picsum.photos/800/600?random=1', TRUE, TRUE),
(2, 'Record-Breaking Performance in Grand Prix', 'grand-prix-record', 'A historic win at the Monaco Grand Prix as the rookie driver takes the podium.', 'In a stunning upset, 19-year-old Leo Vasseur secured his first Formula 1 victory today at the Monaco Grand Prix. The weather conditions were challenging, but Vasseur maintained control throughout the 78 laps, finishing 3 seconds ahead of the reigning champion.', 'https://picsum.photos/400/300?random=2', FALSE, FALSE),
(3, 'AI Breakthrough: Neural Links for Everyone?', 'ai-breakthrough-neural', 'A new startup claims to have perfected safe, non-invasive neural interfaces.', 'The Silicon Valley tech giant "NeuralSync" revealed their latest product today: a wearable headband that claims to translate thoughts into text with 98% accuracy. Industry experts are both excited and cautious about the privacy implications of such technology.', 'https://picsum.photos/400/300?random=3', FALSE, FALSE),
(4, 'Oscars 2026: The Full List of Winners', 'oscars-2026-winners', 'See who took home the golden statuette in this years spectacular ceremony.', 'The 98th Academy Awards celebrated the best in cinema last night. "The Echoes of Time" won Best Picture, while Maria Gonzalez took home Best Actress for her performance in the historical drama "Silenced Voices."', 'https://picsum.photos/400/300?random=4', FALSE, FALSE),
(1, 'New Trade Agreement Signed Between Major Economies', 'trade-agreement-signed', 'A landmark deal aims to reduce tariffs and boost international trade.', 'Economies across three continents have signed a comprehensive trade agreement aimed at stabilizing global markets. The deal focuses on green energy products and digital services, promising to create millions of jobs over the next decade.', 'https://picsum.photos/400/300?random=5', FALSE, FALSE),
(5, 'Election Results: A Shift in Political Landscape', 'election-results-shift', 'Early counts suggest a significant change in the majority of the parliament.', 'With 80% of the votes counted, the Progressive Alliance seems poised to take control. The projected victory marks a historic shift in national politics, with a strong focus on social welfare and infrastructure development.', 'https://picsum.photos/400/300?random=6', TRUE, FALSE),
(3, 'SpaceX Successfully Lands Starship on Mars', 'starship-mars-landing', 'A historic milestone for humanity as the first uncrewed Starship touches down on the Red Planet.', 'Elon Musks SpaceX has achieved what was once thought impossible: landing a Starship on the surface of Mars. The mission, although uncrewed, carries essential supplies and equipment for future human missions slated for 2029.', 'https://picsum.photos/400/300?random=7', FALSE, FALSE),
(2, 'NBA Finals: Underdogs Take Game 1', 'nba-finals-game1', 'The Miami Heat stun the Lakers in a high-scoring opener to the finals.', 'In a game that kept fans on the edge of their seats, the Miami Heat secured a 115-112 victory over the Los Angeles Lakers. Jimmy Butler led the scoring with 34 points, while the Lakers struggled with turnovers late in the fourth quarter.', 'https://picsum.photos/400/300?random=8', FALSE, FALSE),
(4, 'New Pop Sensation Topps Global Charts', 'pop-sensation-charts', '17-year-old artist from London becomes the youngest to reach number one.', 'The music world has a new star. "Echo," the debut single by Luna Ray, has surged to the top of the global charts within just 48 hours of its release. Critics are praising her unique sound and powerful vocals.', 'https://picsum.photos/400/300?random=9', FALSE, FALSE),
(6, 'Breakthrough in Alzheimer Research announced', 'alzheimer-research-breakthrough', 'New drug shows 40% reduction in cognitive decline during late-stage trials.', 'Researchers at Oxford University have announced a major breakthrough in the fight against Alzheimer. A new experimental drug, "Memora," has shown significant promise in clinical trials, offering hope to millions affected by the disease.', 'https://picsum.photos/400/300?random=10', FALSE, FALSE);

