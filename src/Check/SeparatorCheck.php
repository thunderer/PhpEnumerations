<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class SeparatorCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return '-';
    }

    public function getDescription(): string
    {
        return '-';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::separator();
    }
}
