<?php

namespace FelixNagel\PluploadfePowermail\Service;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\PluploadfePowermail\Utility\Mail;
use FelixNagel\PluploadfePowermail\Utility\Session;
use In2code\Powermail\Domain\Service\Mail\SendMailService as SendMailServicePowermail;
use TYPO3\CMS\Core\Mail\MailMessage;

class SendMailService
{
    /**
     * Adds all plupload files to the mail message object.
     */
    public function manipulateMail(MailMessage $message, array &$email, SendMailServicePowermail $originalService)
    {
        $settings = $originalService->getSettings();

        if (!$settings['pluploadfe'][$originalService->getType()]['attachment']) {
            return;
        }

        foreach (Mail::getFiles($originalService->getMail()) as $file) {
            $message->attachFromPath($file);
        }

        // Clean up all session data
        // @todo Remove this with next major version of EXT:pluploadfe!
        Session::removeFiles();
    }
}
