<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Inclusion du fichier CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    
    <!-- Inclusion du fichier JavaScript de Font Awesome -->
    <script src="https://kit.fontawesome.com/9876c79344.js" crossorigin="anonymous"></script>
    
    <!--Affichage dynamique de la variable $title-->
    <title><?= $title ?></title>
</head>
<body>
    <div class="container bg-dark">
        <header class="text-center text-light bg-dark">
            <h1>Application d'emprunt</h1>
        </header>
        <div class="d-flex">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <ul class="navbar-nav">   
                <li class="nav-item col-4 p-2">
                    <a class="nav-link text-light" href="index.php?controller=objets&action=index">Liste des articles</a>
                </li>
                <li class="nav-item col-4 p-2">
                    <a class="nav-link text-light" href="index.php?controller=inscrits&action=index">Liste des inscrits</a>
                </li>
                <li class="nav-item col-4 p-2">
                    <a class="nav-link text-light" href="index.php?controller=emprunt&action=index">Emprunts</a>
                </li>
            </ul>
        </nav>
        </div>
        <main>

            <!-- Contenu principal de la page, affiché dynamiquement -->
            <?= $content ?>
        </main>
    </div>

    <!-- Inclusion du fichier JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>