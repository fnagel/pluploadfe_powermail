<?php

namespace FelixNagel\PluploadfePowermail\ViewHelpers;

/**
 * This file is part of the "pluploadfe_powermail" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use FelixNagel\PluploadfePowermail\Utility\Configuration;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

class RenderViewHelper extends AbstractViewHelper
{
    use CompileWithRenderStatic;

    protected $escapeOutput = false;

    public function initializeArguments()
    {
        $this->registerArgument('uid', 'int', 'Powermail field record UID', true);
        $this->registerArgument('settings', 'array', 'Powermail TypoScript settings', true);
    }

    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $settings = (array)$arguments['settings'];

        // Set configuration
        $settings['pluploadfe']['rendering']['uid'] = 'powermail_'.$arguments['uid'];
        $settings['pluploadfe']['rendering']['configUid'] = Configuration::getUidByPowermailField((int)$arguments['uid']);

        return static::getContentObjectRenderer()->cObjGetSingle(
            $settings['pluploadfe']['rendering']['_typoScriptNodeValue'],
            $settings['pluploadfe']['rendering']
        );
    }

    protected static function getContentObjectRenderer(): ContentObjectRenderer
    {
        return $GLOBALS['TSFE']->cObj;
    }
}
