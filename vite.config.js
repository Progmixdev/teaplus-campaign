import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import cp from "vite-plugin-cp";
import path from "path";

const FrontEndPath = path.resolve(__dirname, "resources/assets");

export default defineConfig({
    plugins: [
        laravel({
            refresh: true,
            buildDirectory: "front",
            input: [
                `${FrontEndPath}/js/jquery.js`,
                `${FrontEndPath}/js/app.js`,
                `${FrontEndPath}/css/app.css`,
            ],
        }),
        cp({
            targets: [
                { src: `${FrontEndPath}/images`, dest: "public/assets/images" },
                { src: `${FrontEndPath}/fonts`, dest: "public/assets/fonts" },
            ],
        }),
    ],
    assetsInclude: ["**/*.png", "**/*.jpg", "**/*.jpeg", "**/*.svg"],
});
