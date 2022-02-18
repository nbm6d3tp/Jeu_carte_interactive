# PWEBC
Jeu intégré la carte interactive
Un jeu avec 3 modes:

- Mode de deviner l'origine d'un objet/un culture:
    - Il y a une liste d’objets/cultures sous forme des blocs DIV qu’on peux glisser et laisser tomber sur la carte
    - Il faut que le joueur trouve sur la carte le pays qui est l’origine de l’objet/de la culture (par déplacer/zoom (à un niveau raisonnable) la carte à un pays → glisser et laisser tomber le bloc DIV de l’objet sur ce pays)
    - Si vrai, le bloc DIV reste sur la carte, affiche le message de felicitation, augmente les points du joueur
    - Si faux, le bloc DIV retourne à la liste d’objets, affiche le message “c’est faux”.
    - Le jeu se termine lorsque toutes les cartes sont placées dans leurs positions correctes sur la carte. Le temps est enregistré sur BDD
- Mode d’entrainer pour la mode au-dessus:
    - Il y a une liste d’objets/cultures sous forme des blocs DIV qu’on peux glisser et laisser tomber sur la carte
    - Glisser un object sur la carte affichera immédiatement le pays qui est son origine (identique à la technique dans le fichier \projet MAP 2022\ressources projet MAP\demo_MAP leaflet CliquerGlisser\map.html) +  affiche des informations supplémentaires de l'objet (descriptions, images, ...)
    - Ce mode aide le joueur à mémoriser/apprendre brièvement les réponses pour la mode “Mode de deviner l'origine d'un objet/un culture”
- Mode de trouver les tresors:
    - Chaque tour générera au hasard 10 objets dans 10 emplacements aléatoires sur la carte
    - La mission est de les trouver (par déplacer/zoom (à un niveau raisonnable) la carte) en fonction des indices
    - 3 types d’indice:
        - Position relative du trésor le plus proche à partir de 1 point sélectionné (Ex: Cliquer sur l’indice ⇒ choisir n'importe quel point sur la carte -> "le trésor le plus proche de vous est à 200 km au sud de vous”) (2 indice)
        - Dans quelle région/continent se trouve un trésor sur la carte (Europe, Asie, Asie du Sud-Est, ...) ? (3 indice)
        - Trouver exactement 1 trésor (1 indice)
        - Donner un indice sur les caractéristiques du lieu du trésor (dans le pays avec la plus grande superficie du monde, dans le pays où sont nés les spagetti, ... ) (2 indice)
    - Le jeu se termine lorsque tous les trésors sont trouvés. Le temps est enregistré sur BDD
