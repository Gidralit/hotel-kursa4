/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        accent: '#40a9d3',
        'secondary-color': 'var(--secondary-color)',
      },
    },
  },
  plugins: [],
}

