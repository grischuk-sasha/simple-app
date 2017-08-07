module.exports = {
    options: {
        style: 'expanded'
    },
    prod: {
        options: {
            style: 'compressed',
            sourcemap: 'none'
        },
        files: {
            '<%= url.webCss %>vendor.min.css': '<%= url.sass %>vendor.scss'
        }
    },
    dev: {
        files: {
            '<%= url.webCss %>vendor.min.css': '<%= url.sass %>vendor.scss'
        }
    }
};