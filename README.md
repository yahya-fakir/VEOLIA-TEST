# Projet Prolosaures

## Description
Ce projet utilise un contrôleur Laravel (`ProlosauresController`) qui effectue plusieurs validations et calcule la superficie de la zone protégée en fonction des paramètres reçus.

## Choix de conception
- **Validation des entrées** : La largeur du terrain (`largeur`) et les altitudes (`terrain`) sont vérifiées pour s'assurer que les valeurs sont numériques et respectent les limites définies.
- **Mémoire et temps d'exécution** : Le temps d'exécution et la mémoire utilisée par le programme sont mesurés, afin d'évaluer les performances.
- **Calcul de la zone protégée** : La fonction `getSafezone` calcule la superficie de la zone protégée en comparant chaque altitude avec les altitudes précédentes.
- **Structure Laravel** : Le code utilise un contrôleur Laravel standard pour manipuler les données d'entrée et renvoyer une réponse JSON, ce qui permet une intégration facile avec des frontends ou des API.

## Prérequis
Avant d'exécuter ce code, vous devez avoir installé Laravel et configuré votre environnement de développement.

- **PHP** : Assurez-vous d'avoir PHP 8.2 ou une version supérieure.
- **Composer** : Laravel utilise Composer pour la gestion des dépendances. Assurez-vous d'avoir Composer installé.
- **Base de données** : Laravel utilise une base de données par défaut, mais pour ce projet spécifique, aucune base de données n'est nécessaire.

## Utilisation

### Accéder au contrôleur
- **URL** : `GET /prolosaures`

Vous pouvez tester l'API avec ces paramètres :
- `largeur` : La largeur du terrain (par défaut, 10).
- `terrain` : Les altitudes séparées par des espaces (par défaut, "30 27 17 42 29 12 14 41 42 42").

Exemple d'URL :
- http://127.0.0.1:8000/prolosaures?largeur=10&terrain=30 27 17 42 29 12 14 41 42 42


## Explication des fonctions

- **`index(Request $request)`** : Cette méthode est l'entrée principale de la logique. Elle récupère les valeurs de largeur et d'altitude, effectue les vérifications, puis calcule la superficie protégée.

- **`checkWidth($largeur)`** : Cette fonction vérifie que la largeur du terrain est valide (numérique et dans les limites définies).

- **`checkHeight($terrain)`** : Cette fonction vérifie que toutes les altitudes du terrain sont valides (numériques et dans les limites définies).

- **`getSafezone($largeur, $terrain)`** : La logique principale qui calcule la zone protégée en fonction des altitudes. Elle compare chaque altitude avec les montagnes précédentes pour déterminer l'abri disponible.

- **`convertToMemory($size)`** : Cette fonction convertit la taille de la mémoire utilisée en un format lisible (octets, Ko, Mo, etc.).
