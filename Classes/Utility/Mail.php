<?php

namespace FelixNagel\PluploadfePowermail\Utility;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use In2code\Powermail\Domain\Model\Answer;
use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail as MailObject;
use In2code\Powermail\Domain\Model\Page;
use TYPO3\CMS\Core\SingletonInterface;

class Mail implements SingletonInterface
{
    /**
     * Returns all Powermail fields of type pluploadfe from a given Mail object.
     *
     * @return Field[]
     */
    public static function getFields(MailObject $mail): array
    {
        $records = [];

        /* @var $page Page */
        foreach ($mail->getForm()->getPages() as $page) {
            /* @var $field Field */
            foreach ($page->getFields() as $field) {
                if ($field->getType() === 'pluploadfe') {
                    $records[] = $field;
                }
            }
        }

        return $records;
    }

    /**
     * Returns all files from a given Mail object and its answers.
     *
     * @return string[]
     */
    public static function getFiles(MailObject $mail): array
    {
        $files = [];

        /* @var $answer Answer */
        foreach ($mail->getAnswers() as $answer) {
            if ($answer->getField()->getType() === 'pluploadfe' && !empty($answer->getValue())) {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $files = array_merge($files, $answer->getValue());
            }
        }

        return $files;
    }

    /**
     * Returns all files from a given field object and its answers.
     *
     * @return string[]
     */
    public static function getFilesByField(MailObject $mail, Field $field): array
    {
        $files = [];

        /* @var $answer Answer */
        foreach ($mail->getAnswers() as $answer) {
            if ($field === $answer->getField()) {
                /** @noinspection SlowArrayOperationsInLoopInspection */
                $files = array_merge($files, $answer->getValue());
            }
        }

        return $files;
    }
}
