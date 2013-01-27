µFramework 
==========

**µFramework** developped by **[Claude Dioudonnat](https://github.com/claudusd)** and **[Christophe Poulette](https://github.com/Totof6942)** for the PHP practicals supervised by [Julien Muetton](https://github.com/themouette) and [William Durand](https://github.com/willdurand).


### Utilisation ###

Le virtualhost doit pointer sur le dossier `/web` de l'application.

Puis lancer cette commande pour permettre au serveur la modification du fichier de données :

``` bash
$ chmod 644 data/locations.json
```

ou 

``` bash
$ chown www-data:www-data data/locations.json
```

### Ce qu'il rest à faire ###

Les quatre points suivants n'ont pas été fait par manque de temps, et oui il faut réviser le Java aussi...

* La classe `Locations` doit manipuler un tableau de `Location` pour plus de souplesse.
* La classe `Locations` doit utiliser la classe `Serializer` de Symfony pour la sauvegarde et la lecture des données directement dans le format dans la classe `Location`. (Cette partie à tout de même été commencée dans la branche `serializer`).
* Des tests unitaires.
* Blinder un peu plus la classe `Locations` pour pas que les utilisateurs puissent faire n'importe quoi et mieux gérer les erreurs.
