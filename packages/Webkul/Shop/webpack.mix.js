const { mix } = require("laravel-mix");
require("laravel-mix-merge-manifest");

<<<<<<< HEAD
var publicPath = 'publishable/assets';
// var publicPath = "../../../public/themes/default/assets";
=======
// var publicPath = 'publishable/assets';
var publicPath = "../../../public/themes/default/assets";
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa

mix.setPublicPath(publicPath).mergeManifest();
mix.disableNotifications();

mix.js([__dirname + "/src/Resources/assets/js/app.js"], "js/shop.js")
    .copyDirectory(__dirname + "/src/Resources/assets/images", publicPath + "/images")
    .sass(__dirname + "/src/Resources/assets/sass/app.scss", "css/shop.css")
    .options({
        processCssUrls: false
    });

if (mix.inProduction()) {
    mix.version();
}
