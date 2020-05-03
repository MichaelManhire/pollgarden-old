const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        container: {
            center: true,
            padding: '1rem',
        },
        fontFamily: {
            sans: ['Inter', 'sans-serif'],
        },
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                0: 0,
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/ui'),
    ],
}
