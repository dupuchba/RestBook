var app = app || {};

app.Book = Backbone.Model.extend({
    default: {
        coverImage: 'img/placeholder.png',
        title: 'No title',
        author: 'Unknown',
        releaseDate: 'Unknown',
        keywords: 'Unknown'
    }
});

