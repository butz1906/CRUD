<?php $title = "Liste des emprunts";
?>
<h1 class='text-light'>Liste des emprunts</h1>
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
            foreach ($list as $value){
                echo "<tr>";
                echo "<td>".$value->id_objet."</td>";
                echo "<td>".$value->nom." ".$value->prenom."</td>";
                echo "<td>".$value->date_emprunt."</td>";
                echo "<td>".$value->date_retour."</td>";
                echo "<td><a class='text-danger' href='index.php?controller=emprunt&action=retour&nom=$value->id_objet'>Retour du objet</i></a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>