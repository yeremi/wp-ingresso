module.exports = {
    plugins: {
        tailwindcss: {},
        autoprefixer: {},
        cssnano: {},
        ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
    }
}
console.log('NODE_ENV:', process.env.NODE_ENV);
