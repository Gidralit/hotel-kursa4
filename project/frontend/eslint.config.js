import ESLint from '@eslint/js'
import Oxlint from 'eslint-plugin-oxlint'
import Vue from 'eslint-plugin-vue'
import globals from 'globals'
import EslintConfigPrettier from 'eslint-config-prettier'

export default [
  {
    ignores: ['{dist,public}/**/*'],
  },
  ESLint.configs.recommended,
  ...Vue.configs['flat/recommended'],
  Oxlint.configs['flat/recommended'],
  EslintConfigPrettier,
  {
    files: ['**/*.{js,mjs,cjs,jsx,vue}'], // append `ts,mts,cts,tsx` for TypeScript project
    linterOptions: {
      reportUnusedDisableDirectives: true,
    },
    languageOptions: {
      globals: {
        ...globals.node,
        ...globals.browser,
        ...globals.es2021,
      },
    },
    rules: {
      "vue/no-multi-spaces": 2,
      "vue/mustache-interpolation-spacing": ["error", "always"],
      "vue/no-irregular-whitespace": ["error", {
        "skipStrings": true,
        "skipComments": false,
        "skipRegExps": false,
        "skipTemplates": false,
        "skipHTMLAttributeValues": false,
        "skipHTMLTextContents": false
      }],
      "vue/component-definition-name-casing": ["error", "PascalCase"],
      "vue/match-component-file-name": ["error", {
        "extensions": ["vue"],
        "shouldMatchCase": false
      }],
      "vue/no-dupe-keys": ["error", {
        "groups": []
      }],
      'no-unused-vars': ['warn'],
      'vue/multi-word-component-names': 'off',
      'vue/attribute-hyphenation': 'off',
      'vue/no-v-html': 'off',
      'vue/v-on-event-hyphenation': 'off',
      '@typescript-eslint/ban-ts-comment': 'off',
      '@typescript-eslint/no-require-imports': 'off',
      '@typescript-eslint/no-explicit-any': 'off',
      'no-debugger': 'warn',
      'vue/max-attributes-per-line': 'off',
      'vue/html-closing-bracket-spacing': 'off',
      'vue/html-closing-bracket-newline': 'off',
      'vue/singleline-html-element-content-newline': 'off',
      'vue/multiline-html-element-content-newline': 'off',
      'vue/html-indent': 'off',
      'vue/attributes-order': 'off',
      'vue/component-name-in-template-casing': ['warn', 'kebab-case'],
      'vue/require-prop-types': 'off',
      'vue/component-tags-order': [
        'error',
        {
          order: ['template', 'script', 'style'],
        },
      ],
      'vue/order-in-components': [
        'error',
        {
          order: [
            'el',
            'name',
            'key',
            'parent',
            'functional',
            ['delimiters', 'comments'],
            ['components', 'directives', 'filters'],
            'extends',
            'mixins',
            ['provide', 'inject'],
            'ROUTER_GUARDS',
            'layout',
            'middleware',
            'validate',
            'scrollToTop',
            'transition',
            'loading',
            'inheritAttrs',
            'model',
            ['props', 'propsData'],
            'emits',
            'setup',
            'asyncData',
            'data',
            'fetch',
            'head',
            'computed',
            'watch',
            'watchQuery',
            'LIFECYCLE_HOOKS',
            'methods',
            ['template', 'render'],
            'renderError',
          ],
        },
      ],
      'no-console': 'warn',
    },
  },
]