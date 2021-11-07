<?php

function aleatoire($longueur,$choix="speciaux,chiffres,lettresmin,lettresmaj,tous"){
    $choix=explode(",",$choix);
    $ChaineAutiliser="";
    $CaracteresSpeciaux="#{[$@]*)}@^!:/.?,+-(";//mettez tous vos caractères spéciaux, faite attention que ces caractères sont susceptibles d'aller dans une base de données, suivant votre utilisation
    foreach($choix as $lechoix){
        switch($lechoix){
        case "speciaux":
            $ChaineAutiliser.=$CaracteresSpeciaux;
            break;
        case "chiffres":
            $ChaineAutiliser.="0123456789";
            break;
        case "lettresmin":
            $ChaineAutiliser.="abcdefghijklmnopqrstuvwxyz";
            break;
        case "lettresmaj":
            $ChaineAutiliser.="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            break;
        case "tous":
            $ChaineAutiliser="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ".$CaracteresSpeciaux;
            break;
            default:
            $ChaineAutiliser.="ABCDEFGHIJKLMNOPQRSTUVWXYZ";//si le choix n'est pas bon, on met une chaine par défaut
        }
    }
    $ChaineDeRetour="";
    for($i=1;$i<=$longueur;$i++){//notre chaine de retour contiendra le nombre de caractères demandés
        $ChaineDeRetour .= substr($ChaineAutiliser,rand(0,strlen($ChaineAutiliser)-1),1);//rand(1,le nombre de caractère total utilisables) + 1 nous permet de prendre un seul caractère aléatoirement, dans les types de chaines demandées, pour l'ajouter au fur et à mesure grâce à .= qui dit "ajouter à la suite"
    }
    return $ChaineDeRetour;
}