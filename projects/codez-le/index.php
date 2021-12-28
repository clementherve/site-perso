<?php
/*session_start();
if(isset($_GET["pwd"]) and $_GET["pwd"] == "GastonBachelard"){
    $_SESSION["pwd"] = $_GET["pwd"];
} else {
    if(!isset($_SESSION["pwd"]) or $_SESSION["pwd"] != "GastonBachelard"){
        die();
    }
    if(isset($_GET["pwd"]) and $_GET["pwd"] != "GastonBachelard"){
        die();
    }
}
if(isset($_GET["pwd"])){
    header("location: index.php");
}*/
?>
<!DOCTYPE html>
<html>

    <head>
        <!--meta-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">


        <!--title-->
        <title>Codez-Le 3.1</title>


        <!--fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet">


        <!--jQuery-->
        <script src="js/jquery-3.2.1.min.js"></script>

        <!--icons-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link href="js/google-code-prettify/prettify.css" rel="stylesheet">

        <!--css-->
        <style>
            /*========================*/
            /*         general        */
            /*========================*/
            *{
                margin: 0px;
                text-decoration: none;
            }
            body{
/*                overflow: hidden;*/
            }
            .blackout{
                background-color: rgba(0,0,0,0.5);
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                z-index: 1;
                display: none;
            }
            /*========================*/
            /*         header         */
            /*========================*/
            header{
                background-color: #FF8A65;
                height: 60vh;
                max-height: 60vh;
                display: inline-block;
                width: 100%;
                position: relative;
                border-bottom: 4px solid #FF5722;
            }
            header h1{
                text-align: center;
                color: #ffe2d9;
                margin-top: 20vh;
                font-family: Raleway;
                font-weight: lighter;
                line-height: 1.9;
                word-spacing: 2px;
                font-size: 5vh;
            }
            header img{
                width: 250px;
                display: block;
                position: absolute;
                left: 0px;
                right: 0px;
                bottom: -105px;
                margin: 0 auto;
            }
            @media all and (max-width:800px){
                header img{
                    width: 200px;
                    bottom: -80px;
                }
                header h1{
                    font-size: 27px;
                    max-width: 95%;
                }
            }
            /*========================*/
            /*      article list      */
            /*========================*/
            .content{
                display: flex;
                flex-direction: column;
                margin-top: 30px;
                min-height: 100vh;
                padding-bottom: 150px;
                padding-top: 0px;
            }
            h3{
                font-family: Raleway;
                font-weight: lighter;
                color: #FF8A65;
                margin: 10px auto;
                margin-bottom: 80px;
                font-size: 30px;

            }
            .card{
                width: 90vw;
                max-width: 800px;
                min-width: 250px;
                margin: 0 auto;
                font-family: roboto;
                display: flex;
                justify-content: center;
            }
            /*thumbnail*/
            .card .thumb{
                width: 250px;
                height: 150px
            }
            .card img{
                height: 150px;
                max-width: 150px;
                min-width: 150px;
                border-radius: 250px;
                border: 2px dotted #FF8A65;
                z-index: 20;

            }
            /*snippet*/
            .card .snippet{
                margin-left: 20px;
            }
            .card h2{
                margin-bottom: 15px;
                font-size: 20px;
            }
            .card p{
                line-height: 1.7;
                text-align: justify;
            }
            .card a{
                margin-top: 10px;
                display: inline-block;
                padding: 7px 20px;
                background-color: rgba(255, 171, 145, 0.73);
                color: rgba(230, 74, 25, 0.6);
                font-weight: bold;
                border-radius: 4px;
                transition: all 250ms;
            }
            .card a:hover{
                background-color: rgba(255, 171, 145, 1);
                color: rgba(230, 74, 25, 1);
            }
            hr{
                background-color: transparent;
                border: none;
                outline: none;
                height: none;
                border-bottom: 1px dotted rgba(0, 0, 0, 0.6);
                width: 90vw;
                max-width: 900px;
                min-width: 250px;
                margin: 70px auto;
            }
            @media all and (max-width: 800px){
                .card{
                    display: flex;
                    justify-content: center;
                    flex-direction: column;
                    width: calc(100% - 20px);
                    margin: 0 auto;
                    max-width: none;
                    min-width: none;
                }
                .card .thumb{
                    width: 100%;
                    height: auto;
                    max-height: 200px;
                    overflow: hidden;
                    border-radius: 0px;
                }
                .card img{
                    width: 100%;
                    max-width: none;
                    max-height: none;
                    height: auto;
                    border-radius: 0px;
                    border: none;
                }
                .card h2{
                    text-align: center;
                }
                .card .snippet{
                    margin: 0px;
                    margin-top: 20px;
                    padding: 7px;
                }
                .card a{
                    margin: 0 auto;
                    display: block;
                    max-width: 120px;
                    margin-top: 25px;
                    text-align: center;
                }
                hr{
                    width: 100%;
                    margin: 50px auto;
                    max-width: none;
                    min-width: none;
                }
            }
            /*========================*/
            /*        article         */
            /*========================*/
            .article{
                height: 100vh;
                position: fixed;
                width: 100vw;
                background-color: white;
                z-index: 100;
                left: 0;
                bottom: -100vh;
                max-height: 100vh;
                overflow-y: auto;
                transition: all 600ms ease-in-out;
                visibility: hidden;
                border-top: 4px solid #FF5722;
            }
            .article .data{
                background-color: white;
                width: calc(90vw - 30px);
                max-width: 800px;
                min-width: 250px;
                margin: 0 auto;
                font-family: roboto;
                padding: 15px;
            }
            .article .data a{
                font-weight: bold;
                color: #FF8A65;
            }
            .article .data a:hover{
                text-decoration: underline;
            }
            .article video{
            	width: 100%;
            }
            .data p{
                line-height: 1.8;
                text-align: justify;
                margin: 10px 0px;
            }
            .data h3{
                margin: 90px 0px;
            }
            .data h4{
                margin: 30px 0px;
                font-size: 18px;
            }
            .data hr{
                width: 100%;
            }
            .data h5{
                margin: 25px 0px;
                font-size: 16px;
            }
            .data ul{
                margin: 15px 0px;
                line-height: 1.5;
            }
            .data textarea{
                width: 100%;
                min-height: 250px;
                border: none;
                outline: none;
                box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
                margin: 50px 0px;
                resize: vertical;
            }
            .data h3{
                text-align: center;
            }
            .data img{
                width: 100%;
            }
            .close{
                position: fixed;
                top: 0;
                right: 15px;
                padding: 25px;
                cursor: pointer;
                font-family: roboto;
                color: rgba(0, 0, 0, 0.4);
                transition: all 250ms;
            }
            .close:hover{
                color: black;
            }
            /*========================*/
            /*         comments       */
            /*========================*/
            .comment_box{
                width: 90vw;
                margin: 0 auto;
                max-width: 800px;
                min-width: 250px;
                font-family: roboto;
                font-stretch: 13px;
                border-top: 3px solid #FF8A65;
                margin-top: 50px;
                padding-top: 50px;
            }
            .comment_box h4{
                text-align: center;
                font-family: roboto;
                font-weight: lighter;
                font-size: 20px;
                margin-bottom: 50px;
            }
            .post_comment input[type=text], .post_comment textarea{
                width: calc(100% - 10px);
                outline: none;
                border: none;
                resize: vertical;
                color: black;
                padding: 7px 5px;
                box-shadow: 0px 0px 3px rgba(0,0,0,0.4) inset;
                margin: 10px 0px;
                font-family: roboto;
                font-size: 13px;
            }
            .post_comment input[type=submit]{
                border: 1px solid #424242;
                outline: none;
                background-color: white;
                font-family: roboto;
                font-stretch: 13px;
                padding: 7px 0px;
                color: #424242;
                cursor: pointer;
                width: 200px;
                display: block;
                text-align: center;
                margin: 0 auto;
                margin-bottom: 50px;
                transition: all 250ms;
            }
            .post_comment input[type=submit]:hover{
                background-color: #424242;
                color: white;
            }
            .post_comment textarea{
                min-height: 150px;
            }
            .comment{
                margin: 25px 0px;
                background-color: #FBE9E7;
                line-height: 1.9;
                font-size: 13px;
                width: 100%;
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
            }
            .success{
                background-color: #81C784;
                color: white;
                display: block;
                text-align: center;
                font-family: roboto;
                border-radius: 4px;
                padding: 25px 0px;
                width: 100%;
                font-size: 13px;
                margin: 25px 0px;
            }
            .failure{
                background-color: #E57373;
                color: white;
                display: block;
                text-align: center;
                font-family: roboto;
                border-radius: 4px;
                padding: 25px 0px;
                width: 100%;
                font-size: 13px;
                margin: 25px 0px;
            }
            /*========================*/
            /*          search        */
            /*========================*/
            .search{
                position: fixed;
                top: 0;
                right: 0;
                z-index: 99;
                border: none;
                outline: none;
                padding: 8px 6px;
                margin: 20px;
                border-radius: 4px;
                color: #424242;
                font-family: roboto;
                box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
                transition: all 400ms;
                width: 20%;
                min-width: 200px;
                max-width: 200px;
                background-color: rgba(255, 255, 255, 0.5);
            }
            .search:focus{
                width: calc(40% - 52px);
                max-width: 400px;
                min-width: 200px;
                background-color: rgba(255, 255, 255, 1);
                box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
            }
            #res{
                margin: 50px 0px;
                text-align: center;
            }
            @media all and (max-width: 500px){
                .search{
                    margin: 0px auto;
                    display: block;
                    left: 0;
                    border-radius: 0px;
                    width: 100%;
                    max-width: none;
                    padding: 12px 5px;
                    background-color: rgba(255, 255, 255, 1);
                    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
                }
                .search:focus{
                    width: 100%;
                    max-width: none;
                    padding: 17px 5px;
                }
            }
            /*========================*/
            /*        selection       */
            /*========================*/
            .choose{
                width: 100%;
                max-width: 500px;
                margin: 25px auto;
                display: flex;
                justify-content: center;
                box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.2);
                position: absolute;
                bottom: -50px;
                right: 0;
                left: 0;
            }
            .choose a{
                display: inline-block;
                width: 100%;
                text-align: center;
                padding: 15px 0px;
                background-color: #FF8A65;
                color: white;
                font-weight: bold;
                font-family: roboto;
                font-size: 14px;
            }
            @media all and (max-width: 500px){
                header{
                    height: 75vh;
                    max-height: 75vh;
                }
                header h1{
                    margin-top: 23vh;
                    font-size: 4vh;
                }
                .choose{
                    flex-wrap: wrap;
                    justify-content: center;
                    flex-direction: column;
                    bottom: -50px;
                }
                .choose a{
                    font-size: 13px;
                }
                .card img{
                    display: none;
                }
            }
            /*========================*/
            /*          fav           */
            /*========================*/
            .fab{
                position: fixed;
                background-color: #FF8A65;
                bottom: 0;
                right: 0;
                margin: 20px;
                box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
                height: 45px;
                width: 45px;
                border-radius: 45px;
                color:  white;
                cursor: pointer;
                text-align: center;
                transition: all 250ms;
            }
            .fab:hover{
                background-color: #FF5722;
            }
            .fab i{
                font-size: 20px;
                line-height: 45px;
            }
            /*========================*/
            /*        footer          */
            /*========================*/
            footer{
            	padding: 35px 0px;
            	background-color: #424242;
            	width: 100%;
            	text-align:center;
            	color:white;
            	font-family:Raleway;
            	font-size: 14px
            }
        </style>

    </head>

    <body>

        <!--Search box-->
        <form id="search_box">
            <input type="text" autocomplete="off" class="search" placeholder="rechercher...">
        </form>

        <!--Header-->
        <header>
            <h1 class="">Envie d'apprendre à créer <span>un site web</span> ?<br>&lt;/codez-le&gt; !</h1>
            <div class="choose">
                <a href="#Débutant">Débutant</a>
                <a href="#Intermédiaire">Intermédiaire</a>
                <a href="#Confirmé">Confirmé</a>
            </div>
        </header>

        <!--Ajax loaded article-->
        <div class="article">
            <div class="close">
                <i class="material-icons">close</i>
            </div>
            <div class="data"></div>
            <div class="comment_box">
                <h4>Commentaires</h4>
                <div class="popup"></div>
                <form class="post_comment">
                    <input type="text" name="comment_author" placeholder="Votre pseudo" required autocomplete="off">
                    <textarea required name="comment_content" placeholder="Ecrivez votre commentaire..."></textarea>
                    <input type="submit" value="publier le commentaire">
                </form>
                <div class="comment_list"></div>
            </div>
        </div>

        <!--Article list-->
        <div class="content">
            <div class="data"></div>
        </div>

	<!--footer-->
	<footer>Licence GNU-GPL (copyleft)</footer>


        <script>

            //selecteur de niveau
            $(".choose a").on("click", function(e){
                $(".choose a").css({"background-color":"#FF8A65", "color":"white"})
                var lvl = $(this).attr("href");
                $.post("functions/load_all_article.php", {"lvl":lvl})
                .always(function(data){
                    $(".content .data").empty().html(data);
                });
                $(this).css({"background-color":"white", "color":"#FF8A65"})
            });

            //default level
            var hash = window.location.hash.substr(1);
            if(hash == undefined || hash == ""){
                hash = "Débutant";
            }
            hash = decodeURI(hash);
            $(".choose a[href=\"#"+hash+"\"]").css({"background-color":"white", "color":"#FF8A65"});
            $.post("functions/load_all_article.php", {"lvl":hash})
            .always(function(data){
                $(".content .data").empty().html(data);
            });

            //auto load article if needed
            var a = window.location.search.replace("?a=", "");
            if(a != undefined && a != ""){
                $(".comment_box").show();
                $.post("functions/load_one_article.php", {"article":a})
                .always(function(data){
                    $(".article").css({"visibility":"articleViewVisible","bottom":"0vh"});
                    $("body").css({"overflow":"hidden"});
                    $(".article .data").html(data);
                    //load comments
                    $.post("functions/load_comments.php", {"article":a})
                    .always(function(data){
                        $(".comment_list").empty().html(data);
                    })
                });
            }

            //search
            $("#search_box").on("submit", function(e){
                e.preventDefault;
                e.stopImmediatePropagation;
                var q = $("form .search").val();
                history.replaceState("", "", "?q="+q);
                $(".comment_box").hide();
                $.post("functions/search.php", {"q":q})
                .always(function(data){
                    $(".article").css({"visibility":"articleViewVisible","bottom":"0vh"});
                    $("body").css({"overflow":"hidden"});
                    $(".article .data").html(data);
                });

                return false;
            });

            //auto relaod search
            var q = window.location.search;
            if(q.includes("?q=")){
                q = q.substr(-4);
                if(q != undefined && q != ""){
                    $(".comment_box").hide();
                    $.post("functions/search.php", {"q":q})
                    .always(function(data){
                        $(".article").css({"visibility":"articleViewVisible","bottom":"0vh"});
                        $("body").css({"overflow":"hidden"});
                        $(".article .data").html(data);
                    });
                }
            }

            //publish comments
            $(".post_comment").on("submit", function(e){
                e.preventDefault;
                e.stopImmediatePropagation;
                var author = $(".post_comment input[type=text]").val(),
                    comment = $(".post_comment textarea").val(),
                    a = window.location.search.replace("?a=", "");
                if(author != "" && author != undefined && comment != "" && comment != undefined && a != ""){
                    $.post("functions/publish_comment.php", {"article":a, "author":author, "content":comment})
                    .always(function(data){
                        $(".popup").empty().html(data);
                        $(".post_comment textarea").val("");
                        $.post("functions/load_comments.php", {"article":a})
                        .always(function(data){
                            $(".comment_list").empty().html(data);
                        })
                    });
                }
                return false;
            });
        </script>

    </body>
</html>
