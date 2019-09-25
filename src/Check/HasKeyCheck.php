<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class HasKeyCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'has-key';
    }

    public function getDescription(): string
    {
        return 'Check whether enum instance represents given member label.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $second = $vendor->enumValidB();
        $other = $vendor->enumOther();

        $hasA = $vendor->hasKey($first, 'VALID_A');
        $hasB = $vendor->hasKey($second, 'VALID_B');
        $hasOther = $vendor->hasKey($other, 'OTHER');

        return ResultValue::fromCondition($hasA && $hasB && $hasOther);
    }
}
