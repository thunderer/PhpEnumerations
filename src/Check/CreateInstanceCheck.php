<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class CreateInstanceCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'create-valid';
    }

    public function getDescription(): string
    {
        return 'Create all valid enum instances.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        try {
            $vendor->enumValidA();
            $vendor->enumValidB();
            $vendor->enumOther();
        } catch(\Throwable $e) {
            return ResultValue::fail();
        }

        return ResultValue::pass();
    }
}
