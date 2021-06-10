# Monte Carlo
La méthode de Monte Carlo permet d'évaluer la valeur de Pi de manière statistique.

## Logiciel
Le logiciel fonctionne en deux séquences. La première séquence réalise le tirage d'un point aussi aléatoire que possible et détermine s'il fait partie du cerle de rayon 1. La seconde gère la population statistique des points et compte le nombre de points dans le cercle afin de calculer l'approximation de Pi.

## Exemple de résultats

````csv
"Population";"Approx Pi";"déviation en % par rapport à Pi"
"100";"3.04";"3.2337946001276"
"1000";"3.084";"1.833231100919"
"10000";"3.1336";"0.25441406544735"
"100000";"3.14492";"0.1059127257127"
````