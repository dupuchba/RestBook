var app = app || {};

app.LibraryView = Backbone.View.extend({

    el: '#books',

    events: {
        'click #add': 'addBook'
    },

    initialize: function(initialBooks) {
        //this.collection = new app.Library(initialBooks);
       this.collection = new app.Library();
       this.collection.fetch({
           reset: true,
           success: function(collection) {
               console.log("yeah");
           }
       });

       this.render();

       this.listenTo(this.collection, 'add', this.renderBook);
       this.listenTo(this.collection, 'reset', this.render);
    },

    render: function() {
        this.collection.each(function(item){
            this.renderBook(item);
        }, this);
    },

    renderBook: function(item) {
        var bookView = new app.BookView({
           model: item
        });
    this.$el.append(bookView.render().el);
    },

    addBook: function(e) {
        e.preventDefault();

        var formData = {};

        $('#addBook div').children('input').each( function(i, el) {
            if($(el).val() != '') {
                if(el.id === 'releaseDate') {
                    formData[el.id] = $('#releaseDate').datepicker('getDate').getTime();
                }
                else {
                    formData[el.id] = $(el).val();
                }
            }
            $( el ).val('');
        });
        this.collection.create(new app.Book(formData));
    }

});
