/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#ED1C24", // фирменный красный, как на макете
                dark: "#0D0D0D",
                light: "#F5F5F5",
            },
            fontFamily: {
                sans: ["Inter", "ui-sans-serif", "system-ui"],
            }
        },
    },
    plugins: [],
};
