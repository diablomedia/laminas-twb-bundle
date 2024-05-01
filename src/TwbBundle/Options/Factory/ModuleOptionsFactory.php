<?php
namespace TwbBundle\Options\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use TwbBundle\Options\ModuleOptions;
use Psr\Container\ContainerInterface;

class ModuleOptionsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config  = $container->get('config');
        $options = $config['twbbundle'];
        return new ModuleOptions($options);
    }
}
