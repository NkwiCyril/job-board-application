import defaultTheme from 'tailwindcss/defaultTheme';


/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree',...defaultTheme.fontFamily.sans],
      },
      colors: {
        customColor: "#4ba198",
        customColorDark: "#2a645e",
        seekaBlue: "#0a66c2"
      }
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms')
  ],
}

