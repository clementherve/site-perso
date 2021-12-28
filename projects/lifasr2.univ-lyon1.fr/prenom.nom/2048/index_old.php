<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>2048</title>

	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400" rel="stylesheet">

	<style>
		body{
			margin: 0;
			padding: 0;
			background-color: #546E7A;
			position: relative;
			display: inline-block;
			width: 100vw;
			height: 100vh;
			overflow: hidden;
			cursor: default;
		}
		a{
			text-decoration: none;
		}
		#darker{
			position: absolute;
			z-index: 50;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: rgba(0,0,0,0.3);
		}
		#intro{
			width: 80vw;
			height: 250px;
			background-color: white;
			color: #424242;
			font-family: roboto;
			text-align: justify;
			padding: 15px;
			margin: 0 auto;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			z-index: 70;
			margin-top: calc(50vh - 125px);
		}
		#intro h2{
			text-align: center;
		}
		#intro .button{
			padding: 10px 25px;
			background-color: #FF7043;
			font-family: roboto;
			color: white;
			font-weight: bold;
			box-shadow: 1px 1px 2px rgba(0,0,0,0.2);
			float: right;
			margin-top: 12px;
			font-size: 14px;
			cursor: pointer;
		}
		h1{
			color: #78909C;
			font-family: nunito;
			position: absolute;
			top: 50px;
			left: 100px;
			margin: 0;
			font-size: 65px;
			font-weight: normal;
		}
		#grid{
			width: 400px;
			height: 400px;
			background-color: white;
			margin: 0 auto;
			margin-top: calc(50vh - 200px);
			display: flex;
			flex-wrap: wrap;
			box-shadow: 2px 2px 2px rgba(0,0,0,0.4);
		}
		.tile{
			width: calc((400px - 8px)/ 4);
			height: calc((400px - 8px)/ 4);
			background-color: #FF7043;
			display: block;
			margin: 1px;
			cursor: pointer;
		}
	</style>

	<script src="js/jquery-3.2.1.min.js"></script>

</head>
<body>

	<div id="darker"></div>
	<div id="intro">
		<h2>Bienvenue !</h2>
		<h4>Règles du jeu</h4>
		<p>
			Le but est de fusionner les cellules adjacentes de même valeur pour obtenir le score le plus élevé possible (>2048).
		</p>
		<p>
			Utilisez les touches directionelles de votre clavier pour jouer !
		</p>
		<a href="#" class="button">jouer</a>
	</div>
	<h1>2048</h1>
	<div id="grid">
		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>

		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>

		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>

		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>
		<div class="tile"></div>
	</div>

</body>

<script>
	if(localStorage.play){
		$("#intro").fadeOut()
		$("#darker").fadeOut()
	}
	$("#intro .button").on("click", function(){
		$("#intro").fadeOut(350)
		$("#darker").fadeOut(250)
		localStorage.play = true
	})

	$(window).on("keydown", function(e){
		if(localStorage.play){
			var key_nbr = e.which
			if(key_nbr === 38){
				var key = "up"
			} else if(key_nbr === 39){
				var key = "right"
			} else if(key_nbr === 40){
				var key = "down"
			} else if(key_nbr === 37){
				var key = "left"
			}
		}
	})
</script>
</html>