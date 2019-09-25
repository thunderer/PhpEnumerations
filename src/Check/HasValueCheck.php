<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class HasValueCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'has-value';
    }

    public function getDescription(): string
    {
        return 'Check whether enum instance represents a member with given value.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $second = $vendor->enumValidB();
        $other = $vendor->enumOther();

        $hasA = $vendor->hasValue($first, 'valid-a');
        $hasB = $vendor->hasValue($second, 'valid-b');
        $hasOther = $vendor->hasValue($other, 'other');

        return ResultValue::fromCondition($hasA && $hasB && $hasOther);
    }
}
