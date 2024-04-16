import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/demo.css",
                "resources/css/satoshi.css",
                "resources/vendor/fonts/boxicons.css",
                "resources/js/app.js",
                "resources/js/config.js",
                "resources/js/main.js",
                "resources/vendor/css/core.css",
                "resources/vendor/css/theme-default.css",
                "resources/vendor/css/pages/page-misc.css",
                "resources/vendor/js/helpers.js",
                "resources/vendor/js/bootstrap.js",
                "resources/vendor/js/menu.js",
                "resources/vendor/libs/jquery/jquery.js",
                "resources/vendor/libs/popper/popper.js",
                "resources/vendor/libs/perfect-scrollbar/perfect-scrollbar.js",
                "resources/vendor/libs/apex-charts/apexcharts.js",
            ],
            refresh: true,
        }),
    ],
});
