export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                saltora: {
                    bg: '#F8F5EF',
                    card: '#F0EAE1',
                    blush: '#F4E8E5',
                    'blush-light': '#FBF6F4',
                    terracotta: '#964B42',
                    'terracotta-dark': '#803D35',
                    dark: '#1C1917',
                    'dark-card': '#272320',
                    'dark-border': '#3D3733',
                    border: '#E5DED5',
                    text: '#292524',
                    muted: '#66605B',
                    'muted-light': '#8C847D',
                },
                burgundy: '#78000B',
                oxblood: '#4A0006',
                gold: '#F2B705',
                champagne: '#FFD45A',
                ivory: '#FAF7F0',
                espresso: '#181310',
                taupe: '#B6A99B',
                charcoal: '#24201E',
            },
            fontFamily: {
                serif: ['"Cormorant Garamond"', '"Playfair Display"', 'Georgia', 'serif'],
                display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                sans: ['"Plus Jakarta Sans"', 'Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            letterSpacing: {
                luxury: '0.18em',
                widest: '.2em',
                mega: '.3em',
            },
        },
    },
    plugins: [],
};
