<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class EqualsLooseCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'equals-loose';
    }

    public function getDescription(): string
    {
        return 'Compare enum instances using loose (==) comparison operator.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $equalA = $vendor->enumValidA() == $vendor->enumValidA();
        $differentAB = $vendor->enumValidA() != $vendor->enumValidB();
        $differentBOther = $vendor->enumValidB() != $vendor->enumOther();

        return ResultValue::fromCondition($equalA && $differentAB && $differentBOther);
    }
}
