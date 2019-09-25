<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ListValueToKeyCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'value-to-key';
    }

    public function getDescription(): string
    {
        return 'Obtain member label using its value.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::fromCondition('VALID_A' === $vendor->valueToKey('valid-a'));
    }
}
