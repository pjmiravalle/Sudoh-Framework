/* ----------------------------------------------------------------------- *|
/* ------ Theme Scripts -------------------------------------------------- *|
/* ----------------------------------------------------------------------- */

jQuery(document).ready( function($) {

    var SudohTheme = {

        /**
         * General scripts.
         *
         * Scripts added to this function will run on every page.
         */
        general: function() {

            // General scripts go here

        },

        /**
         * Page specific scripts.
         *
         * These functions directly correlate to the current page's slug.
         *
         * Inspired by Roots.
         */
		pages: {

            home: function() {
                
                // Custom Javascript here

            },
            about: function() {

                // Custom Javascript here

            },
            contact: function() {

                // Custom Javascript here

            }

        },

        /**
         * Breakpoint specific scripts.
         *
         * Useful for running code within certain screensizes. A good example
         * for this would be Lightboxes. Not so pretty on mobile devices, so
         * we would only enable it for larger screen sizes, and have a fallback
         * of some sort on mobile devices.
         *
         * Author: Patrick Miravalle
         */
        breakpoints: [

            // 768 - 1024
            {
                from: 768,
                to: 1024,
                callback: function() {

                    // Custom Javascript here

                }
            },

            // 768 and up
            {
                from: 9999,
                to: 768,
                callback: function() {

                    // Custom Javascript here

                }
            },

            // 768 and below
            {
                from: 768,
                to: 0,
                callback: function() {

                    // Custom Javascript here

                }
            }

        ]

	};

    /* ----------------------------------------------------------------------- *|
    /* ------ Loader --------------------------------------------------------- *|
    /* ----------------------------------------------------------------------- */

    (function() {

        // Run general scripts
        SudohTheme.general();

        // Run page specific scripts
        $.each( SudohTheme.pages, function(key) {

            if ( $('body').hasClass(key) )
                this();

        });

        // Run breakpoint specific scripts, if we have any
        if ( SudohTheme.breakpoints[0] ) {

            function checkBreakpoints() {

                var width = $(this).width();

                $.each( SudohTheme.breakpoints, function() {

                    // if current width resides between the two breakpoints
                    if ( this.to <= width && width <= this.from )
                        this.callback();

                });

            }

            // Run on page load and window resize
            checkBreakpoints();
            $(window).resize( checkBreakpoints );

        }

    })();

});// Theme Scripts