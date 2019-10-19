const purgecss = require('@fullhuman/postcss-purgecss')({
    content: ['./public/*.php'],
    defaultExtractor: content => content.match(/[\w-/:]+(?<!:)/g) || []
});

module.exports = {
    plugins: [
        require('tailwindcss'),
        require('autoprefixer'),
        require('cssnano'),
        // Comment the line below in developement mode
        // purgecss
    ]
};