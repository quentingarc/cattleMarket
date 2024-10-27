/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,vue}", // Ajoutez le chemin de vos fichiers source
  ],
  theme: {
    extend: {
      colors: {
        primary: '#1D4ED8', // Ajouter une couleur personnalisée
        secondary: '#9333EA', // Ajouter une autre couleur personnalisée
      },
      spacing: {
        '128': '32rem', // Ajouter un espacement personnalisé
        '144': '36rem',
      },
      backgroundImage: {
        'hero-pattern': "url('https://lesgrainssemtech.com/wp-content/uploads/2016/05/Image-champ.jpeg')", // Exemple de fond personnalisé
      },
    },
  },
  plugins: [],
}
