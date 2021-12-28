<?php
// session_start();
// $pwd = "DontMindTheFo0l";
// $name = "admin";
// if(isset($_POST["pwd"]) and isset($_POST["pseudo"])){
// 	if($_POST["pwd"] == $pwd and $_POST["pseudo"] == $name){
// 		$_SESSION["pwd"] = $_POST["pwd"];
// 		$_SESSION["pseudo"] = $_POST["pseudo"];
// 		header("location: admin.php");
// 	}
// }
// if(!isset($_SESSION["pwd"]) or !isset($_SESSION["pseudo"]) or ($_SESSION["pwd"] != $pwd or $_SESSION["pseudo"] != $name)){
// 	echo ""
?>
<!-- <!DOCTYPE html>
<html>
	<head>
		<title>Console Administrateur</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
		<style>
		body{
			margin: 0;
			background-color: #757575;
		}
		form{
			box-shadow: 0px 0px 8px rgba(0,0,0,0.3);
			width: 200px;
			padding: 50px;
			padding-bottom: 75px;
			background-color: white;
			font-family: monospace;
			display: block;
			margin: 0 auto;
			margin-top: 50vh;
			transform: translateY(-50%);
			position: relative;
			border-radius: 4px;
		}
		input[type=text], input[type=password]{
			width: calc(100% - 11px);
			padding: 5px;
			margin-bottom: 10px;
			outline: none;
			border: none;
			border-bottom: 1px dotted #9e9e9e;
			font-family: roboto;
			color: #757575;
		}
		input[type=submit]{
			border: none;
			font-family: roboto;
			width: 100%;
			padding: 12px 5px;
			cursor: pointer;
			outline: none;
			color: #757575;
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: #9e9e9e;
			color: white;
			transition: all 400ms;
			border-bottom-right-radius: 4px;
			border-bottom-left-radius: 4px;
		}
		input[type=submit]:hover{
			background-color: #424242;
		}

		</style>
	</head>
	<body>
		<form method="POST">
			<input type="text" name="pseudo" placeholder="pseudo">
			<input type="password" name="pwd" placeholder="password">
			<input type="submit" value="connexion">
		</form>
	</body>
</html> -->
	<?php ;
// 	die();
// }
?>

<!DOCTYPE html>
<html>
<head>
	<!--title-->
	<title>Console Administrateur</title>

	<!--theme color-->
	<meta name="theme-color" content="#ff8a65">

	<!--meta-->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
    
    <!--jQuery-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--hammer js-->
    <!-- <script src="js/hammer-2.0.8.min.js"></script> -->

    <!--Lazysize-->
	<script src="js/lazysize.js"></script>

    <!--highchart-->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    
    <!--icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--css-->
	<style>
		body{
			margin: 0px;
		}
		.blackout{
			background-color: rgba(0,0,0,0.5);
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 11;
			display: none;
		}
		/*==========================*/
		/*			sidebar			*/
		/*==========================*/
		.sidebar{
			position: fixed;
			left: 0;
			top: 0;
			bottom: 0;
			width: 250px;
			max-width: 250px;
			background-color: #ff8a65;
			display: flex;
			flex-direction: column;
			text-align: center;
			z-index: 10;
            visibility: articleViewVisible;
            transition: all 250ms;
		}
		.sidebar h1{
			font-family: Raleway;
			font-size: 20px;
			padding: 80px 0px;
			margin: 0px;
			color: #ffccbc;
			border-bottom: 1px dotted #ffccbc;
			cursor: default;
		}
		.sidebar a{
			display: block;
			padding: 15px 0px;
			text-decoration: none;
			color: white;
			border: none;
			outline: none;
			border-left: 0px solid transparent;
			transition: all 250ms;
			font-family: roboto;
			font-size: 12px;
			text-transform: uppercase;
		}
        .menu_fab{
            position: fixed;
            left: 0;
            top: 0;
            margin: 20px;
            color: black;
            font-size: 17px;
            cursor: pointer;
            visibility: hidden;
        }
		/*==========================*/
		/*			content			*/
		/*==========================*/
		.content{
			width: calc(100% - 280px);
			max-width: calc(100% - 280px);
			overflow-x: hidden;
			margin-left: 250px;
			display: block;
			min-height: calc(100vh - 30px);
			padding: 15px;
            transition: all 250ms;
		}
		.fab{
			height: 45px;
			width: 45px;
			text-align: center;
			color: white;
			background-color: #ff8a65;
			position: fixed;
			margin: 25px;
			bottom: 0;
			right: 0;
			cursor: pointer;
			border-radius: 45px;
			box-shadow: 1px 1px 5px rgba(0,0,0,0.5);
			transition: all 250ms;
		}
		.fab i{
			line-height: 45px;
			font-size: 18px;
			transform: rotateZ(0deg);
			transition: all 250ms;
		}
		.fab:hover{
			background-color: #f4511e;
		}
		.fab:hover i{
			transform: rotateZ(360deg);
		}
        @media all and (max-width: 600px){
            .sidebar{
                left: -250px;
                visibility: hidden;
            }
            .content{
                margin-left: 0px;
                width: calc(100% - 30px);
                max-width: none;
            }
            .menu_fab{
                visibility: articleViewVisible;
            }
        }
		/*==========================*/
		/*			ecrire			*/
		/*==========================*/
		#write{
			width: 100%;
			max-width: 800px;
			margin: 0 auto;
			margin-top: 18vh;
		}
		#write input, #write textarea{
			width: calc(100% - 15px);
			border: none;
			outline: none;
			margin: 0px;
			font-family: roboto;
			font-size: 13px;
			padding: 5px;
			resize: vertical;
			background-color: transparent;
		}
		#write input[type=text]{
			background-color: #eeeeee;
			padding: 12px 5px;
			font-size: 20px;
			text-align: center;
			border-bottom-left-radius: 3px;
			border-bottom-right-radius: 3px;
		}
		#write textarea{
			background-color: #f5f5f5;
			min-height: 50vh;
		}
		.popup1{
			min-width: 250px;
			min-height: 250px;
			max-height: 50vh;
			max-width: 70vw;
			background-color: white;
			position: fixed;
			margin: 0 auto;
			top: 20vh;
			left: 0;
			right: 0;
			bottom: 0;
			display: none;
			z-index: 20;
			font-family: roboto;
			font-size: 13px;
			text-transform: uppercase;
		}
		.popup1 .lvl{
			width: 100%;
			display: flex;
			justify-content: space-around;
		}
		.popup1 .lvl span{
			display: block;
			width: 100%;
			padding: 15px 0px;
			text-align: center;
			cursor: pointer;
			color: white;
			opacity: 0.3;
		}
		.popup1 .lvl span:nth-child(1){
			background-color: #a5d6a7;
			opacity: 1;
		}
		.popup1 .lvl span:nth-child(2){
			background-color: #9fa8da;
		}
		.popup1 .lvl span:nth-child(3){
			background-color: #ff8a65;
		}
		.popup1 .published{
			margin: 0 auto;
			width: 200px;
			margin-top: 100px;
			text-align: center;
			padding: 7px 25px;
			background-color: #bdbdbd;
			background-color: #eeeeee;
			cursor: pointer;
		}
		.popup1 .save{
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			text-align: center;
			width: 100%;
			padding: 15px 0px;
			background-color: #eeeeee;
			background-color: rgb(238, 238, 238);
			cursor: pointer;
		}
		/*==========================*/
		/*			manage   		*/
		/*==========================*/
		.list{
			background-color: #f5f5f5;
			padding: 10px 15px;
			font-family: roboto;
			font-size: 13px;
			color: #424242;
			border-radius: 3px;
			max-width: 600px;
			margin: 10px auto;
			display: flex;
			justify-content: space-between;
			cursor: move;
		}
		.unpublished{
			border-left: 4px solid #ff8a65;
		}
		.list_head{
			text-align: center;
			font-family: raleway;
			font-size: 17px;
			font-weight: lighter;
			text-transform: uppercase;
			margin: 35px 0px;
		}
		.list .button{
			text-decoration: none;
			padding: 7px 10px;
			font-weight: bold;
			color: #ff8a65;
			cursor: pointer;
		}
		/*==========================*/
		/*			stats    		*/
		/*==========================*/
		.nocursor{
			cursor: default;
			flex-direction: column;
			cursor: pointer;
		}
		.nocursor .first{
			display: flex;
			flex-wrap: nowrap;
			justify-content: space-around;
		}
		.nocursor hr{
			background-color: transparent;
			border: none;
			border-top: 1px dotted #424242;
			height: 0px;
			width: 80%;
			outline: none;
		}
		.ip_data{
			height: 0px;
			transition: all 250ms;
		}
		.stats{
			max-width: calc(90vw - 40px);
			min-width: 250px;
			margin: 0 auto;
			padding-top: 40px;
		}
		.statbox{
			display: flex;
			justify-content: space-around;
			flex-wrap: wrap;
		}
		.article_stat{
			border-left: 4px solid #9575CD;
		}
		.search_stat{
			border-left: 4px solid #FF8A65;
		}
		.total_view{
			background-color: #f5f5f5;
			padding: 20px 15px;
			font-family: roboto;
			font-size: 20px;
			font-weight: bold;
			color: #424242;
			border-radius: 3px;
			max-width: 600px;
			margin: 10px auto;
			text-align: center;
		}
		/**/
		.comment{
            background-color: #FBE9E7;
            line-height: 1.9;
            font-size: 13px;
            width: 100%;
            max-width: 600px;
            margin: 25px auto;
            cursor: pointer;
        }
        .comment span{
            background-color: #FF8A65;
            width: 100%;
            color: white;
            text-align: center;
            display: block;
            font-weight: normal;
            padding: 2px 0px;
        }
        .comment p{
            padding: 10px 15px;
            padding-top: 0px;
            font-family: roboto;
            font-size: 13px;
        }
        h4{
        	text-align: center;
        	font-weight: lighter;
        	font-family: raleway;
        	color: #FF8A65;
        	font-size: 23px;
        }
        /*medias*/
        .upBox{
        	width: 100%;
        	max-width: 630px;
        	margin: 50px auto;
        	height: 180px;
        	border-radius: 4px;
        	background-color: #FF8A65;
        	box-shadow: 0px 0px 6px rgba(0,0,0,0.3) inset;
        }
        .upBox p{
        	text-align: center;
        	font-family: roboto;
        	font-size: 14px;
        	color: white;
        	line-height: 180px;
        }
        .media_list{
        	display: flex;
        	margin: 25px auto;
        	flex-wrap: wrap;
        	justify-content: space-around;
        }
        .media_list .img_box{
        	max-width: 200px;
        	max-height: 150px;
        	overflow: hidden;
        	box-shadow: 0px 0px 4px rgba(0,0,0,0.4);
        	margin: 15px;
        	position: relative;
        }
        .media_list .img_box img{
        	width: 100%;
        }
        .media_list .img_box span{
        	position: absolute;
        	bottom: 0;
        	left: 0;
        	right: 0;
        	padding: 2px 0px;
        	background-color: #FF8A65;
        	font-family: roboto;
        	font-size: 13px;
        	text-align: center;
        	color: white;
        }

        .file_txt{
			width: 100%;
			max-width: 630px;
			margin: 0 auto;
		}
		.file_txt input, .file_txt textarea{
			width: calc(100% - 15px);
			border: none;
			outline: none;
			margin: 0px;
			font-family: roboto;
			font-size: 13px;
			padding: 5px;
			resize: vertical;
			background-color: transparent;
		}
		.file_txt input{
			background-color: #eeeeee;
			padding: 12px 5px;
			font-size: 20px;
			text-align: center;
			border-bottom-left-radius: 3px;
			border-bottom-right-radius: 3px;
		}
		.file_txt input[type=submit]{
			font-size: 13px;
			width: calc(100% - 5px);
			margin-top: -3px;
			border: none;
			outline: none;
			margin-bottom: 50px;
			cursor: pointer;
			font-weight: bold;
			color: #424242;
		}
		.file_txt textarea{
			background-color: #f5f5f5;
			min-height: 100px;
		}
	</style>
</head>
<body>
    
    <div class="menu_fab"><i class="material-icons">menu</i></div>

	<div class="sidebar">
		<h1>Codez-le 3.1</h1>
		<a href="#write">Ecrire</a>
		<a href="#manage">Gérer</a>
		<a href="#stats">Stats</a>
		<a href="#medias">medias</a>
		<a href="#files">fichiers</a>
		<a href="#comments">Commentaires</a>
	</div>


	<div class="content"></div>



	<script>
		//sidebar on click
		$(".sidebar a").on("click", function(e){
			e.preventDefault;
			e.stopImmediatePropagation;

			var page = $(this).attr("href").substr(1);
			$(".sidebar a").css({"background-color":"transparent", "border-left":"4px solid transparent"});
			$(this).css({"background-color":"#ffab91", "border-left":"4px solid white"});

			$(".content").load("admin/"+page+".php");
            
            if(window.innerWidth < "600"){
                $(".sidebar").css({"left":"-250px", "visibility":"hidden"});
            }

			return false;
		});

		//default content
		$(".content").load("admin/files.php");
        
        //menu mobile
        $(".menu_fab").on("click", function(){
           $(".sidebar").css({"left":"0px", "visibility":"articleViewVisible"});
        });
        $(".content").on("click", function(){
            if(window.innerWidth < "600"){
                $(".sidebar").css({"left":"-250px", "visibility":"hidden"});
            }
        })
        $(window).on("resize", function(){
            if(window.innerWidth > "600"){
                $(".sidebar").css({"left":"0px", "visibility":"articleViewVisible"});
            } else {
                $(".sidebar").css({"left":"-250px", "visibility":"hidden"});
            }
        });

        //tactil events with hammerjs
		Hammer(document.body).on("swipe", function(e){
			if(window.innerWidth < "600"){
				if($(".sidebar").css("left") === "-250px" && e.deltaX > 60){
					$(".sidebar").css({"left":"0px", "visibility":"articleViewVisible"});
				} else if($(".sidebar").css("left") === "0px" && e.deltaX < -60){
					$(".sidebar").css({"left":"-250px", "visibility":"hidden"});		
				}
			}
		});


	</script>

</body>
</html>