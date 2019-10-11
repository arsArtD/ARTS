


# gulp对应的package.json

```
{
  "name": "tiku-content",
  "version": "1.0.0",
  "description": "工程内容es2015内容转换",
  "main": "gulpfile.js",
  "directories": {
    "test": "tests"
  },
  "scripts": {
    "test": "echo \"Error: no test specified\" && exit 1",
    "watch": "node gulpfile.js"
  },
  "repository": {
    "type": "git",
    "url": "git@gitlab.eoffcn.com:team2/rd/tiku-content.git"
  },
  "author": "",
  "license": "ISC",
  "devDependencies": {
    "babel-cli": "^6.22.2",
    "babel-preset-es2016": "^6.22.0",
    "babel-preset-stage-0": "^6.22.0",
    "babel-preset-es2015": "^6.24.1",
    "browserify": "^14.0.0",
    "gulp": "^3.9.1",
    "gulp-babel": "^6.1.2",
    "gulp-plumber": "^1.1.0",
    "gulp-sourcemaps": "^2.4.0",
    "gulp-streamify": "^1.0.2",
    "gulp-strip-comments": "^2.4.3",
    "gulp-watch": "^4.3.11",
    "vinyl-source-stream": "^1.1.0"
  }
}

```

# .babelrc对应的内容

```
{
  "presets": ["es2015", "stage-0"]
}

```

# gulpfile.js示例

```
let gulp = require('gulp'),
    babel = require('gulp-babel'),
    watch = require('gulp-watch'),  //监听
    plumber = require('gulp-plumber'),  //错误管理 提示
    sourcemaps = require('gulp-sourcemaps'),
    strip = require('gulp-strip-comments'), //删除注释
    streamify = require('gulp-streamify');

let path = {
    src: {
        js: [
            'public/static/js/vue_common/*',
            'public/static/js/vue_module_a/*',
        ]
    },
    dist: {
        js: [
            "public/dist/js/vue_common/",
            "public/dist/js/vue_module_a/",
        ]
    }
};



gulp.task('6to5', function () {
    path.src.js.map((value, index)=>{
        gulp.src(value)  // 多个文件目录  参数为数组
            .pipe(watch(value))
            .pipe(plumber())
            .pipe(sourcemaps.init())
            .pipe(strip())  //去除注释
            .pipe(streamify(babel()))
            .pipe(sourcemaps.write({addComment: false}))
            .pipe(plumber.stop())
            .pipe(gulp.dest(path.dist.js[index]))
    })
})

gulp.task('build', function () {
    path.src.js.map((value, index)=>{
        gulp.src(value)  // 多个文件目录  参数为数组
            .pipe(plumber())
            .pipe(sourcemaps.init())
            .pipe(strip())  //去除注释
            .pipe(streamify(babel()))
            .pipe(sourcemaps.write({addComment: false}))
            .pipe(plumber.stop())
            .pipe(gulp.dest(path.dist.js[index]))
    })
})

gulp.task('watchnode', ['6to5'], function (){
    gulp.watch(path.src.js, [babel]);
});

```

# gulp安装主要事项

gulp 需要全局安装

部分内容可参照： https://blog.csdn.net/ling369523246/article/details/54884735 
