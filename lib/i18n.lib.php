<?php

/**
 * Obtient la collection des langues disponibles
 * @return array Tableau des codes de langues. 
 */
function obtenirLanguesDisponibles()
{
    $languesDispo = [];
    $contenuI18n = scandir('i18n');
    for ($i = 0; $i < count($contenuI18n); $i++) {
        $fichier = $contenuI18n[$i];
        if ($fichier != '.' && $fichier != '..') {
            $languesDispo[] = substr($fichier, 0, 2);
        }
    }
    return $languesDispo;
}


/**
 * Détermine la langue d'affichage active du site.
 * @param array $languesPermises Tanleau des codes de langues disponibles.
 * @return string code ISO-839-1 (en 2 lettres) de la langue active.
 */
function determinerLangue($languesPermises){
    $langue = 'fr';

if (isset($_COOKIE['choixLangue']) && in_array($_COOKIE['choixLangue'], $languesPermises)) {
	$langue = $_COOKIE['choixLangue'];
}

if (isset($_GET['lan']) &&  in_array($_GET['lan'], $languesPermises)) {
	$langue = $_GET['lan'];
	setcookie('choixLangue', $langue, time() + 30 * 24 * 3600);
}
return $langue;
}



/**
 * obtient les textes statiques de la page spécifique à partir du fichier JSON
 * dans la langue spécifique par son code
 * @param string $codeLangue Code en deux lettres de la langue d'affichage
 * @param string $nomPage Nom de la page requise 
 * @return array Tableau contenant des raccourcis pour les textes de la page
 * du pied de page, et du contenu de la page spécifique(sous formes d'objet
 * PHP)
 */
function obtenirTextesStatistiques($codeLangue, $nomPage){
    $textesJSON = file_get_contents("i18n/" . $codeLangue . ".json");
$textes = json_decode($textesJSON);
// Variables raccourcis pour les parties communes
$_ent = $textes->entete;
$_pp = $textes->pp;
// Variable raccourci pour toutes les pages spécifiques
$_ = @$textes->$nomPage;
return [$_ent, $_pp, $_];
}

/**
 * 
 * @param string $codeLangue
 */

function determinereDirectionEcriture($codeLangue){
    return in_array($codeLangue, ["ar", "he", "fa", "ur", "dv", "ps", "ku"])
	? 'rtl' : 'ltr';
}