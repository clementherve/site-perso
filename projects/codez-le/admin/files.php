<div class="upBox"><p>drop your .zip files here...</p></div>
<form class="file_txt">
	<input type="text" name="file_name" placeholder="nom du fichier" required autocomplete="off">
	<textarea name="file_content" placeholder="description" required></textarea>
	<input type="submit" value="enregister">
</form>
<?php

$f_list = glob("../cours/*.zip");
foreach($f_list as $path){
	$path2 = preg_replace("#.zip#", ".txt", $path);
	if(file_exists($path2)){
		$description = file_get_contents($path2);
	} else {
		$description = "Pas de description associée !";
	}
	$name = preg_replace("#\.\./cours/#", "", $path);
	echo "<div class=\"list nocursor\" style=\"cursor: default;\"><center>".$name."</center><hr><span>".$description."</span></div>";
}
?>

<script>
	$(".file_txt").on("submit", function(e){
		e.preventDefault;
		e.StopImmediatePropagation;
		var fname = $(".file_txt input[type=text]").val(),
			fcontent = $(".file_txt textarea").val();
		$.post("admin/functions/save_file.php", {"fname":fname,"fcontent":fcontent})
		.always(function(data){
			if(data == "ok"){
				$(".content").load("admin/files.php");
			} else {
				alert("Erreur lors de l'enregistrement !");
			}
		});
		return false;
	});

	$(".list").on("click", function(event){
		prompt("CTRL+C pour copier le texte",$(this).find("span").html());
	});
</script>