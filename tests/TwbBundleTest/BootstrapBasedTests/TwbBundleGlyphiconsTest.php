<?php

namespace TwbBundleTest;

/**
 * Test glyphicons rendering
 * Based on http://getbootstrap.com/components/#glyphicons
 */
class TwbBundleGlyphiconsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\View\Helper\TwbBundleGlyphicon
     */
    protected $glyphiconHelper;

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormButton
     */
    protected $formButtonHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-glyphicons' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();

        //Initialize glyphicon helper
        $this->glyphiconHelper = $oViewHelperPluginManager->get('glyphicon')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));

        //Initialize form button helper
        $this->formButtonHelper = $oViewHelperPluginManager->get('formButton')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/components/#glyphicons-how-to-use
     */
    public function testHowToUse()
    {
        $this->twbAssertStringEqualsFile($this->expectedPath . 'how-to-use.phtml', $this->glyphiconHelper->__invoke('search'));
    }

    /**
     * Test http://getbootstrap.com/components/#glyphicons-examples
     */
    public function testExamples()
    {
        $sContent = '';

        //Align left
        $sContent .= $this->formButtonHelper->__invoke(new \Laminas\Form\Element\Button('align-left', ['glyphicon' => 'align-left'])) . "\n";

        //Align center
        $sContent .= $this->formButtonHelper->__invoke(new \Laminas\Form\Element\Button('align-left', ['glyphicon' => 'align-center'])) . "\n";

        //Align right
        $sContent .= $this->formButtonHelper->__invoke(new \Laminas\Form\Element\Button('align-left', ['glyphicon' => 'align-right'])) . "\n";

        //Large
        $oButton = new \Laminas\Form\Element\Button('large-button-default', ['label' => 'Star', 'glyphicon' => 'star']);
        $oButton->setAttribute('class', 'btn-lg');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Default
        $oButton = new \Laminas\Form\Element\Button('button-default', ['label' => 'Star', 'glyphicon' => 'star']);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Small
        $oButton = new \Laminas\Form\Element\Button('small-button-default', ['label' => 'Star', 'glyphicon' => 'star']);
        $oButton->setAttribute('class', 'btn-sm');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Extra small
        $oButton = new \Laminas\Form\Element\Button('extra-small-button-default', ['label' => 'Star', 'glyphicon' => 'star']);
        $oButton->setAttribute('class', 'btn-xs');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $this->twbAssertStringEqualsFile($this->expectedPath . 'examples.phtml', $sContent);
    }

    /**
     * @param string $sExpectedFile
     * @param string $sActualString
     * @param string $sMessage
     * @param boolean $bCanonicalize
     * @param boolean $bIgnoreCase
     */
    public static function twbAssertStringEqualsFile($sExpectedFile, $sActualString, $sMessage = '', $bCanonicalize = false, $bIgnoreCase = false)
    {
        return parent::assertStringEqualsFile($sExpectedFile, $sActualString, $sMessage, $bCanonicalize, $bIgnoreCase);
    }

}
