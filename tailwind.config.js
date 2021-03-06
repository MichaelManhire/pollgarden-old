const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    theme: {
        container: {
            center: true,
            padding: '1rem',
        },
        extend: {
            colors: {
                green: {
                    '50': '#E3F9E5',
                    '100': '#C1EAC5',
                    '200': '#A3D9A5',
                    '300': '#7BC47F',
                    '400': '#57AE5B',
                    '500': '#3F9142',
                    '600': '#2F8132',
                    '700': '#207227',
                    '800': '#0E5814',
                    '900': '#05400A',
                },
                purple: {
                    '50': '#EAE2F8',
                    '100': '#CFBCF2',
                    '200': '#A081D9',
                    '300': '#8662C7',
                    '400': '#724BB7',
                    '500': '#653CAD',
                    '600': '#51279B',
                    '700': '#421987',
                    '800': '#34126F',
                    '900': '#240754',
                },
                red: {
                    '50': '#FFEEEE',
                    '100': '#FACDCD',
                    '200': '#F29B9B',
                    '300': '#E66A6A',
                    '400': '#D64545',
                    '500': '#BA2525',
                    '600': '#A61B1B',
                    '700': '#911111',
                    '800': '#780A0A',
                    '900': '#610404',
                },
                yellow: {
                    '50': '#FFFAEB',
                    '100': '#FCEFC7',
                    '200': '#F8E3A3',
                    '300': '#F9DA8B',
                    '400': '#F7D070',
                    '500': '#E9B949',
                    '600': '#C99A2E',
                    '700': '#A27C1A',
                    '800': '#7C5E10',
                    '900': '#513C06',
                },
                gray: {
                    '50': '#F7F7F7',
                    '100': '#E1E1E1',
                    '200': '#CFCFCF',
                    '300': '#B1B1B1',
                    '400': '#9E9E9E',
                    '500': '#7E7E7E',
                    '600': '#626262',
                    '700': '#515151',
                    '800': '#3B3B3B',
                    '900': '#222222',
                },
                'offwhite': '#f9fafb',
            },
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
            maxWidth: {
                '12': '12rem',
            },
        },
    },
    variants: {},
    plugins: [
        require('@tailwindcss/ui'),
    ],
}
