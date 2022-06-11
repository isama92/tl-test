const { parallel, src, dest } = require("gulp");

const babel = require("gulp-babel");
const plumber = require("gulp-plumber");
const uglify = require("gulp-uglify");
const cleanCSS = require('gulp-clean-css');
const sass = require("gulp-sass")(require('sass'));

const buildCss = function (done) {
    return src("./resources/sass/*.sass")
        .pipe(sass())
        .pipe(cleanCSS())
        .pipe(dest("./public/assets/css/"));
};

const buildJs = function (done) {
    return (
        src("./resources/js/**/*.js")
            .pipe(plumber())
            .pipe(
                babel({
                    presets: [
                        [
                            "@babel/env",
                            {
                                modules: false,
                            },
                        ],
                    ],
                })
            )
            .pipe(uglify())
            .pipe(dest("./public/assets/js/"))
    );
};


exports.default = parallel(buildJs, buildCss);
