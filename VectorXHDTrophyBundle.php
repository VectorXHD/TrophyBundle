<?php

namespace VectorXHD\TrophyBundle;

use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use VectorXHD\TrophyBundle\DependencyInjection\Compiler\DoctrineResolveTargetEntityPass;
use VectorXHD\TrophyBundle\DependencyInjection\VectorXHDTrophyExtension;

class VectorXHDTrophyBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new DoctrineResolveTargetEntityPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1000);
    }

    public function getContainerExtension()
    {
        return new VectorXHDTrophyExtension();
    }
}
