<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Projets personnels</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/header.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style>
		#article-feed {
			min-height: 700px;
			padding-top: 50px;
			padding-bottom: 20px;
			background-color: #F5F5F5;
			display: block;
			width: 100%;
			position: relative;
			z-index: 1000;
		}
		.article {
			display: block;
			margin: 40px auto;
			width: calc(90vw - 30px);
			min-width: 250px;
			max-width: 800px;
			background-color: white;
			padding: 15px;
			border-radius: 5px;
			color: #424242;
		}
		.article h3:hover {
			color: #FDD835;
		}
		.article h3 {
			margin: 10px 0px;
		}
		.article .tag-box {
			font-size: 12px;
			font-weight: bold;
			margin-top: 15px;
			color: #757575;
		}
		.article .tag-box a:hover {
			color: #FDD835;
		}
		.article p {
			font-size: 17px;
			line-height: 1.8;
		}
	</style>
</head>
<body>
	<?php include_once("../include/header.php"); ?>
	<div id="article-feed">
	<?php
		$list = scandir(".");

		foreach ($list as $path){
			if ($path != "." && $path != ".." && $path != "index.php") {
				if (file_exists($path."/readme.txt")) {
					$readme = file_get_contents($path."/readme.txt");
				} else {
					$readme = "Pas de description disponible";
				}
				echo "<div class='article'>
					<a href='/projects/".$path."/'><h3>".$path."</h3></a>
						<p>".$readme."</p>
					</div>";

			}
		}
	?>
	</div>
</body>
</html>
