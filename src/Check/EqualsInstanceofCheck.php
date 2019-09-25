<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class EqualsInstanceofCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'equals-instanceof';
    }

    public function getDescription(): string
    {
        return 'Compare enum instances using instanceof operator.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $second = $vendor->enumValidB();
        $other = $vendor->enumOther();

        return ResultValue::fromCondition($first instanceof $second && false === $second instanceof $other);
    }
}
