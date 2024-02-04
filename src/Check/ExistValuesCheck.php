<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ExistValuesCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'exist-values';
    }

    public function getDescription(): string
    {
        return 'Verify that all given enum values exist.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $yes = $vendor->valuesExist(['valid-a', 'valid-b']);
        $no = $vendor->valuesExist(['invalid']);

        return ResultValue::fromCondition($yes && false === $no);
    }
}
