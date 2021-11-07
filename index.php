<?php
include "password.php";
if (isset($_POST['longueur'])){$longueur = $_POST['longueur'];} else {$longueur = null;};
if (isset($_POST['chiffres'])){$chiffres = $_POST['chiffres'];} else {$chiffres = null;};
if (isset($_POST['maj'])){$maj = $_POST['maj'];} else {$maj = null;};
if (isset($_POST['speciaux'])){$speciaux = $_POST['speciaux'];} else {$speciaux = null;};
if (!empty($_POST['nbMdp'])){$nbMdp = $_POST['nbMdp'];} else {$nbMdp = null;};
if (!empty($_POST['count'])){
    $count = $_POST['count'];
    //on va effectue un compteur de clic
    //On récupère le contenu du fichier pour le comptage
    $valeur = file_get_contents('file/count');

    //On ajoute notre nouveau texte à l'ancien
    $compte = $valeur + $count;

    //On écrit tout le texte dans notre fichier
    file_put_contents('file/count', $compte);
} else {$compte = file_get_contents('file/count');};

include "verification.php";


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Super Générateur de Mot de Passe</title>
</head>
<body>
    <div class="encadrementNature">
        <div class="arbre">
            <img src="img/tree-title.png" alt="arbrisseau">
        </div>
        <div>
            <p>Tous les <span class="chiff">10.000</span> clics, un arbre est replanté</br>
            Nous sommes à <span class="chiff"><?php echo $compte ?></span> clics, nous avons donc fait replanter <span class="chiff"><?php echo intval($compte / 10000) ?></span> arbres.</br>
            Encore <span class="chiff"><?php echo 10000-fmod($compte , 10000) ?></span> clics, et un autre arbre sera replanté.</br>
            La nature vous en remercie.</p>
        </div>

    </div>
    <div class="encadrementBlc titre">
        <h1>GreenPass</h1>
        <h2>Le générateur de mot de passe bon pour notre planète</h2>
    </div>

    <div class="encadrementBlc contenu">
        <div class="formulaire">
            <form action="#" method="post"> 
                <div class="donnees">
                    <div class="donnees-bis"> 
                        <div>
                            <label>Combien de mot de passe souhaitez vous générer?</label>
                            <input type="range" name="nbMdp" value="1" min="1" max="50" oninput="this.nextElementSibling.value = this.value">
                            <output>1</output>
                        </div>
                        <div>
                            <label>Choisissez la longueur du mot de passe</label>
                            <input type="range" name="longueur" value="10" min="6" max="50" oninput="this.nextElementSibling.value = this.value">
                            <output>10</output>
                        </div>
                    </div>
                    <div class="donnees-bis">
                        <div class="checkinline">
                            <input type="checkbox" id="maj" name="maj">
                            <label for="maj">Majuscules</label>
                        </div>

                        <div class="checkinline"> 
                            <input type="checkbox" id="chiffres" name="chiffres">
                            <label for="chiffres">Chiffres</label>
                        </div>

                        <div class="checkinline">
                            <input type="checkbox" id="speciaux" name="speciaux">
                            <label for="speciaux">Caractères spéciaux</label>
                        </div>
                        <input name="count" type="hidden" value="1">
                    </div>
                </div>
                <div class="form-example">
                
                <button type="submit" name="btnEnvoiForm" title="Envoyer"><img class="button-generer" src="img/buttonGenerer.png" alt="" /></button>
                </div>

            </form>

        </div>
        <div class="resultats">
            <?php
            
            //1 seul mot de passe choisit
                if (!empty($_POST['nbMdp']) && $_POST['nbMdp'] == 1){
            ?>
                <div>
                    <h3>Votre mot de passe est le suivant :</h3>
                    <div class="tocopy">
                        <span id="tocopy"><?php 
                        $mdp2 = generationMdP($longueur, $chiffres , $maj, $speciaux);
                        echo $mdp2; ?></span>
                    </div>
                </div>
                <div class="form-example">
                    <!-- <input type="button" value="Copier le mot de passe" class="js-copy" data-target="#tocopy"> -->
                    <button type="submit" name="btnEnvoiForm" title="Envoyer" class="js-copy" data-target="#tocopy"><img class="button-generer" src="img/buttonCopie.png" alt="" /></button>
                </div>
           <?php 
            } 

                elseif(!empty($_POST['nbMdp']) && $_POST['nbMdp'] >= 2){ ?>
                <div class="liste">
                    <div >
                        <h3>Voici vos mots de passes</h3></br>
                        <div class="liste_mdp">
                            <?php 
                            file_put_contents('file/mots_de_passe.txt', 'Mots de passes générés:');
                                for ($i = 1; $i <= $nbMdp; $i++) { 

                                    $mdp2 = generationMdP($longueur, $chiffres , $maj, $speciaux);
                                    echo $mdp2."</br>----------</br>";
                                    //On récupère le contenu du fichier
                                    $texte = file_get_contents('file/mots_de_passe.txt');

                                    //On ajoute notre nouveau texte à l'ancien
                                    $texte .= "\n".$mdp2."\n";

                                    //On écrit tout le texte dans notre fichier
                                    file_put_contents('file/mots_de_passe.txt', $texte);
                                } ?>
                        </div>
                    </div>
                    <div class="download">
                            <a href="file/mots_de_passe.txt" download="mots_de_passe.txt"><img src="img/buttonDownload.png" id="down" alt="down"></a>
                            
                        
                    </div>
                </div>
            <?php
            }

                // lorsque pas de mot de passe
                elseif (empty($_POST['nbMdp'])){ 
                    ?> 
                    <div class="noPasse">
                    <p>Pas de mot de passe encore généré</p>
                    </div>
                <?php } ?>
        </div>   
      
    </div>

    <script src="copy.js"></script>
</body>
</html>