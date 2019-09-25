<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class InfoPackagistCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'package';
    }

    public function getDescription(): string
    {
        return 'Packagist vendor/package alias.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::info($vendor->packagistVendor());
    }
}
