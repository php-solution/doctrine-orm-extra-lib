# Doctrine ORM extra lib

## Install
``` bash
$ composer require php-solution/doctrine-orm-extra-lib
```

## Structure

* **Aware** - The group of traits, which give ability other classes be aware about doctrine services

* **Entity** - The group of traits, which extend the entity by adding frequently used fields

* **ORM** - Here is the doctrine extra functionality 

    * **EventListener** - Listeners for working with cached tables 
    * **Query** - Additional MySQL statements
    * **Repository** - Repositories for caching tables