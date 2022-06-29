<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Plupload for Powermail',
    'description' => 'Add a EXT:pluploadfe form element type to Powermail. Includes PHP validation and attaching files to emails.',
    'category' => 'plugin',
    'author' => 'Felix Nagel',
    'author_email' => 'info@felixnagel.com',
    'state' => 'alpha',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.0-11.5.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
