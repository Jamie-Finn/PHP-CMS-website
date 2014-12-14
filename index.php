<?php

include_once('includes/connection.php');	
include_once('includes/article.php');	

$article = new article;
$articles = $article->fetch_all();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CMS</title>
		<link rel="stylesheet" href="assets/main.css">
	</head>
	<body>
		<div class="container">
			<a href="index.php" id="logo">CMS</a>

			<ol>
				<?php foreach($articles as $article): ?>
					<li>
						<a href="article.php?id=<?php echo $article['article_id']; ?>">
							<?php echo $article['article_title']; ?>
						</a> 
						- <small>
							posted <?php echo date('l jS', $article['article_timestamp']); ?>
						</small>
					</li>
				<?php endforeach; ?>
			</ol>

			<br/>

			<small><a href="/admin/">Admin</a></small>
		</div>
	</body>
</html>