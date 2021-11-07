<?php



    // if (isset($_POST['longueur'])){$longueur = $_POST['longueur'];} else {$longueur = null;};
    // if (isset($_POST['chiffres'])){$chiffres = $_POST['chiffres'];} else {$chiffres = null;};
    // if (isset($_POST['maj'])){$maj = $_POST['maj'];} else {$maj = null;};
    // if (isset($_POST['speciaux'])){$speciaux = $_POST['speciaux'];} else {$speciaux = null;};

function generationMdP($longueur, $chiffres , $maj, $speciaux){

    if ($chiffres != null && $maj != null && $speciaux != null){
        $mdp2=aleatoire($longueur,"tous");
    }
    if ($chiffres == null && $maj != null && $speciaux != null){
        $mdp2=aleatoire($longueur,"lettresmin,lettresmaj,speciaux");
    }

    if ($chiffres != null && $maj == null && $speciaux != null){
        $mdp2=aleatoire($longueur,"lettresmin,chiffres,speciaux");
    }

    if ($chiffres != null && $maj != null && $speciaux == null){
        $mdp2=aleatoire($longueur,"lettresmin,lettresmaj,chiffres");
    }
    
    if ($chiffres == null && $maj == null && $speciaux != null){
        $mdp2=aleatoire($longueur,"lettresmin,speciaux");
    }
    if ($chiffres == null && $maj != null && $speciaux == null){
        $mdp2=aleatoire($longueur,"lettresmin,lettresmaj");
    }
    if ($chiffres != null && $maj == null && $speciaux == null){
        $mdp2=aleatoire($longueur,"lettresmin,chiffres");
    }

    if ($chiffres == null && $maj == null && $speciaux == null){
        $mdp2=aleatoire($longueur,"lettresmin");
    }

    return $mdp2;
}
