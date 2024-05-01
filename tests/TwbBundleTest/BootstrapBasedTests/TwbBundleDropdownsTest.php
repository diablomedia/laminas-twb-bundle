<?php

namespace TwbBundleTest;

/**
 * Test dropdowns rendering
 * Based on http://getbootstrap.com/components/#dropdowns
 */
class TwbBundleDropdownsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\View\Helper\TwbBundleDropDown
     */
    protected $dropdownHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-dropdowns' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->dropdownHelper     = $oViewHelperPluginManager->get('dropDown')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/components/#dropdowns-example
     */
    public function testExample()
    {
        $aDropDownOptions = [
            'label'           => 'Dropdown',
            'name'            => 'dropdownMenu1',
            'attributes'      => ['class' => 'clearfix'],
            'list_attributes' => ['aria-labelledby' => 'dropdownMenu1'],
            'items'           => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ];

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'exemple.phtml', $this->dropdownHelper->__invoke($aDropDownOptions));
    }

    /**
     * Test http://getbootstrap.com/components/#dropdowns-alignment
     */
    public function testAlignment()
    {
        $aDropDownOptions = [
            'label'           => 'Dropdown',
            'name'            => 'dropdownMenu1',
            'attributes'      => ['class' => 'clearfix'],
            'list_attributes' => ['aria-labelledby' => 'dropdownMenu1', 'class' => 'pull-right'],
            'items'           => ['Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link']
        ];

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'alignment.phtml', $this->dropdownHelper->__invoke($aDropDownOptions));
    }

    /**
     * Test http://getbootstrap.com/components/#dropdowns-headers
     */
    public function testHeaders()
    {
        $aDropDownOptions = [
            'label'           => 'Dropdown',
            'name'            => 'dropdownMenu1',
            'attributes'      => ['class' => 'clearfix'],
            'list_attributes' => ['aria-labelledby' => 'dropdownMenu1'],
            'items'           => [
                ['type' => \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_HEADER, 'label' => 'Dropdown header'],
                'Action', 'Another action', 'Something else here',
                \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER,
                ['type' => \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_HEADER, 'label' => 'Dropdown header'],
                'Separated link'
            ]
        ];

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'headers.phtml', $this->dropdownHelper->__invoke($aDropDownOptions));
    }

    /**
     * Test http://getbootstrap.com/components/#dropdowns-disabled
     */
    public function testDisabled()
    {
        $aDropDownOptions = [
            'label'           => 'Dropdown',
            'name'            => 'dropdownMenu1',
            'attributes'      => ['class' => 'clearfix'],
            'list_attributes' => ['aria-labelledby' => 'dropdownMenu1'],
            'items'           => [
                'Regular link',
                'Disabled link' => ['attributes' => ['class' => 'disabled']],
                'Another link'
            ]
        ];

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'disabled.phtml', $this->dropdownHelper->__invoke($aDropDownOptions));
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
