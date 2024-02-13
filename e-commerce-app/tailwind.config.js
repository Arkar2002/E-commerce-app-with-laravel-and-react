/** @type {import('tailwindcss').Config} */
/* eslint-disable */
export default {
  darkMode: "class",
  content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx}"],
  theme: {
    screens: {
      sm: "576px",
      md: "768px",
      lg: "992px",
      xl: "1200px",
    },
    fontFamily: {
      sans: ["Poppins", "sans-serif"],
    },
    container: {
      center: true,
      padding: "1rem",
    },
    extend: {
      fontFamily: {
        roboto: ["Roboto", "sans-serif"],
      },
      colors: {
        primary: "var(--color-primary)",
        silver: "#C0C0C0",
        pink: "#FF69B4",
      },
    },
  },
  plugins: [],
};
