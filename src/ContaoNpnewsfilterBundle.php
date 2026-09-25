<?php

declare(strict_types=1);

namespace Neckarpixel\NpnewsfilterBundle;

use Neckarpixel\NpnewsfilterBundle\DependencyInjection\ContaoNpnewsfilterExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoNpnewsfilterBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new ContaoNpnewsfilterExtension();
    }
}
