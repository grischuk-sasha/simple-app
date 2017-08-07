module.exports = function(grunt) {


    var path = require('path');

    console.log(path.join(process.cwd(), 'assets/'));


    require('load-grunt-config')(grunt, {
        configPath: path.join(process.cwd(), 'tools/grunt'),
        init: true,
        data: {
            pkg: grunt.file.readJSON('package.json'),
            url: {
                bower: 'bower_components/',
                node_modules: 'node_modules/',
                assets: path.join(process.cwd(), 'assets/'),
                sass: '<%= url.assets %>sass/',
                js: '<%= url.assets %>js/',
                web: path.join(process.cwd(), 'web/'),
                webCss: '<%= url.web %>css/',
                webJs: '<%= url.web %>js/'
            }
        },
        loadGruntTasks: {
            pattern: 'grunt-*',
            config: require('./package.json'),
            scope: 'devDependencies'
        },
        postProcess: function(config) {},
        preMerge: function(config, data) {}
    });
};