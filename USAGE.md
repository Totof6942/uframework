Utilisation
===========

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
