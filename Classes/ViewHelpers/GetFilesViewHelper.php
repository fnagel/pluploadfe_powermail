<?php

namespace FelixNagel\PluploadfePowermail\ViewHelpers;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\PluploadfePowermail\Utility\Mail as MailUtility;
use FelixNagel\PluploadfePowermail\Utility\Session as SessionUtility;
use In2code\Powermail\Domain\Model\Field;
use In2code\Powermail\Domain\Model\Mail;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class GetFilesViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('field', Field::class, 'Powermail field record', true);
        $this->registerArgument('mail', Mail::class, 'Powermail mail record',  false, null);
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $files = SessionUtility::getFilesByPowermailField($arguments['field']);

//        if ($files === null && $arguments['mail'] !== null) {
//            $files = MailUtility::getFilesByField($arguments['mail'], $arguments['field']);
//        }

        return $files;
    }
}
