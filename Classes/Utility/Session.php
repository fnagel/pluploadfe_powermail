<?php

namespace FelixNagel\PluploadfePowermail\Utility;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\Pluploadfe\Middleware\Upload;
use In2code\Powermail\Domain\Model\Field;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController;

class Session implements SingletonInterface
{
    public static function removeFiles(int $configUid = null): void
    {
        if ($configUid === null) {
            // @todo Remove this with next major version of EXT:pluploadfe!
            static::saveData('', 'files');
        } else {
            static::saveData('', $configUid.'_files');
        }
    }

    public static function getFilesByPowermailField(Field $field): ?array
    {
        return static::getData(Configuration::getUidByPowermailField($field->getUid()).'_files') ?: null;
    }

    public static function removeMessages(int $configUid = null): void
    {
        static::saveData('', $configUid.'_messages');
    }

    public static function getMessagesByPowermailField(Field $field): ?array
    {
        return static::getData(Configuration::getUidByPowermailField($field->getUid()).'_messages') ?: null;
    }

    protected static function saveData($data, string $key = 'data'): void
    {
        static::getFeUser()->setAndSaveSessionData(Upload::SESSION_KEY_PREFIX.$key, $data);
    }

    protected static function getData(string $key)
    {
        return static::getFeUser()->getSessionData(Upload::SESSION_KEY_PREFIX.$key);
    }

    protected static function getFeUser(): FrontendUserAuthentication
    {
        return self::getTyposcriptFrontendController()->fe_user;
    }

    protected static function getTyposcriptFrontendController(): ?TypoScriptFrontendController
    {
        return $GLOBALS['TSFE'] ?? null;
    }
}
