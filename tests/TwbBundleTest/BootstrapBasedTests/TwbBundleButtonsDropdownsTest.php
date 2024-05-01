<?php

namespace TwbBundleTest;

/**
 * Test buttons dropdowns rendering
 * Based on http://getbootstrap.com/components/#btn-dropdowns
 */
class TwbBundleButtonsDropdownsTest extends \PHPUnit\Framework\TestCase
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
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-buttons-dropdowns' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->formButtonHelper   = $oViewHelperPluginManager->get('formButton')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/components/#btn-dropdowns-single
     */
    public function testSingleButtonDropdowns()
    {
        $aDropDownOptions = [
            'items' => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ];

        $sContent = '';
        $oButton  = new \Laminas\Form\Element\Button('default', ['label' => 'Default', 'dropdown' => $aDropDownOptions]);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('primary', ['label' => 'Primary', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-primary');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('success', ['label' => 'Success', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-success');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('info', ['label' => 'Info', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-info');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('warning', ['label' => 'Warning', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-warning');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('danger', ['label' => 'Danger', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-danger');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'dropdowns-single.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#btn-dropdowns-split
     */
    public function testSplitButtonDropdowns()
    {
        $aDropDownOptions = [
            'split' => true,
            'items' => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ];

        $sContent = '';

        $oButton = new \Laminas\Form\Element\Button('default', ['label' => 'Default', 'dropdown' => $aDropDownOptions]);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('primary', ['label' => 'Primary', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-primary');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('success', ['label' => 'Success', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-success');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('info', ['label' => 'Info', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-info');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('warning', ['label' => 'Warning', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-warning');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $oButton = new \Laminas\Form\Element\Button('danger', ['label' => 'Danger', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-danger');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'dropdowns-split.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#btn-dropdowns-sizing
     */
    public function testDropdownsSizing()
    {
        $aDropDownOptions = [
            'items' => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ];

        $sContent = '';

        //Large
        $oButton = new \Laminas\Form\Element\Button('large-button-default', ['label' => 'Large button', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-lg');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Small
        $oButton = new \Laminas\Form\Element\Button('small-button-default', ['label' => 'Small button', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-sm');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Extra small
        $oButton = new \Laminas\Form\Element\Button('extra-small-button-default', ['label' => 'Extra small button', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-xs');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'dropdowns-sizing.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#btn-dropdowns-dropup
     */
    public function testDropup()
    {
        $aDropDownOptions = [
            'dropup' => true,
            'split'  => true,
            'items'  => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ];

        $sContent = '';

        $oButton = new \Laminas\Form\Element\Button('default', ['label' => 'Dropup', 'dropdown' => $aDropDownOptions]);
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        $aDropDownOptions['list_attributes'] = ['class' => 'pull-right'];
        $oButton                             = new \Laminas\Form\Element\Button('primary', ['label' => 'Right dropup', 'dropdown' => $aDropDownOptions]);
        $oButton->setAttribute('class', 'btn-primary');
        $sContent .= $this->formButtonHelper->__invoke($oButton) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'dropup.phtml', $sContent);
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
