const colors = require("tailwindcss/colors");

module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    mode: "jit",
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
        fontFamily: {
            Oswald: ["Oswald", "sans-serif"],
            OpenSans: ["Open Sans", "sans-serif"],
        },
        colors: {
            navbarBg: "#1c1c1c",
            navbarText: "#f1f1f1",
            backgroundLink: colors.blue["500"],
        },
    },
    variants: {
        extend: {},
    },
    plugins: [],
};
