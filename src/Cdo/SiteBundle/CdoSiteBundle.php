<?php

namespace Cdo\SiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Cdo\SiteBundle\DependencyInjection\CompilerPass\ConnectionCompilerPass;

class CdoSiteBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new ConnectionCompilerPass());
    }
}
