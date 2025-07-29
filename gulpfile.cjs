const gulp = require("gulp");
const cleanCSS = require("gulp-clean-css");
const rename = require("gulp-rename");

// Tạo task nén CSS
gulp.task("minify-css", () => {
    return gulp
        .src([
            "public/css/style.css",
            "public/css/admin.css",
            "public/css/style-book.css",
        ]) // Đường dẫn đến các file CSS
        .pipe(cleanCSS({ compatibility: "ie8" })) // Nén CSS
        .pipe(rename({ suffix: ".min" })) // Thêm '.min' vào tên file
        .pipe(gulp.dest("public/css/minified")); // Đường dẫn lưu file đã nén
});

// Tạo task theo dõi file CSS
gulp.task("watch", () => {
    gulp.watch("public/css/*.css", gulp.series("minify-css")); // Theo dõi các file CSS trong thư mục public/css
});

// Tạo task mặc định chạy cả minify-css và watch
gulp.task("default", gulp.series("minify-css", "watch"));
