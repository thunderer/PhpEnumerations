<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class HasValueInCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'has-value-in';
    }

    public function getDescription(): string
    {
        return 'Check whether enum value is one of given values.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $yes = $vendor->valueIn($first, ['valid-a']);
        $no = $vendor->valueIn($first, ['invalid']);

        return ResultValue::fromCondition($yes && false === $no);
    }
}
