var app = app || {};

app.Library = Backbone.Collection.extend({
    model: app.Book,

    url: '/app_dev.php/api/books',

    parse: function(response) {
        response.id = response._id;
        return response.books;
    }

});
