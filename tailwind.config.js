/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#1f4b8e",
                "primary-dark": "#102a52",
                secondary: "#182430",
                "secondary-dark": "#060C11",
            },
        },
    },
    plugins: [
        require("@tailwindcss/forms"),
        plugin(function ({ addUtilities, theme }) {
            const newUtilities = {
                ".custom-scrollbar": {
                    ".custom-scrollbar::-webkit-scrollbar": { width: "6px" },
                    ".custom-scrollbar::-webkit-scrollbar-track": {
                        background: theme("bg-secondary"),
                    },
                    ".custom-scrollbar::-webkit-scrollbar-thumb": {
                        background: "#888",
                    },
                    ".custom-scrollbar::-webkit-scrollbar-thumb:hover": {
                        background: "#555",
                    },
                },
            };

            addUtilities(newUtilities, ["responsive", "hover"]);
        }),
    ],
};
