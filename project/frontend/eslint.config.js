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
      "vue/multiline-html-element-content-newline": ["error", {
        "ignoreWhenEmpty": true,
        "ignores": ["pre", "textarea"],
        "allowEmptyLines": false,
      }],

      "vue/no-multi-spaces": 2,

      "vue/mustache-interpolation-spacing": ["error", "always"],

      "vue/html-indent": ["error", 2, {
        "attribute": 1,
        "baseIndent": 1,
        "closeBracket": 0,
        "alignAttributesVertically": true,
        "ignores": []
      }],

      "vue/html-closing-bracket-newline": [
        "error",
        {
          "singleline": "never",
          "multiline": "always",
          "selfClosingTag": {
            "singleline": "never",
            "multiline": "always"
          }
        }
      ],

      "vue/attributes-order": ["error", {
        "order": [
          "DEFINITION",
          "LIST_RENDERING",
          "CONDITIONALS",
          "RENDER_MODIFIERS",
          "GLOBAL",
          ["UNIQUE", "SLOT"],
          "TWO_WAY_BINDING",
          "OTHER_DIRECTIVES",
          "OTHER_ATTR",
          "EVENTS",
          "CONTENT"
        ],
        "alphabetical": false
      }],

      "vue/max-attributes-per-line": ["error", {
        "singleline": {
          "max": 1
        },
        "multiline": {
          "max": 1
        }
      }],

      "vue/component-name-in-template-casing": ["error", "kebab-case", {
        "registeredComponentsOnly": true,
      }],

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

      'vue/order-in-components': ['error', {
        "order": [
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
          'renderError'
        ]
      }],
    },
  },
]