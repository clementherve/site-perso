<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>A propos</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/header.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            article{
                display: block;
                margin: 0px auto;
                width: calc(90vw - 30px);
                min-width: 250px;
                background-color: white;
                max-width: 900px;
                padding: 15px;
                border-radius: 5px;
                color: #424242;
                line-height: 1.7;
            }
            .social{
                display: flex;
                justify-content: center;
            }
            .social a{
                width: 50px;
                height: 50px;
                border-radius: 50px;
                margin: 20px;
            }
            p a {
                color: #5C6BC0;
                font-weight: 500;
            }
        </style>
    </head>
    <body>

        <?php include_once("include/header.php"); ?>

        <article>

            <div class="social">
                <a href="https://github.com/clementherve" target="_blank"><img src="/img/github.png"></a>
                <a href="https://twitter.com/Cl6ment" target="_blank"><img src="/img/twitter.png"></a>
                <a href="https://www.linkedin.com/in/clement-herve/" target="_blank"><img src="/img/linkedin.png"></a>
                <a href="https://tryhackme.com/p/rda" target="_blank"><img src="/img/tryhackme2.png"></a>
            </div>

            <h2>Hello!</h2>
            <p>
                Je suis étudiant en 4ème année d'informatique. Passionné & touche à tout, ce site est le reflet de mes expérimentations. Il tourne sur un vieux téléphone Android à l'aide de Proot. J'écris rarement sur le blog, la plupart des articles remontent au lycée !
            </p>

            <h3>En dehors de l'informatique</h3>
            <p>
                Plus jeune, je dévorais les livres policiers, les romans noirs et les bandes dessinées.
                Maintenant, j'ai moins le temps de lire, mais je continue à squatter de temps à autre les bibliothèques
                pour dénicher de quoi occuper mes parcelles de temps libre.
            </p>
            <p>
                Plus jeune, je me suis pris de passion pour le cyclisme, j'ai participé à des compétitions quand j'étais au collège. Je me suis depuis essayé à d'autre sport (tennis, basket, dance, escrime). A l'université, je fais de la musculation.
            </p>

            <h3>Associations, emplois, etc.</h3>
            <p>
                Aimant transmettre ce que je sais, j'ai fais partie de deux associations: la <a href="http://maisondesseniors.mions.fr">maison des séniors</a> et <a href="http://mions.reussite.free.fr/">Mions réussite solidarité</a>. Le temps me manquant, je me
                suis restreint à une seule que j'aide régulièrement. Son but est d'enseigner les bases de l'informatique aux séniors.
            </p>
            <p>
                Je donne également des cours de mathématiques à domicile via SuperProf. J'ai aidé plusieurs collégiens à passer leur brevet avec succès.
            </p>
            <p>
                En 2018, j'ai travaillé en intérim comme préparateur de commande. Il s'agissait d'un travail physique où le plus important était de tenir la cadence et les quotas de production. En 2020, j'ai été stagiaire à l'IFPEN. J'ai conceptualisé et développé dans des délais cours une application de monitoring d'un batiment à énergie positive.
            </p>
            <p>
                Je suis également auto-entrepreneur. Je développe en freelance des sites internet. Pour le plaisir, je créé également des applications que je pense etre "utiles": Oloid (app pour les étudiants), Recettes (app pour trouver des recettes de cuisine), TCL (app de transport en communs).
            </p>
        </article>
    </body>
</html>
