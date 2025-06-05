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
          dark: '#1f2937',  // gray-800 dark mode
        },
        menubg: {
          light: '#f3f4f6', // hover bg di light (gray-100, lebih lembut dari #f9fafb)
          dark: '#1e40af',  // hover bg di dark (navy blue blue-800)
        },
        menutext: {
          light: '#1f2937',
          dark: '#d1d5db',
        },
        active: {
          light: '#e5e7eb',  // active bg light (gray-200/300)
          dark: '#1e3a8a',   // active bg dark navy (blue-900)
        },
      },
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
    },
  },
  plugins: [forms],
}
