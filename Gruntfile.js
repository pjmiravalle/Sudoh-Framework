'use strict';
module.exports = function (grunt) {

    grunt.initConfig({
        jshint: {
            options: {
                jshintrc: '.jshintrc'
            },
            all: [
                'Gruntfile.js',
                'assets/js/*.js',
                'assets/js/plugins/*.js',
                '!assets/js/*.min.js',
                '!assets/js/plugins/*.min.js'
            ]
        },
        compass: {
            dev: {
                options: {
                    config: 'config.rb'
                }
            }
        },
        cssmin: {
            minify: {
                expand: true,
                cwd: 'assets/css/',
                src: 'main.css',
                dest: 'assets/css/',
                ext: '.min.css'
            }
        },
        uglify: {
            dist: {
                files: {
                    'assets/js/theme-scripts.min.js': [
                        'assets/js/theme-scripts.js'
                    ]
                }
            }
        },
        watch: {
            sass: {
                files: ['assets/scss/*.scss'],
                tasks: ['compass:dev', 'cssmin:minify']
            },
            js: {
                files: ['<%= jshint.all %>'],
                tasks: ['jshint', 'uglify']
            },
            livereload: {
                // Browser live reloading
                // https://github.com/gruntjs/grunt-contrib-watch#live-reloading
                options: {
                    livereload: true
                },
                files: [
                    'assets/css/main.min.css',
                    'assets/js/theme-scripts.min.js',
                    'templates/*.php',
                    '*.php'
                ]
            }
        },
        clean: {
            dist: [
                'assets/css/main.min.css',
                'assets/js/theme-scripts.min.js'
            ]
        }
    });

    // Load tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-cssmin');

    // Register tasks
    grunt.registerTask('default', [
        'clean',
        'uglify',
        'compass'
    ]);
    grunt.registerTask('dev', [
        'watch'
    ]);

};