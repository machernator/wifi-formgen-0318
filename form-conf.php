<?php
$conf = [
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
        ]
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
        ]
    ]
    ,
    'email' => [
        'type' => 'email',
        'id' => 'feldEmail',
        'value' => '',
        'label' => 'E-Mail',
        'tagAttributes' => []
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
        ]
    ]
];