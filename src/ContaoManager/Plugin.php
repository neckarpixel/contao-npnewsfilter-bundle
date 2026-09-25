<?php

declare(strict_types=1);

namespace Neckarpixel\NpnewsfilterBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\NewsBundle\ContaoNewsBundle;
use Neckarpixel\NpnewsfilterBundle\ContaoNpnewsfilterBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoNpnewsfilterBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class, ContaoNewsBundle::class]),
        ];
    }
}
