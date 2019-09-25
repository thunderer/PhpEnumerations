<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ExistsKeyCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'exists-key';
    }

    public function getDescription(): string
    {
        return 'Check whether given value is a valid enum member label.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $existsA = $vendor->keyExists('VALID_A');
        $existsB = $vendor->keyExists('VALID_B');
        $noOther = false === $vendor->keyExists('OTHER');

        return ResultValue::fromCondition($existsA && $existsB && $noOther);
    }
}
