<div class="popup"></div>
<div class="blackout"></div>
<?php
if(isset($_POST["name"])){
    $path = "../cours/".$_POST["name"];
    if(file_exists($path.".txt")){
        $content = file_get_contents($path.".txt");
    } else {
        $content = "Pas de description associée à ce dossier !";
    }
    echo "{$content}<a href=\"".$path.".zip\">Télécharger le dossier</a>";
    die();
}

function explorer($dir=""){
    $dir = (empty($dir))?glob("../cours/*.zip"):glob($_POST["path"]."*.zip");
    foreach($dir as $item){
        $name = preg_replace("#\.\./cours/|\.zip#", "", utf8_encode($item));
        echo "<a class=\"folder\" data=\"".$name."\" download=\"\">";
        echo "<i class=\"material-icons\">folder</i>";
        echo "<span>".$name."</span></a>";
    }
}
if(isset($_POST["path"])){
    explorer($_POST["path"]);
}
?>
<script>
//on click ddl
$(".folder").on("click", function(){
    $(".blackout").show();
    var name = $(this).attr("data");
    $.post("functions/file_explorer.php", {"name":name})
    .always(function(data){
        $(".popup").show().html(data);
    })
});
$(".blackout, .popup").on("click", function(){
    $(".popup, .blackout").hide();
})
</script>