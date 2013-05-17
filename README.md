Backbone.js with symfony backend and FOSRestBundle
========================

This project is an example of an implementation of backbone.js with symfony + FOSRestBundle backend.
It is mainly inspired of William Durand tutorial about restfull interfaces on his blog [post](http://williamdurand.fr/2012/08/02/rest-apis-with-symfony2-the-right-way/).
The backbone.js part is part of the book written by @addyosmani on backbone.js see [here](http://addyosmani.github.io/backbone-fundamentals/#exercise-2-book-library---your-first-restful-backbone.js-app)

This application is pretty simple. The goal here is to make a single web page app to GET/POST/PUT/DELETE some books with the form.
The backbone.js part is under web/ forder

1) Installing the project
---------------------------------------

### Installation with vagrant (optional)

Use vagrant up to set up the machine

    vagrant up

and:
    vagrant provision

Once everything is ready, install the project dependencies:

    php composer.phar install

Setup the database:

    php app/console doctrine:database:create

Update the database:

    php app/console doctrine:schema:update --force

Enjoy the code :) by opening the index.html file


2) Work to be done
---------------------------------------

The project right now is very minimalist. The idea is to show a very simple implementation of FOSRestBundle working with a modern Javascript MV* library like backbone.

TODO:
*Implement PUT server/client side
*Implement PATCH server/client side
*Create a new entity nested with the Book entity
*Validate the datas client/server side
*Test the Rest api


I hope that people are going to participate in order to have a great app example!

Baptiste
