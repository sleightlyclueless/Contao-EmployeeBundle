<?php

/**
 * @package   EmployeeBundle
 * @author    (c) IXTENSA GmbH & Co. KG Internet und Webagentur -- Sebastian Zill
 * @license   GNU LGPL 3+
 * @copyright (c) 2020
 */

namespace ixtensa\EmployeeBundle;

use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\CoreBundle\ContaoCoreBundle;
use ixtensa\JobsBundle\IxtensaJobsBundle;

// Lade das BundlePluginInterface von Contao
class ContaoManagerPlugin implements BundlePluginInterface
{
    // Ziehe dir die Bundles und Konfigurationsdateien vom Bundle Parser
	public function getBundles(ParserInterface $parser)
	{
        if (\class_exists('\ixtensa\JobsBundle\IxtensaJobsBundle')) {
			return [
	            BundleConfig::create(IxtensaEmployeeBundle::class)
	                ->setLoadAfter([IxtensaJobsBundle::class]),
			];
		}
		return [
            BundleConfig::create(IxtensaEmployeeBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
		];
	}
}
