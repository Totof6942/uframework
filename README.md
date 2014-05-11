µFramework 
==========

[![Build Status](https://travis-ci.org/Totof6942/uframework.svg?branch=master)](https://travis-ci.org/Totof6942/uframework)

**µFramework** developed by **[Claude Dioudonnat](https://github.com/claudusd)** and **[Christophe Poulette](https://github.com/Totof6942)** for the PHP practicals supervised by [Julien Muetton](https://github.com/themouette) and [William Durand](https://github.com/willdurand).

Installation
------------

Run these two commands to install it:

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install --dev --prefer-source
```

Install the database:

``` bash
$ mysql u<user> -p<password> <database> < app/config/schema.sql
```

If you want, there is a set of datas in `data/locations.sql`

TODO
----

* Hydratation

License
-------

uFramework is released under the MIT License. See the bundled LICENSE file for details.
