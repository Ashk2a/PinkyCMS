<?php

use Modules\Core\Components;

return [
    'components_dir' => 'core::components',

    'components' => [
        // FORM
        'form' => [
            'view'  => 'form.form',
            'class' => Components\Form\Form::class,
        ],

        'form-checkbox' => [
            'view'  => 'form.form-checkbox',
            'class' => Components\Form\FormCheckbox::class,
        ],

        'form-errors' => [
            'view'  => 'form.form-errors',
            'class' => Components\Form\FormErrors::class,
        ],

        'form-group' => [
            'view'  => 'form.form-group',
            'class' => Components\Form\FormGroup::class,
        ],

        'form-input' => [
            'view'  => 'form.form-input',
            'class' => Components\Form\FormInput::class,
        ],

        'form-label' => [
            'view'  => 'form.form-label',
            'class' => Components\Form\FormLabel::class,
        ],

        'form-radio' => [
            'view'  => 'form.form-radio',
            'class' => Components\Form\FormRadio::class,
        ],

        'form-select' => [
            'view'  => 'form.form-select',
            'class' => Components\Form\FormSelect::class,
        ],

        'form-submit' => [
            'view'  => 'form.form-submit',
            'class' => Components\Form\FormSubmit::class,
        ],

        'form-textarea' => [
            'view'  => 'form.form-textarea',
            'class' => Components\Form\FormTextarea::class,
        ],
    ],
];
