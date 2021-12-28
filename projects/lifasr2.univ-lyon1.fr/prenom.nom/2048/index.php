<!DOCTYPE html>
<html>
<head>
	<title>2048</title>

	<script src="js/jquery-3.2.1.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400" rel="stylesheet">

	<style>
		/*============================*/
		/*				reset 		  */
		/*============================*/
		body{
			background-color: white;
			margin: 0;
			overflow: hidden;
		}
		a{
			text-decoration: none;
			color: inherit;
		}
		/*============================*/
		/*			main 			  */
		/*============================*/
		#main{
			background-color: #FAF8EF;
			width: 75vw;
			max-width: 800px;
			min-width: 200px;
			margin: 0 auto;
			margin-top: 50vh;
			transform: translateY(-50%);
			display: flex;
			justify-content: space-around;
			padding: 25px;
			box-shadow: 0px 0px 5px rgba(0,0,0,0.2);
			height: 70vh;
		}
		#main h1{
			font-family: nunito;
			font-size: 35px;
			position: relative;
		}
		#score{
			position: fixed;
			z-index: 99;
			top: 0;
			left: 0;
			right: 0;
			margin: 0 auto;
			padding: 0px 15px;
			background-color: #907A65;
			color: white;
			font-family: nunito;
			font-size: 18px;
			width: 150px;
			text-align: center;
			border-bottom-right-radius: 4px;
			border-bottom-left-radius: 4px;
		}
		/*============================*/
		/*				left 	      */
		/*============================*/
		#main #left{
			width: 50%;
			font-family: roboto;
			color: #907A65;
			text-align: justify;
			line-height: 1.8;
			font-size: 13px;
			margin-right: 15px;
			position: relative;
		}
		/*barre d'action*/
		#jouer{
			background-color: #907A65;
			padding: 10px 40px;
			display: inline-block;
			color: white;
			font-weight: bold;
			border-radius: 3px;
			position: absolute;
			bottom: 0px;
			left: 0px;
		}
		#jouer:active{
			background-color: #816d5a;
		}
		/*============================*/
		/*				right 		  */
		/*============================*/
		#main #right{
			width: 100%;
			margin-left: 15px;
			cursor: default;
		}
		#grid{
			width: 400px;
			height: 400px;
			background-color: #BBAD9F;
			display: flex;
			justify-content: space-around;
			flex-wrap: wrap;
			margin: 15px auto;
			padding: 5px;
			border-radius: 4px;
			position: relative;
		}
		#endgame{
			background-color: rgba(0,0,0,0.5);
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			z-index: 100;
			text-align: center;
			font-family: nunito;
			color: white;
			font-size: 40px;
			line-height: 400px;
			border-radius: 4px;
		}
		.tile{
			width: calc(100px - 10px);
			height: calc(100px - 10px);
			display: block;
			background-color: #CCC0B2;
			margin: 5px;
			border-radius: 4px;
			text-align: center;
			line-height: calc(100px - 5px);
			font-size: 30px;
			font-weight: bold;
			font-family: nunito;
		}
		/*tile color*/
		._2{
			background-color: #EEE4D9;
			color: #907A65;
		}
		._4{
			background-color: #EDE0C7;
			color: #907A65;
		}
		._8{
			background-color: #F4B274;
			color: white;
		}
		._16{
			background-color: #F59563;
			color: white;
		}
		._32{
			background-color: #F87C5A;
			color: white;
		}
		._64{
			background-color: #F65E3B;
			color: white;
		}
		._128{
			background-color: #EDE0C8;
			color: #907A65;
		}
		._256{
			background-color: #EDCF72;
			color: white;
		}
		._512{
			background-color: #;
			color: white;
		}
		._1024{
			background-color: #EDC53F;
			color: white;
		}
		._2048{
			background-color: #EDC22E;
			color: white;
		}
		/*============================*/
		/*			responsive 		  */
		/*============================*/
		@media all and (max-width: 900px){
			body{
				overflow-y: auto;
			}
			#main{
				flex-wrap: wrap;
				height: auto;
				transform: translateY(0%);
				margin-top: 0vh;
				flex-direction: column-reverse;
				justify-content: center;
			}
			#main #left{
				width: 100%;
				margin: 0px;
			}
			#main #left h1{
				position: absolute;
				top: -540px;
				z-index: 99;
				left: 0px;
				right: 0px;
				text-align: center;
			}
			#main #jouer{
				position: relative;
				width: 100%;
				padding: 15px 0px;
				text-align: center;
			}
			#main #right{
				justify-content: space-around;
				margin: 0px;
				padding: 0px;
				margin-top: 80px;
			}
			#main #right #grid{
				margin: 25px auto;
			}
		}
	</style>
</head>
<body>
	<div id="score">
		score: 0
	</div>
	<div id="main">
		<div id="left">
			<h1>2048</h1>
			<p>
				Le but du jeu est de fusionner les cellules adjacentes de même valeur pour obtenir le score le plus élevé possible pour une case (plus grand que 2048).
			</p>
			<p>Ainsi, 2+2 = 4 & 4+4 = 8!</p>
			<p>
				Utilisez les touches directionelles de votre clavier pour jouer ;-)
			</p>

			<a href="#jouer" id="jouer">Jouer</a>

		</div>

		<div id="right">
			<div id="grid">
				<div class="tile _2">2</div>
				<div class="tile _2">2</div>
				<div class="tile _4">4</div>
				<div class="tile _4">4</div>

				<div class="tile _8">8</div>
				<div class="tile _32">32</div>
				<div class="tile _32">32</div>
				<div class="tile _8">8</div>

				<div class="tile _128">128</div>
				<div class="tile _1024">1024</div>
				<div class="tile _2048">2048</div>
				<div class="tile _512">512</div>

				<div class="tile _256">256</div>
				<div class="tile _64">64</div>
				<div class="tile _2048">2048</div>
				<div class="tile _1024">1024</div>
			</div>
		</div>
	</div>
	<script>
		var game_on = false
		var game_id = Date.now()

		$("#jouer").on("click", function(e){
			e.stopImmediatePropagation
			e.preventDefault

			$.post("fct/generate_grid.php", {"new_game":true, "id":game_id})
			.done(function(data){
				$("#grid").html(data);
			})
			game_on = true;

			return false
		})

		$(window).on("keydown", function(e){
			var key_nbr = e.which,
				key = "none";

			if(key_nbr === 38){
				key = "up"
			} else if(key_nbr === 39){
				key = "right"
			} else if(key_nbr === 40){
				key = "down"
			} else if(key_nbr === 37){
				key = "left"
			}

			if(game_on == true && key != "none"){
				$.post("fct/move_tile.php", {"move":key})
				.done(function(data){
					var data = JSON.parse(data)
					$("#grid").html(data["grid"])
					$("#score").html(data["score"])

					
				})
			}
		})
	</script>
</body>
</html>