<?php

namespace VectorXHD\TrophyBundle\DependencyInjection\Compiler;

use Doctrine\ORM\Version;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use VectorXHD\TrophyBundle\Entity\UserTrophyInterface;

class DoctrineResolveTargetEntityPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition('doctrine.orm.listeners.resolve_target_entity');

        $definition->addMethodCall('addResolveTargetEntity', array(
            UserTrophyInterface::class,
            $container->getParameter('vectorxhd_trophy.user_class'),
            array(),
        ));

        if (version_compare(Version::VERSION, '2.5.0-DEV') < 0) {
            $definition->addTag('doctrine.event_listener', array('event' => 'loadClassMetadata'));
        } else {
            $definition->addTag('doctrine.event_subscriber', array('connection' => 'default'));
        }
    }
}