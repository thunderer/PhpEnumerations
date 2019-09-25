<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ListKeyToValueCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'key-to-value';
    }

    public function getDescription(): string
    {
        return 'Obtain member value using its label.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::fromCondition('valid-a' === $vendor->keyToValue('VALID_A'));
    }
}
