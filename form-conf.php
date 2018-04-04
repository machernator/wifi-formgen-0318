<?php
/* 
    Array mit Konfigurationen für:
    - Formular
    - Formularfelder
*/
$conf = [
    'form' => [
        'action' => '',
        'method' => 'post',
        'id' => 'contactForm',
        'tagAttributes' => [
            'class' => 'pure-form pure-form-stacked'
        ]
    ],
    'fields' => [
        'anrede' => [
            'type' => 'radio',
            'label' => 'Anrede',
            'id' => 'anrede',
            'value' => 'Herr',
            'values' => [
                'Frau' => 'Frau',
                'Herr' => 'Herr'
            ],
            'tagAttributes' => [
                'class' => 'form-field',
            ],
            'validationRules' =>'required',
            'filterRules' => 'trim|sanitize_string'
        ],
        'vorname' => [
            'type' => 'text',
            'label' => 'Vorname',
            'id' => 'feldVorname',
            'value' => 'blabla',
            'tagAttributes' => [
                'class' => 'form-field',
                'title' => 'Ihr Vorname',
                'placeholder' => 'Vorname'
            ],
            'validationRules' =>'required|alpha_numeric|max_len,100|min_len,6',
            'filterRules' => 'trim|sanitize_string'
        ],
        'bundeslaender' => [
            'type' => 'select',
            'label' => 'Bundesländer',
            'id' => 'feldBundeslaender',
            'value' => ['bgld', 'noe'], // kann auch ein array sein: ['bgld', 'w'],
            //'tagAttributes' => ['multiple' => ''],
            'options' => [ // key => option value, value = option Text
                'w' => 'Wien',
                'noe' => 'Niederösterreich',
                'ooe' => 'Oberösterreich',
                'bgld' => 'Burgenland'
            ],
            'validationRules' =>'required',
            'filterRules' => 'trim|sanitize_string'
        ],
        'nachname' => [
            'type' => 'text',
            'id' => 'feldNachname',
            'value' => 'bliblbi',
            'label' => 'Nachname',
            'tagAttributes' => [
                'class' => 'form-field',
                'title' => 'Ihr Nachname',
                'placeholder' => 'Nachname'
            ],
            'validationRules' =>'required',
            'filterRules' => 'trim|sanitize_string'
        ],
        'email' => [
            'type' => 'email',
            'id' => 'feldEmail',
            'value' => '',
            'label' => 'E-Mail',
            'tagAttributes' => [],
            'validationRules' =>'required|valid_email',
            'filterRules' => 'trim|sanitize_string'
        ],
        'newsletter' => [
            'type' => 'checkbox',
            'id' => 'feldNewsletter',
            'value' => '1',
            'label' => 'Newsletter',
            'tagAttributes' => [
                'class' => 'form-field',
                'title' => 'Ihre Newsletter',
                'placeholder' => 'Newsletter'
            ],
            'validationRules' =>'contains,1',
            'filterRules' => 'trim|sanitize_string'
        ],
        'senden' => [
            'type' => 'submit',
            'id' => 'feldSubmit',
            'value' => 'Senden',
            'label' => '',
            'tagAttributes' => [
                'class' => 'pure-button pure-button-primary'
            ]
        ],
        'reset' => [
            'type' => 'reset',
            'value' => 'Zurück setzen',
            'label' => '',
            'tagAttributes' => [
                'class' => 'pure-button',
                'style' => 'margin-left: 1.5em'
            ]
        ],
    ]
];