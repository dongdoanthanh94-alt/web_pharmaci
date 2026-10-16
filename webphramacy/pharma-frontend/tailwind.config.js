/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './public/**/*.php',
    './templates/**/*.php',
    './config/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        pharmacy: {
          50: '#eaf7f1',
          600: '#15966d',
          700: '#107b59'
        }
      }
    }
  },
  plugins: []
};
