<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class CreateUsingKeyCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'create-key';
    }

    public function getDescription(): string
    {
        return 'Create enum member instance from its label.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $other = $vendor->enumOther();

        $vendor->fromKey(\get_class($first), 'VALID_A');
        $vendor->fromKey(\get_class($first), 'VALID_B');
        $vendor->fromKey(\get_class($other), 'OTHER');

        try {
            $vendor->fromKey(\get_class($first), 'PROTECTED_A');
        } catch(\Throwable $e) {
            return ResultValue::passBut('public');
        }

        try {
            $vendor->fromKey(\get_class($first), 'PRIVATE_A');
        } catch(\Throwable $e) {
            if(0 === strpos($e->getMessage(), 'Cannot access private const')) {
                return ResultValue::passBut('no private');
            }
        }

        return ResultValue::pass();
    }
}
