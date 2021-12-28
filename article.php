<?php
	include_once("./php/article.php");
	$article = new article();
	if (!isset($_GET['a']) || !$article->isIdValid($_GET['a'])) {
		header('Location: /');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Articles</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?skin=desert"></script>

	<style>
		#article-feed {
			min-height: 700px;
			padding-top: 0px;
			display: inline-block;
			width: 100%;
		}
		article {
			display: block;
			margin: 0px auto;
			width: calc(90vw - 30px);
			min-width: 250px;
			background-color: white;
			max-width: 900px;
			padding: 15px;
			border-radius: 5px;
			color: #424242;
			line-height: 1.7;
		}
		p a {
                color: #5C6BC0;
                font-weight: 500;
        }
		blockquote {
			background-color: #F5F5F5;
			padding: 5px;
			padding-left: 15px;
			border-left: 4px solid #DDDDDD;
			margin: 5px;
			border-top-right-radius: 4px;
			border-bottom-right-radius: 4px;
		}
		.tag-box {
			font-size: 12px;
			font-weight: bold;
			margin-top: 15px;
			color: #757575;
		}
		.tag-box a:hover {
			color: #FDD835;
		}
	</style>
</head>
<body>
	<?php include_once("./include/header.php"); ?>
	<div id="article-feed">
		<article>
			<?php $article->showArticle($_GET['a']); ?>
		</article>
	</div>
</body>
</html>
