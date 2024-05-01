<?php

namespace TwbBundleTest\Form\View\Helper;

class TwbBundleFormCollectionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormCollection
     */
    protected $formCollectionHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $oViewHelperPluginManager   = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                  = new \Laminas\View\Renderer\PhpRenderer();
        $this->formCollectionHelper = $oViewHelperPluginManager->get('formCollection')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    public function testRenderWithPluginFunctionUnavailable()
    {
        $this->formCollectionHelper->setView(new \Laminas\View\Renderer\FeedRenderer());
        $this->assertEquals('', $this->formCollectionHelper->render(new \Laminas\Form\Element\Collection(null, ['label' => 'test-element'])));
    }

    public function testRenderWithShouldWrap()
    {
        $this->formCollectionHelper->setShouldWrap(true);
        $this->assertEquals(
            '<fieldset><legend>test-element</legend></fieldset>',
            $this->formCollectionHelper->render(new \Laminas\Form\Element\Collection(null, ['label' => 'test-element']))
        );
    }

    public function testRenderWithShouldCreateTemplate()
    {
        $oElement = new \Laminas\Form\Element('test');
        $oForm    = new \Laminas\Form\Form();
        $oForm->add([
            'name'    => 'test-collection',
            'type'    => 'Laminas\Form\Element\Collection',
            'options' => [
                'should_create_template' => true,
                'target_element'         => $oElement
            ]
        ]);
        $this->assertEquals(
            '<fieldset><span data-template="DATA_TEMPLATE"></span></fieldset>',
            preg_replace('/<span data-template="[^"]+"><\/span>/', '<span data-template="DATA_TEMPLATE"></span>', $this->formCollectionHelper->render($oForm->get('test-collection')))
        );
    }

    public function testRenderInlineFieldsetWithAlreadyDefinedClass()
    {
        $oFieldset = new \Laminas\Form\Fieldset('inline-fieldset', ['twb-layout' => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_INLINE]);
        $oFieldset->setAttributes(['id' => 'inline-fieldset', 'class' => 'test-class']);

        $oFieldset->add([
            'name'       => 'input-one',
            'attributes' => ['placeholder' => 'input-one'],
            'options'    => ['label' => '']
        ])->add([
            'name'       => 'input-two',
            'attributes' => ['placeholder' => 'input-two'],
            'options'    => ['label' => '']
        ]);

        $oCollection = new \Laminas\Form\Element\Collection('inline-collection', [
            'twb-layout' => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_INLINE
        ]);
        $oCollection->add($oFieldset)->setAttributes(['id' => 'inline-collection']);

        $oForm = new \Laminas\Form\Form();
        $oForm->add($oCollection);

        $this->twbAssertStringEqualsFile(
            __DIR__ . DIRECTORY_SEPARATOR . '../../../../_files/expected-fieldsets/inline-fieldset.html',
            $this->formCollectionHelper->__invoke($oForm->get('inline-collection'), false)
        );
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
