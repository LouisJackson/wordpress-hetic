module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          '../style.css' : '../sass/style.scss'
        }
      }
    },
    webfont: {
      icons: {
          src: '../icons/*.svg',
          dest: '../fonts',
          destCss: '../sass/helpers',
          options: {
              font: 'icons',
              stylesheet: 'scss',
              htmlDemo: false,
              types: 'eot,woff,ttf,svg'
          }
      }
    },
    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: ['../js/vendors/*.js', '../js/app/**/*.js'],
        dest: '../grandma-script.js',
      }
    },
    watch: {
      css: {
        files: '../**/*.scss',
        tasks: ['sass']
      },
      images: {
        files: '../icons/*.svg',
        tasks: ['webfont']
      },
      scripts: {
        files: ['../js/vendors/*.js', '../js/app/*.js', '../js/app/pages/*.js'],
        tasks: ['concat']
      }
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-webfont');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.registerTask('default',['watch']);
  grunt.registerTask('font',['webfont']);
  grunt.registerTask('js',['concat']);
}