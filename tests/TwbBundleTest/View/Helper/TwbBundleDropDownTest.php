<?php

namespace TwbBundleTest\View\Helper;

class TwbBundleDropDownTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \TwbBundle\View\Helper\TwbBundleDropDown
     */
    protected $dropDownHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->dropDownHelper     = $oViewHelperPluginManager->get('dropDown')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    public function testRenderToggleWithWrongTypeAttributes()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->dropDownHelper->renderToggle(['toggle_attributes' => 'wrong']);
    }

    public function testRenderToggleWithEmptyClassAttribute()
    {
        $this->assertEquals('<a class="sr-only&#x20;dropdown-toggle" data-toggle="dropdown" role="button" href="&#x23;"> <b class="caret"></b></a>', $this->dropDownHelper->renderToggle(['toggle_attributes' => ['class' => '']]));
    }

    public function testRenderToggleWithDefinedClassAttribute()
    {
        $this->assertEquals('<a class="test-toggle&#x20;sr-only&#x20;dropdown-toggle" data-toggle="dropdown" role="button" href="&#x23;"> <b class="caret"></b></a>', $this->dropDownHelper->renderToggle(['toggle_attributes' => ['class' => 'test-toggle']]));
    }

    public function testRenderItemWithDefinedClassAttribute()
    {
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\View\Helper\TwbBundleDropDown');
        $oReflectionMethod = $oReflectionClass->getMethod('renderItem');
        $oReflectionMethod->setAccessible(true);

        //Header
        $this->assertEquals(
            '<li class="test-item&#x20;dropdown-header" role="presentation">test-label</li>',
            $oReflectionMethod->invoke($this->dropDownHelper, [
                    'type'       => \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_HEADER,
                    'label'      => 'test-label',
                    'attributes' => ['class' => 'test-item']
                ])
        );

        //Divider
        $this->assertEquals(
            '<li class="test-item&#x20;divider" role="presentation"></li>',
            $oReflectionMethod->invoke($this->dropDownHelper, [
                    'type'       => \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER,
                    'attributes' => ['class' => 'test-item']
                ])
        );
    }
}
