<?php
namespace FelixNagel\PluploadfePowermail\Finisher;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\PluploadfePowermail\Utility\Configuration;
use FelixNagel\PluploadfePowermail\Utility\Mail;
use FelixNagel\PluploadfePowermail\Utility\Session;
use In2code\Powermail\Finisher\AbstractFinisher;

class PluploadfeFinisher extends AbstractFinisher
{
    public function pluploadfeFinisher(): void
    {
        foreach (Mail::getFields($this->mail) as $field) {
            Session::removeFiles(Configuration::getUidByPowermailField($field->getUid()));
        }

        // Clean up all session data
        // @todo Remove this with next major version of EXT:pluploadfe!
        Session::removeFiles();
    }
}
