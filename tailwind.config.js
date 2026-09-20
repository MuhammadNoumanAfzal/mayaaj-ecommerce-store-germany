export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
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
                display: ['"Cormorant Garamond"', 'Georgia', 'serif'],
                sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            letterSpacing: {
                luxury: '0.18em',
            },
        },
    },
    plugins: [],
};
