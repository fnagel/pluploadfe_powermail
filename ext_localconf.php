<?php

defined('TYPO3') || die();

call_user_func(function ($packageKey) {
    TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        '<INCLUDE_TYPOSCRIPT: source="FILE:EXT:'.$packageKey.'/Configuration/TSconfig/page.tsconfig">'
    );
}, 'pluploadfe_powermail');
