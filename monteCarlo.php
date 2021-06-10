<?php
/***********
 * Approximation du nombre Pi avec la méthode de MonteCarlo
 *
 * BM - Préparation Grand Oral
 * 05/06/2021
 *
 * Etude de l'influence du nombre de tirages sur l'approxamation de Pi
 * La fonction lanceLesEvaluations génère N tirages de taille M. Entre chaque lancé de tirages, la taille M est multipliée par le facteur de croissance.
 *
 *************/
 
//Définition de PI de manière plus précise que M_PI
define('__pi', 3.141592653589793238462643383280);
//Tableau qui recevra les approxuimations de Pi
$tableauEvaluations = array(array("Population", "Approx Pi", "déviation en % par rapport à Pi"));


/************** Exécution de la simulation *****************/

lanceLesEvaluations(4, 100, 10, $tableauEvaluations);
afficheResult($tableauEvaluations);
exit(0); //fin du traitement

/************** Partie fonctionnelle *****************/

/*
 * Fonction qui réalise un tirage aléatoire d'un point (x, y) dans [0, 1]
 * Elle évalue si le point fait partie du cercle centré à l'origine, de rayon 1
 * Renvoi 1 si oui, 0 sinon
 */

function unTirage() {
	// mt_rand renvoie un nombre aléatoire entier entre 0 et un nombre maximum.
	// Pour obtenir un nombre entre 0 et 1, ce tirage aléatoire est divisé par la valeur max du langage PHP
	 mt_srand(); //ré-initalisation du générateur de nombre aléatoires
	 $x = mt_rand() / mt_getrandmax(); //Nombre aléatoire entre 0 et 1
	 
	 mt_srand(); //ré-initalisation du générateur de nombre aléatoires
	 $y = mt_rand() / mt_getrandmax(); //Nombre aléatoire entre 0 et 1
	 
	 //Si le point aléatoire est dans le cercle de rayon 1, alors 1 est renvoyé, sinon 0 est renvoyé
	 $z = ((($x*$x) + ($y*$y)) > 1) ? 0 : 1;
	 return $z;
 }

/*
 * Fonction qui réalise une évaluation de Pi sur un population de N points
 * Calcule le nombre de points faisant partie du cercle et tente d'évaluer Pi en utuilisant la loi de probabilité de faire partie du cercle
 * Renvoi un tableau avec la taille de l'échantillon, l'évaluation de Pi et le ratio de déviation par rapport à Pi
 */
 
function lanceUneEvaluationPi ($taillePopulation, &$resultat) {
	//Réalise un tirage au sort de N points dans le carré de coté 1 et compte le nombre d'occurrence de ces points dans le cercle de rayon 1
	//Calcule ensuite l'approximation de Pi et le % de variation par rapport à Pi
	$estDansCercle = 0;
	for ($j =1; $j <= $taillePopulation; $j++) {
		$estDansCercle += unTirage();
	}
	$evaluationPi = 4 * ($estDansCercle / $taillePopulation);
	$variation = (abs(__pi - $evaluationPi) / __pi) * 100;
	
	//Retour du résultat sous la forme d'un tableau (population, evaluation de pi, écart par rapport à pi)
	$resultat[] = array($taillePopulation, $evaluationPi, $variation);
}

/*
 * Fonction lance un nombre déterminé d'évaluation et augmente la taille de la population d'un facteur à cahque occurence
 */

function lanceLesEvaluations ($nombreTirages, $taillePopulationInitiale, $facteurCroissance, &$resultat) {
	//Lance N évaluations de Pi avec une taille d'échantillon qui grandi de FacteurCroissance à chaque itération
	for ($i = 1 ; $i <= $nombreTirages; $i++)  {
		lanceUneEvaluationPi ($taillePopulationInitiale, $resultat);
		$taillePopulationInitiale *= $facteurCroissance;
	}
}
/*
 * Fonction qui met en forme CSV le tableau de résultat
 */
function afficheResult($array) {
	foreach($array as $ligne) {
		echo "\"" . implode("\";\"",$ligne) . "\"<br/>\r\n";
	}
}

?>