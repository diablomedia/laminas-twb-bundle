<?php

namespace TwbBundleTest\Form\View\Helper;

class TwbBundleFormRowTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormRow
     */
    protected $formRowHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../../../_files/expected-rows' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $oRenderer->setResolver(\TwbBundleTest\Bootstrap::getServiceManager()->get('ViewResolver'));
        $this->formRowHelper = $oViewHelperPluginManager->get('formRow')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
        $this->formRowHelper->setPartial(null);
    }

    public function testRenderPartial()
    {
        $this->formRowHelper->setPartial('partial-row');

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'partial.phtml', $this->formRowHelper->render(new \Laminas\Form\Element('test-element')));
    }

    public function testRenderAddOnWithValidationStateAndDefinedLabelClass()
    {
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\Form\View\Helper\TwbBundleFormRow');
        $oReflectionMethod = $oReflectionClass->getMethod('renderElement');
        $oReflectionMethod->setAccessible(true);

        $oElement = new \Laminas\Form\Element('test-element', ['validation-state' => 'warning']);
        $oElement
                ->setLabel('test-label')
                ->setLabelAttributes(['class' => 'test-label-class']);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'add-on-validation-states.phtml', $oReflectionMethod->invoke($this->formRowHelper, $oElement));
    }

    public function testRenderAddOnWithInlineLayoutAndDefinedLabelClass()
    {
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\Form\View\Helper\TwbBundleFormRow');
        $oReflectionMethod = $oReflectionClass->getMethod('renderElement');
        $oReflectionMethod->setAccessible(true);

        $oElement = new \Laminas\Form\Element('test-element', ['twb-layout' => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_INLINE]);
        $oElement
                ->setLabel('test-label')
                ->setLabelAttributes(['class' => 'test-label-class']);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'add-on-inline-layout.phtml', $oReflectionMethod->invoke($this->formRowHelper, $oElement));
    }

    public function testRenderAddOnWithHorizontalLayoutAndDefinedLabelClass()
    {
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\Form\View\Helper\TwbBundleFormRow');
        $oReflectionMethod = $oReflectionClass->getMethod('renderElement');
        $oReflectionMethod->setAccessible(true);

        $oElement = new \Laminas\Form\Element('test-element', ['twb-layout' => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL]);
        $oElement
                ->setLabel('test-label')
                ->setLabelAttributes(['class' => 'test-label-class']);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'add-on-horizontal-layout.phtml', $oReflectionMethod->invoke($this->formRowHelper, $oElement));
    }

    public function testRenderAddOnWithWrongLayout()
    {
        $this->expectException(\DomainException::class);
        $oReflectionClass  = new \ReflectionClass('\TwbBundle\Form\View\Helper\TwbBundleFormRow');
        $oReflectionMethod = $oReflectionClass->getMethod('renderElement');
        $oReflectionMethod->setAccessible(true);
        $oReflectionMethod->invoke($this->formRowHelper, new \Laminas\Form\Element('test-element', ['label' => 'test-label', 'twb-layout' => 'wrong']));
    }

    public function testRenderErrorsWithInputErrorClass()
    {
        $this->formRowHelper->setInputErrorClass('input-error');
        $oElement = new \Laminas\Form\Element\Text('input-text');
        $oElement->setAttribute('class', 'test-class');
        $oElement->setMessages([
            'This is an error message',
            'This is an another one error message'
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'errors-input-errors-class.phtml', $this->formRowHelper->__invoke($oElement));
    }

    public function testRenderErrorsWithoutInputErrorClass()
    {
        $this->formRowHelper->setInputErrorClass('input-error');
        $oElement = new \Laminas\Form\Element\Text('input-text');
        $oElement->setMessages([
            'This is an error message',
            'This is an another one error message'
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'errors-without-input-errors-class.phtml', $this->formRowHelper->__invoke($oElement));
    }

    public function testRenderHiddenElement()
    {
        $this->formRowHelper->setInputErrorClass('input-error');
        $oElement = new \Laminas\Form\Element\Hidden('input-hidden');
        //Test content
        $this->assertEquals(
            '<input type="hidden" name="input-hidden" class="form-control" value="">',
            $this->formRowHelper->__invoke($oElement)
        );

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'hidden-element.phtml', $this->formRowHelper->__invoke($oElement));
    }

    public function testRendeCheckboxWithDefinedLabelAttributes()
    {
        $oElement = new \Laminas\Form\Element\Checkbox('test-checkbox');
        $oElement->setLabel('Test checkbox');
        $aLabelAttributes = $this->formRowHelper->getLabelAttributes();
        $this->formRowHelper->setLabelAttributes(['class' => 'test-class']);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'checkbox-defined-label-attributes.phtml', $this->formRowHelper->__invoke($oElement));

        // Restore original label attributes
        $this->formRowHelper->setLabelAttributes($aLabelAttributes);
    }

    public function testRenderRadiosWithHorizontalLayout()
    {
        $oElement = new \Laminas\Form\Element\Radio('test-radio', [
            'twb-layout'       => \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_HORIZONTAL,
            'label'            => 'Test radio',
            'column-size'      => 'sm-10',
            'label_attributes' => ['class' => 'col-sm-2'],
            'value_options'    => [
                'option1' => 'Option one',
                'option2' => 'Option two'
            ]
        ]);

        // Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'radio-horizontal-layout.phtml', $this->formRowHelper->__invoke($oElement));
    }

    public function testRenderFormRowWithSpecificClass()
    {
        $oElement = new \Laminas\Form\Element\Text('test-text', [
            'label'            => 'Test text',
            'column-size'      => 'sm-10',
            'label_attributes' => ['class' => 'col-sm-2'],
            'twb-row-class'    => 'my-row-class'
        ]);

        // Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'row-class.phtml', $this->formRowHelper->__invoke($oElement));
    }

    public function testRenderInputWithHelpTextAndError()
    {
        $oElement = new \Laminas\Form\Element\Text('input-text', [
            'label'      => 'Input text label',
            'help-block' => 'Help block text'
        ]);
        $oElement->setMessages(['Error message']);
        // Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'input-with-help-text-and-error.phtml', $this->formRowHelper->__invoke($oElement));
    }

    public function testRenderWithBothInlineAndNoInlineRadios()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'    => 'optInput1',
            'type'    => 'radio',
            'options' => [
                'label'         => 'Opt1',
                'value_options' => ['label1','label2','label3'],
                'inline'        => true,
            ],
        ])->add([
            'name'    => 'optInput2',
            'type'    => 'radio',
            'options' => [
                'label'         => 'Opt2',
                'value_options' => ['label1','label2','label3'],
                'inline'        => false,
            ],
        ]);

        $this->twbAssertStringEqualsFile($this->expectedPath . 'both-inline-and-no-inline-radios.phtml', $this->formRowHelper->__invoke($oForm->get('optInput1')) . $this->formRowHelper->__invoke($oForm->get('optInput2')));
    }

    public function testAllowsFeedbackInTextField()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'    => 'username',
            'type'    => 'text',
            'options' => [
                'label'    => 'Your Username',
                'feedback' => 'glyphicon glyphicon-user',
            ],
        ]);

        $this->twbAssertStringEqualsFile($this->expectedPath . 'has-feedback-in-textfield.phtml', $this->formRowHelper->__invoke($oForm->get('username')));
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
