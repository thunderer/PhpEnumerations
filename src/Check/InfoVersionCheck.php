<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use PackageVersions\Versions;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class InfoVersionCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'version';
    }

    public function getDescription(): string
    {
        return 'Installed package version.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $version = Versions::getVersion($vendor->packagistVendor());

        return ResultValue::info(substr($version, 0, strpos($version, '@')));
    }
}
