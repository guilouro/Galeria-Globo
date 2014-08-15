var Gallery = {

    init: function(element, options){
        var base = this;
        base.$element = $(element);
        base.options = $.extend({}, $.fn.gallery.options, options);
        base.createElements();
        base.setParams();
        base.setDescription();
        base.setStyle();
        base.loadEvents();
    },

    setParams: function(){
        var base = this;
        base._itens = $(".content").find(".item").length;
        base.$content = $(".content");
        base.$controls = $(".controls");
        base.$description = $(".description");
        base._item_atual = 0;
        base._width = base.options.width;
    },

    setStyle: function(){
        var base = this;
        base.$element.css('width', base.options.width);
        base.$element.css('height', base.options.height);
        base.$element.css('overflow', "hidden");
        base.$element.css('position', "relative");
        base.$content.css('width', base._itens * base._width);
        base.$controls.css('width', base.options.width);
        base.$controls.css('top', -(base.options.height/2+50));
        base.$description.css('width', base.options.width);
    },

    setDescription: function(){
        var base = this;
        base.$description.html((base._item_atual + 1 ) + " de " + base._itens);
    },

    createElements: function(){
        var base = this;
        // create content
        base.$element.html("<div class=\"content\">" + base.$element.html() + "</div>");
        // create controls
        base.$element.after("<div class=\"controls\"><img id=\"prev\" src=\"img/seta_esquerda.jpg\"><img id=\"next\" src=\"img/seta_direita.jpg\"></div>");
        // create descriptions
        if(base.options.description){
            base.$element.append("<div class=\"description\"></div>");
        }
    },

    loadEvents: function(){
        var base = this;
        $(".controls img").on("click", function(){
            if(this.id === "prev"){
                base.prev();
            }else{
                base.next();
            }
            base.setDescription();
        });
    },

    prev: function(){
        var base = this;
        if (base._item_atual > 0){
            $(".content").animate({left: -(base._width*(--base._item_atual))}, base.options.velocity);
        }
    },

    next: function(){
        var base = this;
        if (base._item_atual < base._itens-1){
            $(".content").animate({left: -(base._width*(++base._item_atual))}, base.options.velocity);
        }
    }
};


$.fn.gallery = function(options){
    return this.each(function(){
        var gallery = Object.create( Gallery );
        gallery.init( this, options );
    });
};

$.fn.gallery.options = {
    velocity: 500,
    width: 800,
    height: 600,
    description: true
};