<?php

namespace TwbBundleTest;

/**
 * Test buttons rendering
 * Based on http://getbootstrap.com/css/#buttons
 */
class TwbBundleButtonsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleForm
     */
    protected $formButtonHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-buttons' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->formButtonHelper   = $oViewHelperPluginManager->get('formButton')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/css/#buttons-options
     */
    public function testButtonsOptions()
    {
        $sContent = '';
        $oButton  = new \Laminas\Form\Element\Button('default', ['label' => 'Default']);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('primary', ['label' => 'Primary']);
        $oButton->setAttribute('class', 'btn-primary');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('success', ['label' => 'Success']);
        $oButton->setAttribute('class', 'btn-success');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('info', ['label' => 'Info']);
        $oButton->setAttribute('class', 'btn-info');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('warning', ['label' => 'Warning']);
        $oButton->setAttribute('class', 'btn-warning');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('danger', ['label' => 'Danger']);
        $oButton->setAttribute('class', 'btn-danger');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('link', ['label' => 'Link']);
        $oButton->setAttribute('class', 'btn-link');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'options.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/css/#buttons-sizes
     */
    public function testButtonsSizes()
    {
        $sContent = '';

        //Large
        $oButton = new \Laminas\Form\Element\Button('large-button-primary', ['label' => 'Large button']);
        $oButton->setAttribute('class', 'btn-primary btn-lg');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('large-button-default', ['label' => 'Large button']);
        $oButton->setAttribute('class', 'btn-lg');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Default
        $oButton = new \Laminas\Form\Element\Button('button-primary', ['label' => 'Default button']);
        $oButton->setAttribute('class', 'btn-primary');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('button-default', ['label' => 'Default button']);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Small
        $oButton = new \Laminas\Form\Element\Button('small-button-primary', ['label' => 'Small button']);
        $oButton->setAttribute('class', 'btn-primary btn-sm');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('small-button-default', ['label' => 'Small button']);
        $oButton->setAttribute('class', 'btn-sm');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Extra small
        $oButton = new \Laminas\Form\Element\Button('extra-small-button-primary', ['label' => 'Extra small button']);
        $oButton->setAttribute('class', 'btn-primary btn-xs');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('extra-small-button-default', ['label' => 'Extra small button']);
        $oButton->setAttribute('class', 'btn-xs');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Block level
        $oButton = new \Laminas\Form\Element\Button('block-level-button-primary', ['label' => 'Block level button']);
        $oButton->setAttribute('class', 'btn-primary btn-block');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('block-level-button-default', ['label' => 'Block level button']);
        $oButton->setAttribute('class', 'btn-block');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'sizes.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/css/#buttons-active
     */
    public function testButtonsActive()
    {
        $sContent = '';

        $oButton = new \Laminas\Form\Element\Button('large-button-primary-active', ['label' => 'Primary button']);
        $oButton->setAttributes([
            'class' => 'btn-primary btn-lg active',
        ]);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('large-button-default-active', ['label' => 'Button']);
        $oButton->setAttributes([
            'class' => 'btn-lg active',
        ]);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'active.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/css/#buttons-disabled
     */
    public function testButtonsDisabled()
    {
        $sContent = '';

        $oButton = new \Laminas\Form\Element\Button('large-button-primary-disabled', ['label' => 'Primary button']);
        $oButton->setAttributes([
            'class'    => 'btn-primary btn-lg',
            'disabled' => true
        ]);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('large-button-default-disabled', ['label' => 'Button']);
        $oButton->setAttributes([
            'class'    => 'btn-lg',
            'disabled' => true
        ]);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'disabled.phtml', $sContent);
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
