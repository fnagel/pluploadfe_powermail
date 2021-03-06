<?php

defined('TYPO3') || die();

call_user_func(function ($packageKey) {
    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$packageKey.'/Configuration/TSconfig/page.tsconfig">'
    );

    $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(
        \TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class
    );
    $signalSlotDispatcher->connect(
        \In2code\Powermail\Domain\Service\Mail\SendMailService::class,
        'sendTemplateEmailBeforeSend',
        \FelixNagel\PluploadfePowermail\Service\SendMailService::class,
        'manipulateMail',
        FALSE
    );

    // Extend localization files
    $GLOBALS['TYPO3_CONF_VARS']['SYS']['locallangXMLOverride']['EXT:powermail/Resources/Private/Language/locallang.xlf'][] =
        'EXT:pluploadfe_powermail/Resources/Private/Language/locallang.xlf';
}, 'pluploadfe_powermail');
