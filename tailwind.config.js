/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    container: {
      center: true,
      padding: '16px',
    },
    extend: {
      colors: {
        primary: '#2D918C',
        active: '#1E615D',
        secondary: '#257975',
        accent: '#267975',
        accent1: '#96C8C5',
        accent2: '#73B6B2',
        accent3: '#50A39F',
        accent4: '#091D1C',
        background: '#B9DAD9',
        dark: '#0f172a',
        light: '#D5E9E8',
        abu: '#EDEDED',
        abu1: '#EAEDED',
        white1: '#F9F9F9',
        stroke: '#9AD3D0',
        stroke1: '#9F9F9F',
        stroke2: '#BDBEBE',
        danger: '#BC0000',
      },
      screens: {
        '2xl': '1320px',
      },
      backgroundImage: {
        'paper-patern': 'url("/public/image/bg_paper.svg")',
      }
    },
  },
  plugins: [],
}

