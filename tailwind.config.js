/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'
const colors = require('tailwindcss/colors')

export default {
  preset: [preset],
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./resources/**/*.css",
    "./resources/**/*.scss",
    "./node_modules/flowbite/**/*.js",
    './app/Filament/**/*.php',
    "./resources/views/filament/**/*.blade.php",
    "./vendor/filament/**/*.blade.php",
    "./config/system.php",
    "./app/Http/Livewire/**/*.php",
    "./app/View/**/*.php",
    "./app/Models/**/*.php",
  ],
  theme: {
    extend: {colors: {
      danger: colors.rose,
      primary: colors.blue,
      success: colors.green,
      warning: colors.yellow,
  },
  keyframes: {
      slide_left: {
          '0%': {transform: 'translateX(100%)' },
  
          '100%': {transform: 'translateX(-100%)' },
      },
  },
  animation: {
      'banner-slide-left' : 'slide_left 20s linear infinite'
  }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('flowbite/plugin'),
  ],
}

