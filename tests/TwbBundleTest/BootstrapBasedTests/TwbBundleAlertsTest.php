<?php
namespace TwbBundleTest;

/**
 * Test badges rendering
 * Based on http://getbootstrap.com/components/#alerts
 */
class TwbBundleAlertsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleAlert
     */
    protected $alertHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        $this->expectedPath       = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-alerts' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer                = new \Laminas\View\Renderer\PhpRenderer();
        $this->alertHelper        = $oViewHelperPluginManager->get('alert')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/components/#alerts-examples
     */
    public function testExamples()
    {
        $sContent = '';

        //Success
        $sContent .= $this->alertHelper->__invoke('<strong>Well done!</strong> You successfully read this important alert message.', 'alert-success') . "\n";

        //Info
        $sContent .= $this->alertHelper->__invoke('<strong>Heads up!</strong> This alert needs your attention, but it\'s not super important.', 'alert-info') . "\n";

        //Warning
        $sContent .= $this->alertHelper->__invoke('<strong>Warning!</strong> Best check yo self, you\'re not looking too good.', 'alert-warning') . "\n";

        //Danger
        $sContent .= $this->alertHelper->__invoke('<strong>Oh snap!</strong> Change a few things up and try submitting again.', 'alert-danger') . "\n";

        $this->assertStringEqualsFile($this->expectedPath . 'alerts-examples.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#alerts-dismissable
     */
    public function testDismissableAlerts()
    {

        $sContent = $this->alertHelper->__invoke('<strong>Warning!</strong> Best check yo self, you\'re not looking too good.', null, true) . "\n";

        $this->assertStringEqualsFile($this->expectedPath . 'alerts-dismissable.phtml', $sContent);
    }
}
