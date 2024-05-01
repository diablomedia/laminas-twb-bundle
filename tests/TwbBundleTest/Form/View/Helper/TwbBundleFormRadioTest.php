<?php

namespace TwbBundleTest\Form\View\Helper;

class TwbBundleFormRadioTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormRadio
     */
    protected $formRadioHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->formRadioHelper    = $oViewHelperPluginManager->get('formRadio')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    public function testRenderOptionsWithPrependingLabel()
    {
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\Form\View\Helper\TwbBundleFormRadio');
        $oReflectionMethod = $oReflectionClass->getMethod('renderOptions');
        $oReflectionMethod->setAccessible(true);

        $this->formRadioHelper->setLabelPosition(\TwbBundle\Form\View\Helper\TwbBundleFormRadio::LABEL_PREPEND);
        $this->assertEquals(
            '<label>test<input value="0" checked></label>',
            $oReflectionMethod->invoke($this->formRadioHelper, new \Laminas\Form\Element\Radio(), [0 => 'test'], [0], [])
        );
    }

    public function testRenderOptionsWithDefineAttributesId()
    {
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\Form\View\Helper\TwbBundleFormRadio');
        $oReflectionMethod = $oReflectionClass->getMethod('renderOptions');
        $oReflectionMethod->setAccessible(true);

        $this->formRadioHelper->setLabelPosition(\TwbBundle\Form\View\Helper\TwbBundleFormRadio::LABEL_PREPEND);
        $this->assertEquals(
            '<label>test1<input id="test_id" value="0" checked></label></div><div class="radio"><label>test2<input value="1"></label>',
            $oReflectionMethod->invoke($this->formRadioHelper, new \Laminas\Form\Element\Radio(), [0 => 'test1', 1 => 'test2'], [0], ['id' => 'test_id'])
        );
    }

    public function testRenderOptionsWithOptionsSpecs()
    {
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\Form\View\Helper\TwbBundleFormRadio');
        $oReflectionMethod = $oReflectionClass->getMethod('renderOptions');
        $oReflectionMethod->setAccessible(true);

        $this->formRadioHelper->setLabelPosition(\TwbBundle\Form\View\Helper\TwbBundleFormRadio::LABEL_PREPEND);
        $this->assertEquals(
            '<label>test1<input id="test_id" type="radio" value="0" checked></label></div><div class="radio"><label class="test-label-class">test2<input type="radio" class="test-class" value="" checked disabled></label>',
            $oReflectionMethod->invoke(
                $this->formRadioHelper,
                new \Laminas\Form\Element\Radio(),
                [0 => 'test1', 1 => ['label' => 'test2', 'selected' => true, 'disabled' => true, 'label_attributes' => ['class' => 'test-label-class'], 'attributes' => ['class' => 'test-class']]],
                [0],
                ['id' => 'test_id', 'type' => 'radio']
            )
        );
    }

}
