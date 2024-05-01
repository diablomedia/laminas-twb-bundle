<?php

namespace TwbBundleTest\Form\View\Helper;

class TwbBundleFormButtonTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormButton
     */
    protected $formButtonHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->formButtonHelper   = $oViewHelperPluginManager->get('formButton')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    public function testRenderElementWithEmptyButtonContentandLabel()
    {
        $this->expectException(\DomainException::class);

        $this->formButtonHelper->render(new \Laminas\Form\Element(null, ['dropdown' => ['test']]));
    }

    public function testRenderWithUndefinedButtonClass()
    {
        $oElement = new \Laminas\Form\Element('test', ['label' => 'test']);
        $oElement->setAttribute('class', 'test');
        $this->assertEquals('<button name="test" class="test&#x20;btn&#x20;btn-default" type="submit" value="">test</button>', $this->formButtonHelper->render($oElement));
    }

    public function testRenderWithWrongTypeGlyphiconOption()
    {
        $this->expectException(\LogicException::class);

        $this->formButtonHelper->render(new \Laminas\Form\Element('test', ['glyphicon' => new \stdClass()]));
    }

    public function testRenderWithWrongTypeGlyphiconIconOption()
    {
        $this->expectException(\LogicException::class);
        $this->formButtonHelper->render(new \Laminas\Form\Element('test', ['glyphicon' => ['icon' => new \stdClass()]]));
    }

    public function testRenderWithEmptyGlyphiconPositionOption()
    {
        $this->assertEquals(
            '<button name="test" class="btn&#x20;btn-default" type="submit" value=""><span class="glyphicon&#x20;glyphicon-test"></span></button>',
            $this->formButtonHelper->render(new \Laminas\Form\Element('test', ['glyphicon' => ['icon' => 'test']]))
        );
    }

    public function testRenderWithEmptyFontAwesomePositionOption()
    {
        $this->assertEquals(
            '<button name="test" class="btn&#x20;btn-default" type="submit" value=""><span class="fa&#x20;fa-test"></span></button>',
            $this->formButtonHelper->render(new \Laminas\Form\Element('test', ['fontAwesome' => ['icon' => 'test']]))
        );
    }

    public function testRenderWithWrongTypeGlyphiconPositionOption()
    {
        $this->expectException(\LogicException::class);
        $this->formButtonHelper->render(new \Laminas\Form\Element('test', ['glyphicon' => ['icon' => 'test', 'position' => new \stdClass()]]));
    }

    public function testRenderWithWrongGlyphiconPositionOption()
    {
        $this->expectException(\LogicException::class);
        $this->formButtonHelper->render(new \Laminas\Form\Element('test', ['glyphicon' => ['icon' => 'test', 'position' => 'wrong']]));
    }

    public function testRenderWithAppendGlyphiconPositionOption()
    {
        $this->assertEquals(
            '<button name="test" class="btn&#x20;btn-default" type="submit" value="">test <span class="glyphicon&#x20;glyphicon-test"></span></button>',
            $this->formButtonHelper->render(new \Laminas\Form\Element('test', [
                    'label'     => 'test',
                    'glyphicon' => ['icon' => 'test', 'position' => \TwbBundle\Form\View\Helper\TwbBundleFormButton::ICON_APPEND,]
                ]))
        );
    }

    public function testRenderWithWrongTypeDropdownOption()
    {
        $this->expectException(\LogicException::class);
        $this->formButtonHelper->render(new \Laminas\Form\Element('test', ['label' => 'test', 'dropdown' => new \stdClass()]));
    }
}
