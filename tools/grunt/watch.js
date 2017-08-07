module.exports = {
    options: {
        spawn: false
    },
    sass: {
        files: [
            '<%= url.sass %>*.scss',
            '<%= url.sass %>**/*.scss'
        ],
        tasks: [
            'clean:webCss',
            'sass:dev'
        ]
    }
};