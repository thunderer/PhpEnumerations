<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ExistsValueCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'exists-value';
    }

    public function getDescription(): string
    {
        return 'Check whether enum contains a member matching given value.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $existsA = $vendor->valueExists('valid-a');
        $existsB = $vendor->valueExists('valid-b');
        $noOther = false === $vendor->valueExists('other');

        return ResultValue::fromCondition($existsA && $existsB && $noOther);
    }
}
