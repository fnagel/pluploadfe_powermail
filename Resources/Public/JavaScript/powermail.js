(function( $, window ) {
  var pluginName = "pluploadFePowermail",
    defaults = {
      selector: {
        field: ".powermail_fieldwrap_type_pluploadfe",
        identifier: ".tx-pluploadfe-pi1 > *"
      }
    };

  function Plugin ( element, options ) {
    this.window = $( window );
    this.element = $( element );

    this.defaults = defaults;
    this.options = $.extend( true, {}, defaults, options );

    if ( !this.element.is( "form" ) ) {
      return;
    }

    this.init();
  }

  $.extend( Plugin.prototype, {

    init: function() {
      var that = this;

      this.promises = [];

      // Catch form submit
      this.element.on( "submit.pluploadfe", function(event) {
        event.preventDefault();

        that.element.find( that.options.selector.field ).each(function() {
          that.initPlupload($(this));
        });

        $.when.apply( $, that.promises ).done(function() {
          that.submit();
        });
      });
    },

    initPlupload: function(parent) {
      var promise = $.Deferred(),
        element = parent.find( this.options.selector.identifier ),
        instance = element.pluploadQueue();

      if ( instance.files.length > 0 ) {
        instance.start();
        instance.bind( "UploadComplete", function() {
          promise.resolve( "Upload complete" );
        });
      } else {
        promise.resolve( "No files given" );
      }

      this.promises.push(promise);
    },

    submit: function() {
      this.element.off( "submit.pluploadfe" );
      this.element.submit();
    }
  } );

  $.fn[ pluginName ] = function( options ) {
    return this.each(function() {
      if ( !$.data( this, "plugin_" + pluginName ) ) {
        $.data( this, "plugin_" + pluginName, new Plugin( this, options ) );
      }
    });
  };

} )( jQuery, window );
