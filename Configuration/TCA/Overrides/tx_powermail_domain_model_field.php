<?php
defined('TYPO3') || die();

$tempColumns = [
    'tx_pluploadfe_config' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:pluploadfe/Resources/Private/Language/locallang_db.xlf:tt_content.tx_pluploadfe_config',
        'config' => [
            'type' => 'inline',
            'foreign_table' => 'tx_pluploadfe_config',
            'minitems' => 1,
            'maxitems' => 1,
            'overrideChildTca' => [
                'columns' => [
                    'title' => [
                        'config' => [
                            'type' => 'passthrough',
                            'readonly' => true,
                        ],
                    ],
                    'hidden' => [
                        'config' => [
                            'default' => '0',
                        ],
                    ],
                    'feuser_required' => [
                        'config' => [
                            'default' => '0',
                        ],
                    ],
                    'save_session' => [
                        'config' => [
                            'default' => '1',
                            'readonly' => true,
                        ],
                    ],
                    'upload_path' => [
                        'config' => [
                            'default' => 'uploads/tx_powermail/',
                        ],
                    ],
                ],
            ],
        ],
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tx_powermail_domain_model_field',
    $tempColumns
);

// @todo Localize this!
$GLOBALS['TCA']['tx_powermail_domain_model_field']['columns']['type']['config']['items']['pluploadfe'] =
    ['Plupload (Multiple Upload)', 'pluploadfe'] ;

$GLOBALS['TCA']['tx_powermail_domain_model_field']['types']['pluploadfe'] = [
    'showitem' => 'page, title, type, ' .
        '--div--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' . \In2code\Powermail\Domain\Model\Field::TABLE_NAME . '.sheet1, ' .
        '--palette--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
        \In2code\Powermail\Domain\Model\Field::TABLE_NAME . '.validation_title;2, ' .
        '--palette--;Layout;41, ' .
        'description, ' .
        '--palette--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
        \In2code\Powermail\Domain\Model\Field::TABLE_NAME . '.marker_title;5, ' .
        '--div--;LLL:EXT:powermail/Resources/Private/Language/locallang_db.xlf:' .
        'tabs.access, sys_language_uid, ' .
        'l10n_parent, l10n_diffsource, hidden, starttime, endtime'
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tx_powermail_domain_model_field',
    'tx_pluploadfe_config',
    'pluploadfe',
    'after:type'
);


