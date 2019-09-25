<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class CreateUsingEnumCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'create-enum';
    }

    public function getDescription(): string
    {
        return 'Create enum instance from another enum instance.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();

        return ResultValue::fromCondition($vendor->equals($first, $vendor->fromEnum($first)));
    }
}
