<?php $title = "Emprunts"?>
    <h2 class="text-light">Liste des emprunt(s)</h2>
    <table class="table text-light">
        <thead>
            <tr>
                <th scope="col">Titre de l'objet</th>
                <th scope='col'>Nom de l'inscrit</th>
                <th scope='col'>Date d'emprunt</th>
                <th scope='col'>Date du retour</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Boucle pour afficher chaque emprunt dans une ligne du tableau
            foreach ($list as $value){
                echo "<tr>";
                echo "<td>".$value->titre."</td>";
                echo "<td>".$value->nom." ".$value->prenom."</td>";
                echo "<td>".$value->date_emprunt."</td>";
                echo "<td>".$value->date_retour."</td>";

                // Lien pour effectuer le retour de l'objet emprunté
                echo "<td><a class='text-danger' href='index.php?controller=emprunt&action=retour&id=$value->id_objet'>Retour</i></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php?controller=emprunt&action=add"><button format="button" class="btn btn-dark text-warning">Emprunter un objet</button></a>