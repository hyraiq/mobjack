/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [],
  /**
   * Functionally disable the purge functionality from Tailwind, which is usually a good thing but would require
   * rebuilding the Tailwind CSS when templates change. Again, this is usually a good thing but we're not testing people
   * on fighting with javascript build tooling, nor are we shipping this to prod, so this is fine approach
   *
   * #ruthless-pragmatism
   */
  safelist: [
    {
      pattern: /./,
      /**
       * If you want to do any responsive css stuff, uncomment the below line. But at that point, maybe it's worth
       * using Tailwind as intended. For now though, this drops the compiled css from 50MB down to 8MB
       */
      // variants: ['sm', 'md', 'lg', 'xl', '2xl'],
    },
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: [
          'Roboto',
          'Inter',
          '-apple-system',
          'BlinkMacSystemFont',
          '"Segoe UI"',
          'Roboto',
          '"Helvetica Neue"',
          'Arial',
          '"Noto Sans"',
          'sans-serif',
          '"Apple Color Emoji"',
          '"Segoe UI Emoji"',
          '"Segoe UI Symbol"',
          '"Noto Color Emoji"',
        ],
      },
      colors: {
        primary: {
          25: '#F2F5FF',
          50: '#EDF0FF',
          100: '#E6EAFF',
          200: '#D9E0FF',
          300: '#B3C1FF',
          400: '#5978FF',
          500: '#002FFF',
          600: '#0027D9',
          700: '#001C99',
          800: '#001573',
          900: '#000E4C'
        }
      },
      spacing: {
        '100': '25rem',
        '200': '50rem',
        '224': '56rem',
      }
    },
  },
  plugins: [],
}
