<div class="upBox"><p>drop your pictures here...</p></div>

<div class="media_list">
	
	<?php
	$media_list = glob("../img/res/*");
	foreach($media_list as $path){
		$name = preg_replace("#\.\./img/res/#", "", $path);
		$path2 = preg_replace("#\.\.#", "", $path);
		echo "<div class=\"img_box\" path=\"{$path2}\"><img data-src=\"{$path}\" class=\"lazyload\"><span>{$name}</span></div>";
	}
	?>

</div>

<script>
	
	$(".img_box").on("click", function(){
		window.prompt("Copier le nom de l'image: CTRL+C", $(this).attr("path"));
	})

</script>

<script src="../js/dragndrop.js" async></script>