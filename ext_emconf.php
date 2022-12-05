<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Plupload for Powermail',
    'description' => 'Add a EXT:pluploadfe form element type to Powermail. Includes PHP validation and attaching files to emails.',
    'category' => 'plugin',
    'author' => 'Felix Nagel',
    'author_email' => 'info@felixnagel.com',
    'state' => 'beta',
    'clearCacheOnLoad' => 0,
    'version' => '1.0.2-dev',
    'constraints' => [
        'depends' => [
            'php' => '7.4.0-8.0.99',
            'typo3' => '11.5.0-11.5.99',
            'pluploadfe' => '6.0.0-6.99.99',
            'powermail' => '9.0.0-10.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
