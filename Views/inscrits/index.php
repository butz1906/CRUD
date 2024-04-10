<?php $title = "inscrits"?>
    <h2 class="text-light">Liste des inscrits</h2>
    <table class="table text-light">
        <thead>
            <tr class='d-flex'>
                <th class='col-2'>Numéro d'adhérent</th>
                <th class='col-4'>Nom</th>
                <th class='col-4'>Prénom</th>
                <th class="col-2"></th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Parcours de la liste des inscrits
            foreach ($list as $value){
                echo "<tr class='d-flex'>";
                echo "<td class='col-2'>".$value->id_inscrit."</td>";
                echo "<td class='col-4'>".$value->nom."</td>";
                echo "<td class='col-4'>".$value->prenom."</td>";
                echo "<td class='col-2'><a class='text-danger' href='index.php?controller=inscrits&action=modifier&id=$value->id_inscrit'>Modifier</i></a></td>";

                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php?controller=inscrits&action=add"><button format="button" class="btn btn-dark text-warning">Nouvelle inscription</button></a>