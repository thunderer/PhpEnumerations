<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class EqualsMethodCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'equals-method';
    }

    public function getDescription(): string
    {
        return 'Compare enum instances using dedicated equals() method or equivalent.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $equalA = $vendor->equals($vendor->enumValidA(), $vendor->enumValidA());
        $differentAB = false === $vendor->equals($vendor->enumValidA(), $vendor->enumValidB());
        $differentBOther = false === $vendor->equals($vendor->enumValidB(), $vendor->enumOther());

        return ResultValue::fromCondition($equalA && $differentAB && $differentBOther);
    }
}
