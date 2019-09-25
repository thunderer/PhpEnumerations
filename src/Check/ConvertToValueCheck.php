<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ConvertToValueCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'to-value';
    }

    public function getDescription(): string
    {
        return 'Get member value from enum instance.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();

        return ResultValue::fromSame('valid-a', $vendor->getValue($first));
    }
}
