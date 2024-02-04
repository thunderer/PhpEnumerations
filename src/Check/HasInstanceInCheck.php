<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class HasInstanceInCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'has-instance-in';
    }

    public function getDescription(): string
    {
        return 'Check whether given enum instance exists in a provided list of value.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $same = $vendor->instanceIn($vendor->enumValidA(), [$vendor->enumValidA(), $vendor->enumValidB()]);
        $other = $vendor->instanceIn($vendor->enumValidA(), [$vendor->enumOther()]);

        return ResultValue::fromCondition($same && false === $other);
    }
}
