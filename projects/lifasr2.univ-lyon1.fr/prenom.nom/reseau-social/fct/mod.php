<?php
//--------------------------------
//poster le message modifié
//--------------------------------
if( isset($_POST["fname"]) and isset($_POST["type"]) and isset($_POST["name"]) and isset($_POST["date"]) and isset($_POST["likes"]) ){

	$data = $_POST["type"]."\n".$_POST["name"]."\n".$_POST["date"]."\n".$_POST["likes"]."\n\n";
	if( trim($_POST["type"]) == "message" ){
		$data .= $_POST["contenu"]."\n";
	} else if( trim($_POST["type"]) == "image" ) {
		$data .= $_POST["image_path"]."\n";
		$data .= $_POST["contenu"];
	} else if( trim($_POST["type"]) == "commentaire" ){
		$data .= $_POST["message_path"]."\n";
		$data .= $_POST["contenu"];
	}
	if(file_put_contents("../../../DATA/".$_POST["fname"], $data)){
		echo "<span class=\"green\">successfully modified message ".$_POST["fname"]."</span>";
	} else {
		echo "<span class=\"red\">something went wrong while saving the message ".$_POST["fname"]."</span>";
	}

	die();
}

if( isset($_POST["remove"]) ){
	if(unlink("../../../DATA/".$_POST["remove"])){
		echo "<span class=\"green\">successfully removed message ".$_POST["remove"]."</span>";
	} else {
		echo "<span class=\"red\">something went wrong while removing the message ".$_POST["remove"]."</span>";
	}
}


//--------------------------------
//afficher les messages
//--------------------------------

function search_post($message, $niddle){
	$fcontent = implode(" ", $message);
	if(preg_match("#".strtolower($niddle)."#", strtolower($fcontent))){
		return true;
	} else {
		return false;
	}
}

function get_message($file, $index){
	
	$c = count($file);
	$chunk = "";
	for($i=$index; $i<$c; $i++){
		$chunk .= $file[$i];
	}
	//$chunk .= $file[$i];
	//echo json_encode($chunk);
	return $chunk;
}

function diagnostic($fname, $data){

	$error[0] = (isset($data[4]) and !empty(trim($data[4])));
	$error[1] = !preg_match("#[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}#", $data[2]);
	$error[2] = (isset($data[3]) and !is_numeric(trim($data[3])));

	if(trim($data[0]) == "image"){
		$img = preg_replace("#\.\/#", "", trim($data[5]));
		$error[3] = (isset($data[5]) and !file_exists("../../../DATA/".$img));
	}


	if( array_search("true", $error) == true){
		echo "<b>Diagnostic regarding ".preg_replace("#\.|txt|\/|DATA#", "", $fname)."</b><br>";
	}

	if( $error[0] ) {
		echo "<p>Potential problem found: separator is not empty</p>";
	} else if( $error[1] ){
		echo "<p>Potential problem found: date is not set properly</p>";
	} else if( $error[2] ){
		echo "<p>Potential problem found: likes aren't numeric</p>";
	}
	if(isset($error[3]) and $error[3]){
		echo "<p>Potential problem found: IMG link is broken</p>";
	}

}

function show_form($fname, $data){
	echo "<form method=\"post\" action=\"mod.php\" class=\"message_form\">";

	echo "<i class=\"material-icons\">&#xE5CD;</i>";
	
	$name = preg_replace("#\.|/|DATA|txt#", "", $fname);
	echo "<h3>".$name."</h3>";

	echo "<input type=\"hidden\" name=\"fname\" value=\"{$name}.txt\">";

	echo "<input type=\"text\" name=\"type\" value=\"{$data[0]}\">";
	echo "<input type=\"text\" name=\"name\" value=\"{$data[1]}\">";
	echo "<input type=\"text\" name=\"date\" value=\"{$data[2]}\">";
	echo "<input type=\"text\" name=\"likes\" value=\"{$data[3]}\">";

	echo "<input type=\"text\" name=\"blank\" value=\"".(isset($data[4])?$data[4]:"")."\">";	

	if(trim($data[0]) === "message"){
		echo "<textarea type=\"text\" name=\"contenu\" >".(isset($data[5])?get_message($data, 5):"")."</textarea>";
	} else if(trim($data[0]) === "image") {
		echo "<input type=\"text\" name=\"image_path\" value=\"".(isset($data[5])?$data[5]:"")."\">";
		echo "<textarea type=\"text\" name=\"contenu\" >".(isset($data[6])?get_message($data, 6):"")."</textarea>";
	} else if (trim($data[0]) === "commentaire"){
		echo "<input type=\"text\" name=\"message_path\" value=\"".(isset($data[5])?$data[5]:"")."\">";
		echo "<textarea type=\"text\" name=\"contenu\" >".(isset($data[6])?get_message($data, 6):"")."</textarea>";
	}

	echo "<input type=\"submit\" value=\"sauvegarder\">";

	echo "</form>";
}


$path = "../../../DATA/";

if(isset($_GET["disp"]) and isset($_GET["sort"]) and isset($_GET["search"])){
	$disp = $_GET["disp"];
	$sort = $_GET["sort"];
	$search = $_GET["search"];


	//display
	if( $disp === "all" ){
		$files = glob($path."*-{msg,img,com}.txt", GLOB_BRACE);
	} else if( $disp === "msg" ){
		$files = glob($path."*-msg.txt");
	} else if( $disp === "com" ){
		$files = glob($path."*-com.txt");
	} else {
		$files = glob($path."*-img.txt");
	}

	if(empty($files)){
		die("no such files availables!");
	}


	//sort
	if( isset($sort) ){
		if( $sort == "normal"){
			sort($files, SORT_NATURAL);
		} else {
			rsort($files, SORT_NATURAL);
		}
	} else {
		rsort($files, SORT_NATURAL);
	}

	//post count
	echo "<a id=\"count\" href=\"#top\">".count($files)."</a>";

	//display posts
	foreach($files as $key => $fname){
		$data = file($fname);
		if( isset($_GET["search"]) ){
			if(search_post($data, $_GET["search"])){
				show_form($fname, $data);
			}
		} else {
			show_form($fname, $data);
		}
	}


	echo ""?>
	<script>
		$(".message_form").on("click", function(){
			localStorage.long_polling_suspend = true
		})
		$(".message_form input[type=submit]").on("click", function(e){
			e.preventDefault()
			e.stopImmediatePropagation()

			var formData = new FormData($(this).parent()[0])
	        $.ajax({
	            url: "mod.php",
	            type: "POST",
	            data: formData,
	            async: true,
	            cache: false,
	            contentType: false,
	            processData: false
	        })
	        .always(function(data){
				$("#status").show()
				$("#status p").append(data+"<br>")
				localStorage.long_polling_suspend = false
				get_post()
			})

			return false
		})
		$("#status .material-icons").on("click", function(){
			$("#status").slideUp(250)
			$("#status p").html("")
		})
		$(".message_form .material-icons").on("click", function(){
			var fname = $(this).parent().find("input[name=fname]").val()
	        $.post("mod.php", {"remove":fname}) 
		})
	</script>
	<?php "";

	//shut down display
	die();
}
?>
<!DOCTYPE html>
<html id="top">
<head>
	<meta charset="utf-8">
	<title>mod</title>

	<meta name="viewport" content="width = device-width, initial-scale=1.0">

	<!--icones-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--polices-->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,700" rel="stylesheet">

	<!--flemme.js-->
	<script src="../js/jquery-3.2.1.min.js"></script>

	<style>
		a{
			text-decoration: none;
			color: inherit;
		}
		body{
			background-color: #37474F;
		}
		h1{
			text-align: center;
			font-family: monospace;
			font-size: 35px;
			font-weight: lighter;
			color: white;
			margin: 100px auto;
			text-transform: uppercase;
		}
		#count{
			position: fixed;
			top: 20px;
			right: 20px;
			width: 45px;
			height: 45px;
			border-radius: 45px;
			box-shadow: 1px 1px 2px rgba(0,0,0,0.3);
			text-align: center;
			line-height: 45px;
			background-color: #EC407A;
			color: white;
			font-family: monospace;
			font-size: 15px;
			z-index: 100;
		}
		#manage{
			width: calc(80vw - 70px);
			min-width: 250px;
			max-width: 700px;
			background-color: white;
			padding: 35px;
			box-shadow: 1px 1px 3px rgba(0,0,0,0.5);
			margin: 80px auto;
			color: #424242;
			z-index: 100;
		}

		#manage #wrap_select{
			display: flex;
			justify-content: space-between;
			width: 100%;
		}
		#manage input, #manage select{
			padding: 10px 0px;
			display: inline-block;
			width: 100%;
			margin: 5px 0px;
			border: 1px solid #424242;
		}
		#manage select, #manage option{
			text-transform: uppercase;
			font-family: monospace;
			text-align: center;
			font-size: 12px;
		}
		#manage #search_text{
			width: calc(100% - 20px);
			margin: 10px auto;
			display: block;
			padding: 10px;
		}
		#manage input[type=submit]{
			display: block;
			width: calc(100% - 4px);
			margin: 10px auto;
			margin-top: 25px;
			padding: 15px 20px;
			background-color: #EC407A;
			border: none;
			outline: none;
			cursor: pointer;
			color: white;
			text-transform: uppercase;
			border: 2px solid #EC407A;
			border-radius: 3px;
			transition: all 250ms;
		}
		#manage input[type=submit]:hover{
			background-color: white;
			color: #EC407A;
			transition: all 250ms;
		}
		#manage select:nth-child(2){
			border-left: none;
		}
		#status .material-icons, .message_form .material-icons{
			position: absolute;
			top: 15px;
			right: 15px;
			cursor: pointer;
		}
		#status p{
			font-family: monospace;
			text-align: center;
		}
		#status .green{
			color: green;
		}
		#status .red{
			color: red;
		}
		.message_form, #status, #stats, #picts{
			width: calc(80vw - 70px);
			min-width: 250px;
			max-width: 700px;
			padding: 35px;
			box-shadow: 1px 1px 3px rgba(0,0,0,0.5);
			margin: 50px auto;
			background-color: white;
			color: #424242;
			position: relative;
		}
		#picts{
			display: flex;
			justify-content: space-around;
			flex-wrap: wrap;
		}
		#picts img{
			height: 200px;
		}
		#status{
			display: none;
			position: fixed;
			bottom: 25px;
			left: 0px;
			right: 0px;
			margin-top: 0px;
			margin-bottom: 0px;
			width: calc(85vw - 70px);
			padding: 15px 35px;
			z-index: 100;
		}
		.message_form h3{
			color: #EC407A;
			margin-bottom: 35px;
			font-size: 27px;
			font-weight: normal;
		}
		.message_form input, .message_form textarea{
			width: 100%;
			display: block;
			padding: 7px;
			font-family: monospace;
			color: #424242;
			margin: 10px auto;
			border: 1px solid #424242;
			outline: none;
			resize: vertical;
		}
		.message_form textarea{
			min-height: 100px;
		}
		.message_form input[type=submit]{
			background-color: #EC407A;
			color: white;
			border: none;
			width: calc(100% + 16px);
			cursor: pointer;
			padding: 12px 0px;
			margin-top: 50px;
			transition: all 250ms;
			border: 2px solid #EC407A;
			font-weight: bold;
		}
		.message_form input[type=submit]:hover{
			background-color: white;
			color: #EC407A;
			transition: all 250ms;
		}
	</style>
</head>
<body>
	<h1>modder</h1>

	<form method="GET" action="mod.php" id="manage">

		<h3>Manage</h3>

		<div id="wrap_select">
			<select name="display">
				<option value="msg">Messages</option>
				<option value="img">Images</option>
				<option value="com">Commentaires</option>
				<option selected value="all">Tous</option>
			</select>

			<select name="sort">
				<option value="normal">Croissant</option>
				<option selected value="reverse">Décroissant</option>
			</select>
		</div>

		<input type="text" placeholder="Trouver par contenu du post" name="search" id="search_text">

		<input type="submit" value="trier">

	</form>

	<div id="stats">
		<h3>Erreurs</h3>
		<details>
		<?php
		//display posts
		$files = glob($path."*-{msg,img,com}.txt", GLOB_BRACE);
		$img = glob($path."*-img.txt");
		$msg = glob($path."*-msg.txt");
		$com = glob($path."*-com.txt");

		echo "<summary>Stats<ul><li>images: ".count($img)."</li><li>messages: ".count($msg)."</li><li>commentaires: ".count($com)."</li></ul></summary>";

		rsort($files, SORT_NATURAL);
		foreach($files as $key => $fname){
			$data = file($fname);
			diagnostic($fname, $data);
		}
		?>
		</details>
	</div>


	<div id="picts">
		<?php
		$picts = glob($path."/IMG/*");
		foreach($picts as $path){
			echo "<img src=\"$path\">";
		}
		?>
	</div>

	<div id="status">
		<i class="material-icons">&#xE5CD;</i>
		<p></p>
	</div>

	<div id="content"></div>

<script>
	localStorage.long_polling_suspend = false

	//Long polling
	function check_new_post(){
		$.ajax({url:"verifier_nouv_post.php", method:"POST", complete: check_new_post})
    	.done(function(data){
    		if(Number(data) != 0){
				get_post()
			}
    	})
	}
	check_new_post();

	function get_post(){
		var disp = $("#wrap_select select[name=display]").val(),
			sort = $("#wrap_select select[name=sort]").val()
			search = $("#search_text").val()
		$.get("mod.php", {"disp":disp, "sort":sort, "search":search})
		.done(function(data){
			$("#content").html(data);
		})
	}
	get_post()

	$("#manage").on("submit", function(e){
		e.preventDefault()
		e.stopImmediatePropagation()
		get_post()
		return false
	})
</script>

</body>
</html>
