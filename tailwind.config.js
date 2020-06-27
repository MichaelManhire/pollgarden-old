const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        container: {
            center: true,
            padding: '1rem',
        },
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                0: 0,
            },
            minWidth: {
                '1/5': '20%',
                '1/4': '25%',
                '1/3': '33.33%',
                '1/2': '50%',
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/ui'),
    ],
}
