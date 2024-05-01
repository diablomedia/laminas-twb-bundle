<?php

namespace TwbBundleTest;

/**
 * Test button groups rendering
 * Based on http://getbootstrap.com/components/#btn-groups
 */
class TwbBundleButtonGroupsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\View\Helper\TwbBundleButtonGroup
     */
    protected $buttonGroupHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-button-groups' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->buttonGroupHelper  = $oViewHelperPluginManager->get('buttonGroup')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/components/#btn-groups-single
     */
    public function testBasicExemple()
    {
        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'single.phtml', $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('left', ['label' => 'Left']),
                    new \Laminas\Form\Element\Button('middle', ['label' => 'Middle']),
                    new \Laminas\Form\Element\Button('right', ['label' => 'Right']),
        ]));
    }

    /**
     * Test http://getbootstrap.com/components/#btn-groups-toolbar
     */
    public function testButtonToolbar()
    {

        $sContent = '<div class="btn-toolbar" role="toolbar">';

        //First group
        $sContent .= $this->buttonGroupHelper->__invoke([
            new \Laminas\Form\Element\Button('1', ['label' => '1']),
            new \Laminas\Form\Element\Button('2', ['label' => '2']),
            new \Laminas\Form\Element\Button('3', ['label' => '3']),
            new \Laminas\Form\Element\Button('4', ['label' => '4']),
        ]);

        //Second group
        $sContent .= $this->buttonGroupHelper->__invoke([
            new \Laminas\Form\Element\Button('5', ['label' => '5']),
            new \Laminas\Form\Element\Button('6', ['label' => '6']),
            new \Laminas\Form\Element\Button('7', ['label' => '7']),
        ]);

        //Third group
        $sContent .= $this->buttonGroupHelper->__invoke([
            new \Laminas\Form\Element\Button('8', ['label' => '8']),
        ]);

        $sContent .= '</div>';

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'toolbar.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#btn-groups-sizing
     */
    public function testSizing()
    {

        $sContent = '';

        //Large
        $sContent .= '<div class="btn-toolbar" role="toolbar">' . $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('left', ['label' => 'Left']),
                    new \Laminas\Form\Element\Button('middle', ['label' => 'Middle']),
                    new \Laminas\Form\Element\Button('right', ['label' => 'Right']),
                        ], ['attributes' => ['class' => 'btn-group-lg']]) . '</div>';

        //Normal
        $sContent .= '<div class="btn-toolbar" role="toolbar">' . $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('left', ['label' => 'Left']),
                    new \Laminas\Form\Element\Button('middle', ['label' => 'Middle']),
                    new \Laminas\Form\Element\Button('right', ['label' => 'Right']),
                ]) . '</div>';

        //Small
        $sContent .= '<div class="btn-toolbar" role="toolbar">' . $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('left', ['label' => 'Left']),
                    new \Laminas\Form\Element\Button('middle', ['label' => 'Middle']),
                    new \Laminas\Form\Element\Button('right', ['label' => 'Right']),
                        ], ['attributes' => ['class' => 'btn-group-sm']]) . '</div>';

        //Extra small
        $sContent .= '<div class="btn-toolbar" role="toolbar">' . $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('left', ['label' => 'Left']),
                    new \Laminas\Form\Element\Button('middle', ['label' => 'Middle']),
                    new \Laminas\Form\Element\Button('right', ['label' => 'Right']),
                        ], ['attributes' => ['class' => 'btn-group-xs']]) . '</div>';

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'sizing.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#btn-groups-nested
     */
    public function testNesting()
    {
        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'nested.phtml', $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('1', ['label' => '1']),
                    new \Laminas\Form\Element\Button('2', ['label' => '2']),
                    new \Laminas\Form\Element\Button('dropdown', ['label' => 'Dropdown', 'dropdown' => ['items' => ['Dropdown link', 'Dropdown link']]])
        ]));
    }

    /**
     * Test http://getbootstrap.com/components/#btn-groups-vertical
     */
    public function testVerticalVariation()
    {
        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'vertical.phtml', $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('button', ['label' => 'Button']),
                    new \Laminas\Form\Element\Button('button', ['label' => 'Button']),
                    new \Laminas\Form\Element\Button('dropdown', ['label' => 'Dropdown', 'dropdown' => ['items' => ['Dropdown link', 'Dropdown link']]]),
                    new \Laminas\Form\Element\Button('button', ['label' => 'Button']),
                    new \Laminas\Form\Element\Button('button', ['label' => 'Button']),
                    new \Laminas\Form\Element\Button('dropdown', ['label' => 'Dropdown', 'dropdown' => ['items' => ['Dropdown link', 'Dropdown link']]]),
                    new \Laminas\Form\Element\Button('dropdown', ['label' => 'Dropdown', 'dropdown' => ['items' => ['Dropdown link', 'Dropdown link']]]),
                    new \Laminas\Form\Element\Button('dropdown', ['label' => 'Dropdown', 'dropdown' => ['items' => ['Dropdown link', 'Dropdown link']]]),
                        ], ['attributes' => ['class' => 'btn-group-vertical']]));
    }

    /**
     * Test http://getbootstrap.com/components/#btn-groups-justified
     */
    public function testJustifiedButtonGroups()
    {
        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'justified.phtml', $this->buttonGroupHelper->__invoke([
                    new \Laminas\Form\Element\Button('left', ['label' => 'Left']),
                    new \Laminas\Form\Element\Button('middle', ['label' => 'Middle']),
                    new \Laminas\Form\Element\Button('right', ['label' => 'Right']),
                        ], ['attributes' => ['class' => 'btn-group-justified']]));
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
        file_put_contents($sExpectedFile, $sActualString);
        return parent::assertStringEqualsFile($sExpectedFile, $sActualString, $sMessage, $bCanonicalize, $bIgnoreCase);
    }

}
