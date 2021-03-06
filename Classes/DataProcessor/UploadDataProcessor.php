<?php

namespace FelixNagel\PluploadfePowermail\DataProcessor;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\PluploadfePowermail\Utility\Configuration;
use FelixNagel\PluploadfePowermail\Utility\Mail;
use FelixNagel\PluploadfePowermail\Utility\Session;
use In2code\Powermail\DataProcessor\AbstractDataProcessor;
use In2code\Powermail\Domain\Model\Answer;
use In2code\Powermail\Domain\Model\Field;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class UploadDataProcessor extends AbstractDataProcessor
{
    public function uploadFilesDataProcessor(): void
    {
        foreach (Mail::getFields($this->getMail()) as $field) {
            $this->addFilesToMail($field);
        }
    }

    protected function addFilesToMail(Field $field): void
    {
        $files = Session::getFilesByPowermailField($field);

        $answer = GeneralUtility::makeInstance(Answer::class);
        $answer->setValueType(Answer::VALUE_TYPE_ARRAY);
        $answer->setValue(is_array($files) ? $files : []);
        $answer->setField($field);
        $this->getMail()->addAnswer($answer);

        Session::removeFiles(Configuration::getUidByPowermailField($field->getUid()));
    }
}
