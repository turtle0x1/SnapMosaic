const { src, dest, parallel } = require('gulp');
const concat = require('gulp-concat');
const minify = require('gulp-minify');
const cleanCSS = require('gulp-clean-css');
const replace = require("gulp-replace");

function css(){
    return src([
        "node_modules/bootstrap/dist/css/bootstrap.min.css",
        "node_modules/@coreui/coreui/dist/css/coreui.css",
        "node_modules/jquery-confirm/dist/jquery-confirm.min.css",
        "node_modules/toastr/build/toastr.min.css",
        "node_modules/blueimp-gallery/css/blueimp-gallery.min.css"
    ])
    .pipe(cleanCSS({}))
    .pipe(concat("external.dist.css"))
    .pipe(dest('src/assets/dist'));
}

function js(){
    return src([
            "node_modules/jquery/dist/jquery.min.js",
            "node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
            "node_modules/@coreui/coreui/dist/js/coreui.min.js",
            "node_modules/moment/min/moment.min.js",
            "node_modules/jquery-confirm/dist/jquery-confirm.min.js",
            "node_modules/toastr/build/toastr.min.js",
            "node_modules/blueimp-gallery/js/blueimp-gallery.min.js"
        ])
        .pipe(minify({
            noSource: true
        }))
        .pipe(concat('external.dist.js'))
        .pipe(dest('src/assets/dist'))
}

function fonts(){
    return src([
            "node_modules/jquery-contextmenu/dist/font/context-menu-icons.ttf",
            "node_modules/jquery-contextmenu/dist/font/context-menu-icons.woff",
            "node_modules/jquery-contextmenu/dist/font/context-menu-icons.woff2"
        ])
        .pipe(minify({
            noSource: true
        }))
        .pipe(dest('src/assets/dist/font'))
}

function fontAwesomeCss(){
    return src([
            "src/assets/fontawesome/css/all.min.css",
        ])
        .pipe(replace("../webfonts/", "/assets/fontawesome/webfonts/"))
        .pipe(minify({
            noSource: true
        }))
        .pipe(concat("external.fontawesome.css"))
        .pipe(dest('src/assets/dist/'))
}

exports.js = js;
exports.extrnalCss = css;
exports.fontAwesomeCss = fontAwesomeCss;
exports.default = parallel(js, css, fonts, fontAwesomeCss)
