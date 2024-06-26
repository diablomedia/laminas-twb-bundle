<?php

namespace TwbBundleTest\Form\View\Helper;

class TwbBundleFormMultiCheckboxTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormMultiCheckbox
     */
    protected $formMultiCheckboxHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $oViewHelperPluginManager      = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                     = new \Laminas\View\Renderer\PhpRenderer();
        $this->formMultiCheckboxHelper = $oViewHelperPluginManager->get('formMultiCheckbox')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    public function testRenderWithNoInline()
    {
        $oElement = new \Laminas\Form\Element\MultiCheckbox('test-element', ['inline' => false, 'value_options' => ['test-option']]);
        $this->formMultiCheckboxHelper->render($oElement);
        $this->assertEquals(['class' => 'checkbox'], $oElement->getLabelAttributes());
    }

}
