<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Social Network</title>

	<!--polices-->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">

	<meta name="viewport" content="width = device-width, initial-scale=1.0">

	<!--icones-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--flemme.js-->
	<script src="js/jquery-3.2.1.min.js"></script>

	<style>
		/*==================================*/
		/*				reset				*/
		/*==================================*/
		body{
			margin: 0;
			background-color: #e9e9e9;
		}
		a{
			text-decoration: none;
			outline: none;
			border: 0;
		}
		input::-moz-focus-inner {
		    border: 0;
		}
		input{
			outline: none;
			border: 0px;
		}
		img{
			width: 50%;
			margin: 0 auto;
			display: block;
			cursor: pointer;
			top: 90px;
			left: 0;
			bottom: 0;
			right: 0;
			z-index: 90;
		}
		/*==================================*/
		/*				header				*/
		/*==================================*/
		header{
			background-color: #1e89d1;
			height: 50px;
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			width: 100vw;
			box-shadow: 0px 2px 2px rgba(0,0,0,0.2);
			z-index: 100;
		}
		header i{
			color: white;
			margin-top: 13px;
			margin-left: 15px;
			display: block;
			cursor: pointer;
		}
		/*==================================*/
		/*				notif				*/
		/*==================================*/
		#notif{
			position: fixed;
			margin: 0 auto;
			width: 40%;
			left: 0;
			right: 0;

			display: block;
			min-width: 200px;
			max-height: 40px;
			bottom: -90px;
			background-color: #1e89d1;
			box-shadow: 0px 0px 7px rgba(0,0,0,0.2);
			padding: 15px 7px;
			font-family: roboto;
			color: white;
			font-size: 14px;
			text-align: center;
			z-index: 50;
			border-radius: 2px;
			transition: all 250ms;
		}
		/*==================================*/
		/*				  fab				*/
		/*==================================*/
		#fab{
			position: fixed;
			bottom: -80px;
			right: 15px;
			height: 45px;
			width: 45px;
			background-color: #1e89d1;
			border-radius: 45px;
			box-shadow: 2px 2px 2px rgba(0,0,0,0.2);
			text-align: center;
			cursor: pointer;
			z-index: 35;
			transition: all 350ms ease-in-out;
		}
		#fab i{
			color: white;
			line-height: 45px;
			font-size: 20px;
		}
		/*==================================*/
		/*				darker				*/
		/*==================================*/
		#darker{
			position: fixed;
			bottom: 0;
			right: 0;
			left: 0;
			top: 0;
			width: 100vw;
			height: 100vh;
			background-color: rgba(0,0,0,0.3);
			z-index: 80;
			visibility: hidden;
		}
		/*==================================*/
		/*				menu				*/
		/*==================================*/
		.menu{
			position: fixed;
			z-index: 25;
			background-color: white;
			box-shadow: 0px 2px 2px rgba(0,0,0,0.3);
			height: 100vh;
			left: 0px;
			top: 50px;
			padding: 15px 0px;
			bottom: 0;
			width: 250px;
			transition: all 350ms ease-in-out;
		}
		.menu h3{
			text-align: center;
			font-family: raleway;
			font-weight: 500;
			color: #424242;
			padding: 25px 0px;
			font-size: 23px;
		}
		.menu input[type=submit]{
			width: 50%;
			padding: 10px 0px;
			background-color: #1e89d1;
			box-shadow: 2px 2px 2px rgba(0,0,0,0.3);
			margin: 50px auto;
			display: block;
			border: none;
			outline: none;
			font-family: roboto;
			font-size: 14px;
			text-transform: uppercase;
			color: white;
			cursor: pointer;
		}
		.menu input[type=submit]:active{
			box-shadow: 1px 1px 1px rgba(0,0,0,0.2);
		}
		.menu #nbr_message{
			width: 80%;
			border: 1px solid #424242;
			outline: none;
			color: #424242;
			font-family: roboto;
			font-size: 14px;
			margin: 25px auto;
			display: block;
			padding: 5px;
		}
		/*toggle*/
		.menu .toggle_box{
			display: block;
			margin: 15px;
			font-family: roboto;
			font-size: 14px;
			color: #424242;
		}
		.menu input[type=checkbox]{
			display: none;
		}
		.menu .toggle{
			width: 22px;
			background-color: #E0E0E0;
			height: 5px;
			display: inline-block;
			margin: 2px 5px;
			margin-right: 15px;
			border-radius: 4px;
			position: relative;
			cursor: pointer;
		}
		.menu .toggle:after{
			content: "";
			display: block;
			position: absolute;
			height: 11px;
			width: 11px;
			top: -3px;
			left: -3px;
			border-radius: 10px;
			background-color: #9E9E9E;
			box-shadow: 0px 0px 4px rgba(0,0,0,0.2);
		}
		.menu input[type=checkbox]:checked + .toggle:after{
			left: 15px;
			background-color: #1e89d1;
		}

		/*==================================*/
		/*				contenu				*/
		/*==================================*/
		.contenu{
			margin-left: 250px;
			padding-top: 50px;
			transition: all 350ms ease-in-out;
		}
		.contenu h1{
			font-family: raleway;
			color: #424242;
			text-align: center;
			font-weight: 500;
			font-size: 27px;
			margin: 60px 0px;
			text-transform: capitalize;
		}
		.contenu i{
			font-family: raleway;
			color: #424242;
			font-size: 15px;
		}
		/*==================================*/
		/*			nouveau message			*/
		/*==================================*/
		.nouveau_post{
			width: 80%;
			max-width: 800px;
			min-width: 250px;
			box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
			margin: 25px auto;
			margin-bottom: 80px;
			padding: 15px;
			background-color: white;
			font-family: roboto;
		}
		.nouveau_post textarea{
			width: calc(100% - 20px);
			border: none;
			outline: none;
			resize: vertical;
			min-height: 150px;
			font-family: roboto;
			padding: 10px;
			border-bottom: 1px solid #1e89d1;
		}
		.nouveau_post input[type=file]{
			margin: 15px auto;
			display: block;
			font-family: roboto;
			color: #424242;
			cursor: pointer;
		}
		.nouveau_post input[type=submit]{
			width: 100%;
			padding: 15px 0px;
			background-color: transparent;
			outline: none;
			border: none;
			cursor: pointer;
			font-family: roboto;
			background-color: #1e89d1;
			color: white;
			text-transform: uppercase;
			font-size: 13px;
			transition: all 350ms;
		}
		.nouveau_post input[type=submit]:active{
			background-color: #1a76b3;
		}
		/*==================================*/
		/*		affichage des messages		*/
		/*==================================*/
		.message{
			width: 80%;
			max-width: 800px;
			min-width: 250px;
			box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
			margin: 50px auto;
			padding: 15px;
			background-color: white;
			font-family: roboto;
			position: relative;
		}
		/*auteur*/
		.message h3{
			font-family: raleway;
			font-weight: 500;
			color: #424242;
			text-transform: capitalize;
		}
		/*date*/
		.message h4{
			font-weight: normal;
			font-size: 13px;
			font-style: italic;
		}
		/*contenu*/
		.message p{
			line-height: 1.7;
			text-align: justify;
			font-size: 15px;
		}
		.message #warning{
			text-align: center;
			display: block;
			margin: 15px auto;
			color: red;
			font-size: 12px;
			font-family: roboto;
		}
		/*aimer une publication*/
		.aimer{
			position: absolute;
			background-color: #1e89d1;
			color: white;
			top: 15px;
			right: 15px;
			cursor: pointer;
			border-radius: 40px;
			height: 40px;
			width: 40px;
			overflow: hidden;
			text-align: center;
		}
		.aimer .count{
			display: block;
			padding: 10px 0px;
			transition: all 250ms;
		}
		.aimer i{
			font-size: 20px;
			text-align: center;
			display: block;
			margin-top: -19px;
			transition: all 250ms;
			color: white;
		}
		.aimer:hover i{
			margin-top: 10px;
		}
		/*commenter une publication*/
		.zone_commentaire{
			width: 100%;
			display: flex;
			border: 1px solid #e9e9e9;
		}
		.zone_commentaire input[type=text]{
			width: 70%;
			border: none;
			outline: none;
			padding: 5px;
			font-family: roboto;
			font-size: 14px;
			color: #424242;
			resize: vertical;
			min-height: 30px;
			max-height: 110px;
		}
		.zone_commentaire input[type=submit]{
			border: none;
			outline: none;
			padding: 5px 2px;
			font-family: roboto;
			font-size: 11px;
			color: #424242;
			display: block;
			width: 30%;
			color: #424242;
			cursor: pointer;
			background-color: #e9e9e9;
			text-transform: uppercase;
		}
		/*commentaires imbriqués*/
		.msg_com{
			border-left: 2px solid #1e89d1;
			margin-left: 10%;
			padding-left: 15px;
			display: block;
			margin-bottom: 20px;
			margin-top: 20px;
			position: relative;
		}
		.msg_com .nbr_likes{
			position: absolute;
			left: -30px;
			width: 30px;
			height: 25px;
			line-height: 25px;
			text-align: center;
			top: 0px;
			bottom: 0px;
			background-color: #1e89d1;
			color: white;
			font-family: raleway;
			font-size: 13px;
			cursor: default;
		}
		.msg_com h5{
			font-family: raleway;
			text-transform: capitalize;
			font-weight: bold;
			margin: 8px 0px 8px -5px;
			padding: 0px;
			font-size: 13px;
		}
		.msg_com p{
			margin: 0px;
			font-family: roboto;
			font-size: 12px;
			max-width: 85%;
		}
		/*******************************/
		/*		MEDIA QUERIES		   */
		/*******************************/
		@media all and (max-width: 800px){
			.menu{
				left: -250px;
			}
			.contenu{
				margin-left: 0px;
			}
			.zone_commentaire input[type=submit]{
				font-size: 10px;
			}
			.msg_com h5{
				font-size: 12px;
			}
			.msg_com .nbr_likes{
				height: 20px;
				width: 30px;
				line-height: 20px;
				font-size: 11px;
				right: -15px;
				left: auto;
			}
		}
		@media all and (max-width: 500px){
			.msg_com{
				margin-left: 0%;
			}
		}
		@media all and (min-width: 800px){
			.menu{
				left: 0px;
			}
			.contenu{
				margin-left: 250px;
			}
		}
	</style>
</head>
<body>

	<header>
		<i class="material-icons" id="menu">&#xE5D2;</i>
	</header>

	<div id="notif"></div>
	<div id="fab"><i class="material-icons">replay</i></div>

	<div class="menu">
		<h3>Tri de l'affichage</h3>
		<form method="POST" action="tri.php" id="tri_posts">
			<label class="toggle_box">
				<input type="checkbox" name="img" id="img" checked>
				<label class="toggle" for="img"></label>
				images
			</label>

			<label class="toggle_box">
				<input type="checkbox" name="msg" id="msg" checked>
				<label class="toggle" for="msg"></label>
				messages
			</label>

			<label class="toggle_box">
				<input type="checkbox" name="com" id="com">
				<label class="toggle" for="com"></label>
				commentaires
			</label>

			<label class="toggle_box">
				<input type="checkbox" name="strict" id="strict">
				<label class="toggle" for="strict"></label>
				mode strict
			</label>

			<select name="nbr_message" id="nbr_message">
				<option disabled>Nombre de posts</option>
				<option>1</option>
				<option selected>5</option>
				<option>10</option>
				<option>25</option>
				<option>50</option>
				<option>all</option>
			</select>

			<input type="submit" value="trier">
		</form>
	</div>
	<div class="contenu">
		<h1>Bienvenue</h1>
		<div class="nouveau_post">
			<form method="POST" action="poster.php" enctype="multipart/form-data" id="poster_message">
				<input type="hidden" id="nom_prenom" value="clement.herve" name="nom">
				<textarea placeholder="Ecrivez quelque chose..." id="contenu_post" name="message"></textarea>
				<input type="hidden" name="MAX_FILE_SIZE" value="250000" />
				<input type="file" name="media" id="media">
				<input type="submit" value="poster">
			</form>
		</div>
		<div class="affiche_post"></div>
	</div>
	<script>
		//is the tab active?
		var isActive = true
		var new_post_count = 0

		//grab user's name
		var name = "prenom.nom"
		$("#nom_prenom").val(name)
		$("h1").html("Bienvenue, "+name.replace(/\.[a-z]*/g, "").replace("e", "é"))

		localStorage.username = name
		localStorage.longPollingSuspend = "false"

		//sliding menu
		$("#menu").on("click", function(){
			if($(".menu").css("left") === "-250px"){
				$(".menu").css({"left": "0px"})
				if(window.innerWidth > 800){
					$(".contenu").css({"margin-left": "250px"})
				}
			} else {
				$(".menu").css({"left": "-250px"})
				$(".contenu").css({"margin-left": "0px"})
			}
		})

		//send new post
		$("#poster_message").on("submit", function(e){
			e.preventDefault()
			e.stopImmediatePropagation()
			var formData = new FormData($(this)[0])
	        $.ajax({
	            url: "fct/ajouter_post.php",
	            type: "POST",
	            data: formData,
	            async: false,
	            cache: false,
	            contentType: false,
	            processData: false
	        })
	        .always(function(data){
				$("#notif").css({"bottom":"25px"}).html(data)
				if(data.indexOf("success") != -1){
					$("#contenu_post").val("")
					$("#media").wrap('<form>').closest('form').get(0).reset()
		 			$("#media").unwrap()
				}
				window.setTimeout(function(){
					$("#notif").css({"bottom":"-90px"}).html("")
				}, 2500)
			})
			return false
		})

		//Prevent media from being reloaded
		$("#media").wrap('<form>').closest('form').get(0).reset();
		 $("#media").unwrap();

		//ajax sorting
		$("#tri_posts").on("submit", function(e){
			e.preventDefault()
			e.stopImmediatePropagation()
			get_post()
			return false
		})
		$(".toggle_box").on("click", function(){
			get_post()
		})
		get_post()


		//Long polling
		function check_new_post(){
			$.ajax({url:"fct/verifier_nouv_post.php", method:"POST", complete: check_new_post})
	    	.done(function(data){
	    		if(/*Number(data) === 1*/ Number(data) != 0){
					get_post()
					if(!isActive){
						new_post_count += Number(data)
    					$("title").html("("+new_post_count+") Social Network")
					}
				}
	    	})
		}
		check_new_post();


		//get posts according to user's criterias
		function get_post(){
			var msg = $("#msg").is(":checked"),
				img = $("#img").is(":checked"),
				com = $("#com").is(":checked"),
				nbr = $("#nbr_message").val()
			//type
			if (msg && !img && !com){
				type = "msg"
			} else if (!msg && img && !com){
				type = "img"
			} else if (!msg && !img && com){
				type = "com"
			} else if (msg && !img && com){
				type = "noimg"
			} else if (msg && img && !com){
				type = "nocom"
			} else if (!msg && img && com){
				type = "nomsg"
			} else if (msg && img && com){
				type = "all"
			} else {
				type = "none"
			}

			//mode
			if($("#strict").is(":checked")){
				mode = "strict"
			} else {
				mode = "normal"
			}

			//send the request
			$.post("fct/afficher_posts.php", {"mode":mode, "type":type, "nbr":nbr})
			.always(function(data){
				if(localStorage.longPollingSuspend === "false"){
					$(".affiche_post").html(data)
				}
			})
		}

		//tab is active
		$(window).focus(function(){
			isActive = true
			new_post_count = 0
		    $("title").html("Social Network")
		})
		$(window).blur(function(){
			isActive = false
		})

	</script>
</body>
</html>

