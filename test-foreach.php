<?php
    $fruits = [
        "pamplemousse",
        "Grenade",
        "Kiwi"
    ];

    foreach($fruits as $unFruit) {
        echo "<p>$unFruit</p>";
    }
    
    //Tableau associatif
    $groupe = [
        "e987656" => "Marc Morin",
        "e123445" => "Éloïse Bonin",
        "e548312" => "Monsieur Untel",
    ];

    foreach($groupe as $noDossier=>$nomPersonne){
        echo "<p>$nomPersonne (<i>$noDossier</i> )</p> ";
    }
?>