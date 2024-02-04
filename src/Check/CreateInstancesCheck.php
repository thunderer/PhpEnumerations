<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class CreateInstancesCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'create-all';
    }

    public function getDescription(): string
    {
        return 'Get a list of all valid enum member instances.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $list = $vendor->getInstances();
        $note = implode("\n", array_map(fn($x) => $vendor->getKey($x), $list));
        if(8 === count($list)) {
            return ResultValue::pass($note);
        }

        return ResultValue::passBut((string)count($list), $note);
    }
}
