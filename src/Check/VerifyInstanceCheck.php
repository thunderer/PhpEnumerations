<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class VerifyInstanceCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'verify-instance';
    }

    public function getDescription(): string
    {
        return 'Enum member should have only one instance.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::fromCondition(
            $vendor->enumValidA() === $vendor->enumValidA()
            && $vendor->enumValidB() === $vendor->enumValidB()
            && $vendor->enumValidA() !== $vendor->enumValidB()
            && $vendor->enumOther() === $vendor->enumOther()
            && $vendor->enumValidA() !== $vendor->enumOther()
            && $vendor->enumValidB() !== $vendor->enumOther()
        );
    }
}
