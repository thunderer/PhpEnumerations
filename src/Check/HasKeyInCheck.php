<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class HasKeyInCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'has-key-in';
    }

    public function getDescription(): string
    {
        return 'Check whether enum member is one of given values.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $yes = $vendor->memberIn($first, ['VALID_A']);
        $no = $vendor->memberIn($first, ['INVALID']);

        return ResultValue::fromCondition($yes && false === $no);
    }
}
