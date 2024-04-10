<?php $title = "Articles"?>
    <h2 class="text-light">Liste des articles</h2>
    <table class="table text-light">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope='col'>Format</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Parcours de la liste des articles
            foreach ($list as $value){
                echo "<tr>";
                echo "<td>".$value->titre."</td>";
                echo "<td>".$value->format."</td>";
                
                // Utilisation de rawurlencode pour échapper les caractères spéciaux dans le nom du fichier
                $encodedTitle = rawurlencode($value->titre);
                echo "<td><img src='image/$encodedTitle.jpg' width='110' height='164'></td>";
                
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php?controller=objets&action=add"><button format="button" class="btn btn-dark text-warning">Ajouter un article</button></a>