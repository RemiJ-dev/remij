import js from '@eslint/js';
import globals from 'globals';

export default [
    {
        ignores: ['assets/vendor/**'],
    },
    {
        files: ['assets/**/*.js'],
        ...js.configs.recommended,
        languageOptions: {
            ecmaVersion: 2022,
            sourceType: 'module',
            globals: {
                ...globals.browser,
            },
        },
        rules: {
            ...js.configs.recommended.rules,
            'no-console': 'warn',
        },
    },
];
