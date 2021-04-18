"use strict";

const gulp = require("gulp");
const sass = require("gulp-sass");
sass.compiler = require("node-sass");
const imagemin = require("gulp-imagemin");
const concat = require("gulp-concat");
const cleanCSS = require("gulp-clean-css");
const uglify = require("gulp-uglify");
const browserSync = require("browser-sync").create();
const series = gulp.series;
const parallel = gulp.parallel;

const sassTask = (cb) => {
  return gulp
    .src("assets/src/sass/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(gulp.dest("assets/src/css"))
    .pipe(browserSync.stream());
  cb();
};

const cssConcatTask = (cb) => {
  return gulp
    .src(["assets/src/css/*.css"])
    .pipe(concat("style.css"))
    .pipe(gulp.dest("assets/css"))
    .pipe(browserSync.stream());
  cb();
};

const cleanCssTask = (cb) => {
  return gulp
    .src("assets/css/*.css")
    .pipe(cleanCSS({ compatibility: "ie11" }))
    .pipe(gulp.dest("assets/css"));
  cb();
};

const concatJs = (cb) => {
  return gulp
    .src(["assets/src/js/*.js"])
    .pipe(concat("main.js"))
    .pipe(gulp.dest("assets/js"));
  cb();
};

// const uglifyTask = (cb) => {
//   return gulp
//     .src(["assets/js/*.js", "!assets/js/navigation.js"])
//     .pipe(uglify())
//     .pipe(gulp.dest("assets/js"));
//   cb();
// };

exports.default = () =>
  gulp
    .src("assets/src/images/**/*")
    .pipe(imagemin())
    .pipe(gulp.dest("assets/images/dist"));

const browserSyncTask = (cb) => {
  browserSync.init({
    proxy: "localhost/indigo",
  });
  cb();
};

const watchTask = () => {
  gulp.watch("./assets/src/scss/**/*.scss", series(sassTask, cssConcatTask));
  gulp.watch("./assets/src/js/*.js", series(concatJs));
  gulp.watch("./**/*.php", browserSync.reload);
};

exports.default = parallel(
  series(sassTask, cssConcatTask),
  series(concatJs),
  series(browserSyncTask, watchTask)
);

exports.production = parallel(cleanCssTask);
