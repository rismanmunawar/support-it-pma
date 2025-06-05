import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms'

export default {
  darkMode: 'class',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
  ],
  theme: {
    extend: {
      colors: {
        sidebar: {
          light: '#ffffff', // warna sidebar saat light
          dark: '#1f2937',   // warna sidebar saat dark (misalnya gray-800)
        },
        menubg: {
          light: '#f9fafb', // hover bg di light
          dark: '#374151', // hover bg di dark
        },
        menutext: {
          light: '#1f2937',
          dark: '#d1d5db',
        },
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [forms],
}
