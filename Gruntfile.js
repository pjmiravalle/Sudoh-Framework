'use strict';
module.exports = function (grunt) {

    grunt.initConfig({
        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'assets/css/main.min.css': [
                        'assets/scss/main.scss'
                    ]
                }
            }
        },
        watch: {
            sass: {
                files: [
                    'assets/scss/*.scss',
                    'assets/scss/foundation/*.scss'
                ],
                tasks: ['sass']
            },
            livereload: {
                // Browser live reloading
                // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
                options: {
                    livereload: false
                },
                files: [
                    'assets/css/main.min.css',
                    '*.php'
                ]
            }
        },
        clean: {
            dist: [
                'assets/css/main.min.css'
            ]
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');

    // Register tasks
    grunt.registerTask('default', [
        'clean',
        'sass'
    ]);
    grunt.registerTask('dev', [
        'watch'
    ]);

};