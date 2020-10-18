<?php

return [

    /*
     * Set the HTML theme for the components
     * like alerts, form fields, menus, etc.
     */
    'theme' => 'bootstrap4',

    /*
     * Set the folder to store the custom templates
     */
    'custom' => 'themes',

    /*
     * Set to false to deactivate the AccessHandler component
     * Doing so the component will run slightly faster but
     * the logged and roles checkers won't be available
     */
    'control_access' => true,

    /*
     * Set to false to deactivate the Translator for the alert and menu
     * components, doing so they will run slightly faster but won't
     * search for Lang keys to translate texts.
     *
     * Note: the FieldBuilder will always use the translator
     * to search for attribute names and other texts,
     * regardless of this configuration value.
     */
    'translate_texts' => true,

    /*
     * Set to true to deactivate HTML5 form validation
     * and test the backend validation
     */
    'novalidate' => false,

    /*
     * Specify abbreviations for the form field attributes
     */
    'abbreviations' => [
        'ph' => 'placeholder',
        'max' => 'maxlength',
        'tpl' => 'template'
    ],

    /*
     * Set the configuration for each theme
     */
    'themes' => [
        /**
         * Default configuration for Bootstrap v3
         */
        'bootstrap' => [
            /*
             * Set a specific HTML template for a field type if the
             * type is not set, the default template will be used
             */
            'field_templates' => [
                // type => template
                'checkbox' => 'checkbox',
                'checkboxes' => 'collections',
                'radios' => 'collections'
            ],
            /*
             * Set the default classes for each field type
             */
            'field_classes' => [
                // type => class or classes
                'default' => 'form-control',
                'checkbox' => '',
                'error' => 'error'
            ],
        ],
        /**
         * Default configuration for Bootstrap v4
         */
        'bootstrap4' => [
            /*
             * Set a specific HTML template for a field type if the
             * type is not set, the default template will be used
             */
            'field_templates' => [
                // type => template
                'checkbox' => 'checkbox',
                'checkboxes' => 'collections',
                'radios' => 'collections'
            ],
            /*
             * Set the default classes for each field type
             */
            'field_classes' => [
                // type => class or classes
                'default' => 'form-control',
                'checkbox' => 'form-check-input',
                'error' => 'is-invalid'
            ],
        ],
        /**
         * configuration for BulmaCss
         */
        'bulma' => [
            /*
             * Set a specific HTML template for a field type if the
             * type is not set, the default template will be used
             */
            'field_templates' => [
                // type => template
                'checkbox' => 'checkbox',
                'checkboxes' => 'collections',
                'radios' => 'collections',
                'select'=>'selects',

            ],
            /*
             * Set the default classes for each field type
             */
            'field_classes' => [
                // type => class or classes
                'textarea'=>'textarea',
                'default' => 'input',
                'checkbox' => 'checkbox',
                'error' => 'is-danger'
            ],
        ]
    ]

];
