<?php

namespace FelixNagel\PluploadfePowermail\Utility;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use In2code\Powermail\Domain\Model\Field;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\SingletonInterface;

class Configuration implements SingletonInterface
{
    protected const POWERMAIL_FIELD_NAME = 'tx_pluploadfe_config';

    protected static array $fieldUidToConfigUidCache = [];

    public static function getUidByPowermailField(int $uid): int
    {
        if (!array_key_exists($uid, self::$fieldUidToConfigUidCache)) {
            $record = BackendUtility::getRecord(Field::TABLE_NAME, $uid, static::POWERMAIL_FIELD_NAME);
            self::$fieldUidToConfigUidCache[$uid] = (int)$record[static::POWERMAIL_FIELD_NAME];
        }

        return self::$fieldUidToConfigUidCache[$uid];
    }
}
