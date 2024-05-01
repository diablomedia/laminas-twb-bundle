<?php
namespace TwbBundle\Form\View\Helper\Factory;

use TwbBundle\Form\View\Helper\TwbBundleFormElement;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Factory to inject the ModuleOptions hard dependency
 *
 * @author Fábio Carneiro <fahecs@gmail.com>
 * @license MIT
 */
class TwbBundleFormElementFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $options = $container->get('TwbBundle\Options\ModuleOptions');
        return new TwbBundleFormElement($options);
    }
}
