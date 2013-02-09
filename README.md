µFramework 
==========

**µFramework** developped by **[Claude Dioudonnat](https://github.com/claudusd)** and **[Christophe Poulette](https://github.com/Totof6942)** for the PHP practicals supervised by [Julien Muetton](https://github.com/themouette) and [William Durand](https://github.com/willdurand).


### Utilisation ###

Le virtualhost doit pointer sur le dossier `/web` de l'application.

Mettre en place les blibliothèques nécessaires au bon fonctionnement de l'application :

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install --dev --prefer-source
```

Pour mettre en place la base de données :

``` bash
$ mysql uframework -uuframework -puframework123 < app/config/schema.sql
```

Pour injecter quelques données dans la base de données : 

``` bash
$ mysql uframework -uuframework -puframework123 < data/locations.sql
```


### Ce qu'il rest à faire ###

* Une méthode plus optimisée pour construire un objet extrait de la base de données afin déviter d'avoir des setId publique.

* Lié un commentaire à sa location, mais cette fonctionnalité n'étant pas vraiment utile dans cette application nous avons décidé de ne pas l'implémenter.

License
-------

uFramework is released under the MIT License. See the bundled LICENSE file for details.
