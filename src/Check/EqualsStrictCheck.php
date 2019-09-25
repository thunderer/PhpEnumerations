<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class EqualsStrictCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'equals-strict';
    }

    public function getDescription(): string
    {
        return 'Compare enum instances using strict (===) comparison operator.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $sameA = $vendor->enumValidA() === $vendor->enumValidA();
        $differentB = $vendor->enumValidA() !== $vendor->enumValidB();
        $differentOther = $vendor->enumValidB() !== $vendor->enumOther();

        return ResultValue::fromCondition($sameA && $differentB && $differentOther);
    }
}
