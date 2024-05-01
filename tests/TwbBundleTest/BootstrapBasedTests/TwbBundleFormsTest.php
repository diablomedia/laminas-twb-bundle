<?php

namespace TwbBundleTest;

/**
 * Test forms rendering
 * Based on http://getbootstrap.com/css/#forms
 */
class TwbBundleFormsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleForm
     */
    protected $formHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-forms' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->formHelper         = $oViewHelperPluginManager->get('form')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-example
     */
    public function testBasicExample()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-email',
            'attributes' => [
                'type'        => 'email',
                'placeholder' => 'Enter email',
                'id'          => 'exampleInputEmail1'
            ],
            'options' => ['label' => 'Email address']
        ])->add([
            'name'       => 'input-password',
            'attributes' => [
                'type'        => 'password',
                'placeholder' => 'Password',
                'id'          => 'exampleInputPassword1'
            ],
            'options' => ['label' => 'Password',]
        ])->add([
            'name'       => 'input-file',
            'attributes' => [
                'type' => 'file',
                'id'   => 'exampleInputFile'
            ],
            'options' => [
                'label'      => 'File input',
                'help-block' => 'Example block-level help text here.'
            ]
        ])->add([
            'name'    => 'input-checkbox',
            'type'    => 'checkbox',
            'options' => ['label' => 'Check me out']
        ])->add([
            'name'       => 'button-submit',
            'type'       => 'button',
            'attributes' => ['type' => 'submit'],
            'options'    => ['label' => 'Submit']
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'basic-example.phtml', $this->formHelper->__invoke($oForm, null));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-inline
     */
    public function testInlineForm()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-email',
            'attributes' => [
                'type'        => 'email',
                'placeholder' => 'Enter email',
                'id'          => 'exampleInputEmail2'
            ],
            'options' => ['label' => 'Email address', 'showLabel' => false]
        ])->add([
            'name'       => 'input-email2',
            'attributes' => [
                'type'        => 'email2',
                'placeholder' => 'Enter email2',
                'id'          => 'exampleInputEmail2a'
            ],
            'options' => ['label' => 'Email address2', 'showLabel' => true]
        ])->add([
            'name'       => 'input-password',
            'attributes' => [
                'type'        => 'password',
                'placeholder' => 'Password',
                'id'          => 'exampleInputPassword2'
            ],
            'options' => ['label' => 'Password']
        ])->add([
            'name'    => 'input-checkbox',
            'type'    => 'checkbox',
            'options' => ['label' => 'Remember me']
        ])->add([
            'name'       => 'button-submit',
            'type'       => 'button',
            'attributes' => ['type' => 'submit'],
            'options'    => ['label' => 'Sign in']
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'inline-form.phtml', $this->formHelper->__invoke($oForm, \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_INLINE));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-horizontal
     */
    public function testHorizontalform()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-email',
            'attributes' => [
                'type'        => 'email',
                'placeholder' => 'Enter email',
                'id'          => 'inputEmail1'
            ],
            'options' => [
                'label'            => 'Email',
                'column-size'      => 'sm-10',
                'label_attributes' => ['class' => 'col-sm-2']
            ]
        ])->add([
            'name'       => 'input-password',
            'attributes' => [
                'type'        => 'password',
                'placeholder' => 'Password',
                'id'          => 'inputPassword1'
            ],
            'options' => ['label' => 'Password', 'column-size' => 'sm-10', 'label_attributes' => ['class' => 'col-sm-2']]
        ])->add([
            'name'    => 'input-checkbox',
            'type'    => 'checkbox',
            'options' => ['label' => 'Remember me', 'column-size' => 'sm-10 col-sm-offset-2']
        ])->add([
            'name'       => 'button-submit',
            'type'       => 'button',
            'attributes' => ['type' => 'submit'],
            'options'    => ['label' => 'Sign in', 'column-size' => 'sm-10 col-sm-offset-2']
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'horizontal-form.phtml', $this->formHelper->__invoke($oForm));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-horizontal
     */
    public function testHorizontalformButtonGroup()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-email',
            'attributes' => [
                'type'        => 'email',
                'placeholder' => 'Enter email',
                'id'          => 'inputEmail1'
            ],
            'options' => [
                'label'            => 'Email',
                'column-size'      => 'sm-10',
                'label_attributes' => ['class' => 'col-sm-2']
            ]
        ])->add([
            'name'       => 'input-password',
            'attributes' => [
                'type'        => 'password',
                'placeholder' => 'Password',
                'id'          => 'inputPassword1'
            ],
            'options' => ['label' => 'Password', 'column-size' => 'sm-10', 'label_attributes' => ['class' => 'col-sm-2']]
        ])->add([
            'name'    => 'input-checkbox',
            'type'    => 'checkbox',
            'options' => ['label' => 'Remember me', 'column-size' => 'sm-10 col-sm-offset-2']
        ])->add([
            'name'       => 'button-submit',
            'type'       => 'button',
            'attributes' => ['type' => 'submit'],
            'options'    => ['label' => 'Sign in', 'column-size' => 'sm-10 col-sm-offset-2', 'button-group' => 'group-1']
        ])->add([
            'name'       => 'button-reset',
            'type'       => 'button',
            'attributes' => ['type' => 'reset'],
            'options'    => ['label' => 'Reset form', 'column-size' => 'sm-8 col-sm-offset-4', 'button-group' => 'group-1']
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'horizontal-form-button-group.phtml', $this->formHelper->__invoke($oForm));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-controls
     */
    public function testSupportedControlsform()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-text',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => 'Text input',
            ]
        ])->add([
            'name'       => 'input-text-area',
            'type'       => 'textarea',
            'attributes' => [
                'row' => 3
            ]
        ])->add([
            'name'    => 'input-checkbox',
            'type'    => 'checkbox',
            'options' => ['label' => 'Option one is this and that-be sure to include why it\'s great']
        ])->add([
            'name'    => 'optionsRadios',
            'type'    => 'radio',
            'options' => [
                'value_options' => [
                    'option1'        => 'Option one is this and that-be sure to include why it\'s great',
                    'optionsRadios2' => 'Option two can be something else and selecting it will deselect option one'
                ]
            ]
        ])->add([
            'name'    => 'optionsRadiosNoInline',
            'type'    => 'MultiCheckbox',
            'options' => [
                'value_options' => [
                    ['label' => '1', 'value' => 'option1', 'attributes' => ['id' => 'noInlineCheckbox1']],
                    ['label' => '2', 'value' => 'option2', 'attributes' => ['id' => 'noInlineCheckbox2']],
                    ['label' => '3', 'value' => 'option3', 'attributes' => ['id' => 'noInlineCheckbox3']]
                ]
            ]
        ])->add([
            'name'    => 'optionsRadios',
            'type'    => 'MultiCheckbox',
            'options' => [
                'value_options' => [
                    ['label' => '1', 'value' => 'option1', 'attributes' => ['id' => 'inlineCheckbox1']],
                    ['label' => '2', 'value' => 'option2', 'attributes' => ['id' => 'inlineCheckbox2']],
                    ['label' => '3', 'value' => 'option3', 'attributes' => ['id' => 'inlineCheckbox3']]
                ],
                'inline' => true
            ]
        ])->add([
            'name'    => 'select',
            'type'    => 'select',
            'options' => ['value_options' => [1, 2, 3, 4, 5]]
        ])->add([
            'name'       => 'multiple-select',
            'type'       => 'select',
            'options'    => ['value_options' => [1, 2, 3, 4, 5]],
            'attributes' => ['multiple' => true]
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'supported-controls-form.phtml', $this->formHelper->__invoke($oForm, null));
    }

    public function testRenderMultiCheckboxInlineWithLabel()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'    => 'optionsRadios',
            'type'    => 'MultiCheckbox',
            'options' => [
                'label'            => 'Test label',
                'column-size'      => 'sm-10',
                'label_attributes' => ['class' => 'col-sm-2'],
                'value_options'    => [
                    ['label' => '1', 'value' => 'option1', 'attributes' => ['id' => 'inlineCheckbox1']],
                    ['label' => '2', 'value' => 'option2', 'attributes' => ['id' => 'inlineCheckbox2']],
                    ['label' => '3', 'value' => 'option3', 'attributes' => ['id' => 'inlineCheckbox3']]
                ],
                'inline' => true
            ]
        ]);
        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'multi-checkbox-inline.phtml', $this->formHelper->__invoke($oForm));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-controls-static
     */
    public function testStaticControlform()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'static-element',
            'type'       => '\TwbBundle\Form\Element\StaticElement',
            'attributes' => ['value' => 'email@example.com'],
            'options'    => ['label' => 'Email', 'column-size' => 'lg-10', 'label_attributes' => ['class' => 'col-lg-2']]
        ])->add([
            'name'       => 'input-password',
            'attributes' => [
                'type'        => 'password',
                'placeholder' => 'Password',
                'id'          => 'inputPassword'
            ],
            'options' => ['label' => 'Password', 'column-size' => 'lg-10', 'label_attributes' => ['class' => 'col-lg-2']]
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'static-control-form.phtml', $this->formHelper->__invoke($oForm));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-control-states
     */
    public function testControlStatesform()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-text-disabled',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => 'Disabled input here...',
                'id'          => 'disabledInput'
            ]
        ]);

        $oFieldset = new \Laminas\Form\Fieldset('fieldset-disabled');
        $oForm->add($oFieldset->setAttributes(['disabled' => true])->add([
                    'name'       => 'input-text-disabled',
                    'attributes' => [
                        'type'        => 'text',
                        'placeholder' => 'Disabled input',
                        'id'          => 'disabledTextInput'
                    ],
                    'options' => ['label' => 'Disabled input']
                ])->add([
                    'name'    => 'disabled-select',
                    'type'    => 'select',
                    'options' => [
                        'label'         => 'Disabled select menu',
                        'value_options' => ['' => 'Disabled select']
                    ],
                    'attributes' => ['id' => 'disabled-select']
                ])->add([
                    'name'    => 'input-checkbox',
                    'type'    => 'checkbox',
                    'options' => ['label' => 'Can\'t check this']
                ])->add([
                    'name'       => 'button-submit',
                    'type'       => 'button',
                    'attributes' => ['type' => 'submit', 'class' => 'btn-primary'],
                    'options'    => ['label' => 'Submit']
        ]));

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'control-states-form.phtml', $this->formHelper->__invoke($oForm, null));

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'control-states-form-horizontal.phtml', $this->formHelper->__invoke($oForm));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-validation
     */
    public function testFormsValidation()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-text-success',
            'attributes' => [
                'type' => 'text',
                'id'   => 'inputSuccess'
            ],
            'options' => [
                'label'            => 'Input with success',
                'validation-state' => 'success'
            ]
        ])->add([
            'name'       => 'input-text-warning',
            'attributes' => [
                'type' => 'text',
                'id'   => 'inputWarning'
            ],
            'options' => [
                'label'            => 'Input with warning',
                'validation-state' => 'warning'
            ]
        ])->add([
            'name'       => 'input-text-error',
            'attributes' => [
                'type' => 'text',
                'id'   => 'inputError'
            ],
            'options' => [
                'label'            => 'Input with error',
                'validation-state' => 'error'
            ]
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-validation.phtml', $this->formHelper->__invoke($oForm, null));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-control-sizes
     */
    public function testFormsControlSizes()
    {

        //Height sizing
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-text-lg',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => '.input-lg',
                'class'       => 'input-lg'
            ]
        ])->add([
            'name'       => 'input-text-default',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => 'Default input'
            ]
        ])->add([
            'name'       => 'input-text-sm',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => '.input-sm',
                'class'       => 'input-sm'
            ]
        ])->add([
            'name'       => 'lg-select',
            'type'       => 'select',
            'options'    => ['value_options' => ['' => '.input-lg']],
            'attributes' => ['class' => 'input-lg']
        ])->add([
            'name'    => 'default-select',
            'type'    => 'select',
            'options' => ['value_options' => ['' => 'Default select']]
        ])->add([
            'name'       => 'sm-select',
            'type'       => 'select',
            'options'    => ['value_options' => ['' => '.input-sm']],
            'attributes' => ['class' => 'input-sm']
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-control-sizes-height.phtml', $this->formHelper->__invoke($oForm, null));

        //Column sizing
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-text-col-lg-2',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => '.col-lg-2'
            ],
            'options' => ['column-size' => 'lg-2']
        ])->add([
            'name'       => 'input-text-col-lg-3',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => '.col-lg-3'
            ],
            'options' => ['column-size' => 'lg-3']
        ])->add([
            'name'       => 'input-text-col-lg-4',
            'attributes' => [
                'type'        => 'text',
                'placeholder' => '.col-lg-4'
            ],
            'options' => ['column-size' => 'lg-4']
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-control-sizes-column.phtml', $this->formHelper->__invoke($oForm, \TwbBundle\Form\View\Helper\TwbBundleForm::LAYOUT_INLINE));
    }

    /**
     * Test http://getbootstrap.com/css/#forms-help-text
     */
    public function testFormsHelpText()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm->add([
            'name'       => 'input-text',
            'attributes' => ['type' => 'text'],
            'options'    => [
                'help-block' => 'A block of help text that breaks onto a new line and may extend beyond one line.'
            ]
        ]);

        //Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-help-text.phtml', $this->formHelper->__invoke($oForm, null));
    }

    /**
     * Test errored input rendering
     */
    public function testFormsErroredInput()
    {
        $oForm    = new \Laminas\Form\Form();
        $oElement = new \Laminas\Form\Element\Text('input-text');
        $oForm->add($oElement
                        ->setMessages([
                            'This is an error message',
                            'This is an another one error message'
        ]));

        //No form layout
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-no-layout-errored-input.phtml', $this->formHelper->__invoke($oForm, null));

        //Horizontal form
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-horizontal-errored-input.phtml', $this->formHelper->__invoke($oForm));

        //Horizontal form / input with label
        $oElement
                ->setOptions(['column-size' => 'lg-10'])
                ->setLabel('Input label')
                ->setLabelAttributes(['class' => 'col-lg-2']);
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-horizontal-errored-input-with-label.phtml', $this->formHelper->__invoke($oForm));
    }

    public function testFormWithButtonGroups()
    {
        $oForm = new \Laminas\Form\Form();
        $oForm
                ->add(new \Laminas\Form\Element\Text('input-text-1'))
                ->add(new \Laminas\Form\Element\Button('input-button-1', ['label' => 'Left', 'button-group' => 'group-1']))
                ->add(new \Laminas\Form\Element\Button('input-button-2', ['label' => 'Right', 'button-group' => 'group-1']))
                ->add(new \Laminas\Form\Element\Button('input-button-3', ['label' => 'Left', 'button-group' => 'group-2']))
                ->add(new \Laminas\Form\Element\Button('input-button-4', ['label' => 'Right', 'button-group' => 'group-2']))
                ->add(new \Laminas\Form\Element\Text('input-text-3'));

        // Test content
        $this->twbAssertStringEqualsFile($this->expectedPath . 'forms-button-groups.phtml', $this->formHelper->__invoke($oForm));
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
