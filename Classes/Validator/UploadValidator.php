<?php

namespace FelixNagel\PluploadfePowermail\Validator;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\PluploadfePowermail\Utility\Configuration;
use In2code\Powermail\Domain\Model\Mail;
use In2code\Powermail\Domain\Validator\AbstractValidator;
use FelixNagel\PluploadfePowermail\Utility\Mail as MailUtility;
use FelixNagel\PluploadfePowermail\Utility\Session as SessionUtility;

class UploadValidator extends AbstractValidator
{
    /**
     * @param Mail $mail
     * @return bool
     */
    public function isValid($mail)
    {
        foreach (MailUtility::getFields($mail) as $field) {
            // Check for mandatory fields
            if ($field->isMandatory()) {
                $files = MailUtility::getFilesByField($mail, $field) ?: SessionUtility::getFilesByPowermailField($field);

                if (empty($files)) {
                    $this->setErrorAndMessage($field, 'mandatory');
                }
            }

            // Check messages
            $messages = SessionUtility::getMessagesByPowermailField($field);
            if (!empty($messages)) {
                $this->setValidState(false);

                foreach ($messages as $message) {
                    $this->addError('pluploadfe_'.$message['messageKey'], 1656976922, array_merge(
                        $message['messageArguments'],
                        ['marker' => $field->getMarker()],
                    ));
                }

                SessionUtility::removeMessages(Configuration::getUidByPowermailField($field->getUid()));
            }
        }

        return $this->isValidState();
    }
}
