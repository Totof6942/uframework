Utilisation
===========

Le virtualhost doit pointer sur le dossier `/web` de l'application.

Puis lancer cette commande pour permettre au serveur la modification du fichier de données :

``` bash
$ chmod 644 data/locations.json
```

ou 

``` bash
$ chown www-data:www-data data/locations.json
```