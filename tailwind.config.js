import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#DB1926",
                    "primary-content": "#FFFFFF",
                    secondary: "#f1f2f3",
                    "secondary-content": "#34363C",
                    "base-100": "#fff",
                    "base-200": "#f2f2f2",
                    "base-300": "#e6e6e6",
                    "base-content": "#1f2937",
                    accent: "#00d7c0",
                    "accent-content": "#00110e",
                    neutral: "#2b3440",
                    "neutral-content": "#d7dde4",
                },
            },
        ],
    },
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./vendor/robsontenorio/mary/src/View/Components/**/*.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms, require("daisyui")],
};
