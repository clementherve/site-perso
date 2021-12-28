<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>LIFBW1 - TP4 (chat)</title>

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<meta name="viewport" content="width = device-width, initial-scale=1.0">

	<style>
		body{
			margin: 0;
			font-family: Montserrat;
			background-color: #424242;
		}
		#form{
			width: 400px;
			height: 270px;
			margin: 0 auto;
			margin-top: 50vh;
			position: relative;
			transform: translateY(-50%);
			background-color: white;
			box-shadow: 2px 2px 4px rgba(0,0,0,0.2);
		}
		#form h3{
			font-size: 15px;
			margin: 0px;
			padding-top: 20px;
			padding-left: 20px;
			font-weight: normal;
		}
		#innerform{
			padding: 15px;
		}
		#innerform input{
			border: 1px dotted #00E676;
			outline: none;
			padding: 10px;
			margin: 5px auto;
			width: calc(100% - 20px);

		}
		#createAccount{
			display: block;
			text-align: center;
			font-size: 13px;
			margin-top: 10px;
		}
		#submit{
			position: absolute;
			bottom: 0;left: 0;right: 0;
			width: 100%;
			height: 50px;
			line-height: 50px;
			color: white;
			cursor: pointer;
			text-align: center;
			background-color: #00E676;
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div id="form">
		<h3>Connexion</h3>
		<div id="innerform">
			<input type="text" placeholder="Votre pseudo" id="pseudo" autocomplete="off">
			<input type="password" placeholder="Votre mot de passe" id="pwd1">

			<a href="signup.php" id="createAccount">pas encore de compte ?</a>
		</div>
		<a id="submit" href="messages.php">Connexion</a>
	</div>

	<script>
		$("#submit").on('click', (e)=>{
			e.preventDefault()

			let pseudo = $("#pseudo").val(),
				pwd = $("#pwd1").val();

			$.post("php/connexion.php", {'pseudo':pseudo, 'mdp':pwd})
			.done((resp)=>{
				if(resp == 1){
					window.location = 'messages.php'
				}
			})

			return false;
		})
	</script>
</body>
</html>