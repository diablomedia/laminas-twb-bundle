<?php

namespace TwbBundleTest;

/**
 * Test input groups rendering
 * Based on http://getbootstrap.com/components/#input-groups
 */
class TwbBundleInputGroupsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormElement
     */
    protected $formElementHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-input-groups' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->formElementHelper  = $oViewHelperPluginManager->get('formElement')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-basic
     */
    public function testBasicExample()
    {
        $sContent = '';

        $oInput = new \Laminas\Form\Element\Text('input-prepend', ['add-on-prepend' => '@']);
        $oInput->setAttribute('placeholder', 'Username');
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        $oInput = new \Laminas\Form\Element\Text('input-append', ['add-on-append' => '.00']);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        $oInput = new \Laminas\Form\Element\Text('input-append-prepend', ['add-on-prepend' => '$', 'add-on-append' => '.00']);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'input-groups-basic.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-sizing
     */
    public function testSizing()
    {
        $sContent = '';

        //Large
        $oInput = new \Laminas\Form\Element\Text('input-prepend', ['add-on-prepend' => '@']);
        $oInput->setAttributes(['placeholder' => 'Username', 'class' => 'input-lg']);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Default
        $oInput = new \Laminas\Form\Element\Text('input-prepend', ['add-on-prepend' => '@']);
        $oInput->setAttribute('placeholder', 'Username');
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Small
        $oInput = new \Laminas\Form\Element\Text('input-prepend', ['add-on-prepend' => '@']);
        $oInput->setAttributes(['placeholder' => 'Username', 'class' => 'input-sm']);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'input-groups-sizing.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-checkboxes-radios
     */
    public function testCheckboxesAndRadioAddons()
    {
        $sContent = '';

        //Checkbox
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-prepend' => new \Laminas\Form\Element\Checkbox('checkbox')]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Radio
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-prepend' => new \Laminas\Form\Element\Radio('radio', ['value_options' => [1 => '']])]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'input-groups-checkboxes-radios.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-buttons
     */
    public function testButtonAddons()
    {
        $sContent = '';

        //Prepend
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-prepend' => new \Laminas\Form\Element\Button('prepend-button', ['label' => 'Go!'])]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Append
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-append' => new \Laminas\Form\Element\Button('append-button', ['label' => 'Go!'])]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'input-groups-buttons.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-buttons-dropdowns
     */
    public function testButtonsWithDropdowns()
    {
        $aButtonOptions = ['label' => 'Action', 'dropdown' => [
                'label'           => 'Dropdown',
                'name'            => 'dropdownMenu1',
                'attributes'      => ['class' => 'clearfix'],
                'list_attributes' => ['aria-labelledby' => 'dropdownMenu1'],
                'items'           => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ]];

        $sContent = '';

        //Prepend
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-prepend' => new \Laminas\Form\Element\Button('prepend-button', $aButtonOptions)]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Append
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-append' => new \Laminas\Form\Element\Button('append-button', $aButtonOptions)]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'input-groups-buttons-dropdowns.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-buttons-segmented
     */
    public function testSegmentedButtons()
    {
        $aButtonOptions = ['label' => 'Action', 'dropdown' => [
                'label'           => 'Dropdown',
                'name'            => 'dropdownMenu1',
                'split'           => true,
                'attributes'      => ['class' => 'clearfix'],
                'list_attributes' => ['aria-labelledby' => 'dropdownMenu1'],
                'items'           => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ]];

        $sContent = '';

        //Prepend
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-prepend' => new \Laminas\Form\Element\Button('prepend-button', $aButtonOptions)]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Append
        $oInput = new \Laminas\Form\Element\Text('input-username', ['add-on-append' => new \Laminas\Form\Element\Button('append-button', $aButtonOptions)]);
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'input-groups-buttons-segmented.phtml', $sContent);
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
