<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class CreateUsingValueCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'create-value';
    }

    public function getDescription(): string
    {
        return 'Create enum member instance from its value.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $other = $vendor->enumOther();

        $vendor->fromValue(\get_class($first), 'valid-a');
        $vendor->fromValue(\get_class($first), 'valid-b');
        $vendor->fromValue(\get_class($other), 'other');

        try {
            $vendor->fromValue(\get_class($first), 'private-a');
        } catch(\Error $e) {
            return ResultValue::passBut('no private');
        } catch(\Throwable $e) {
            return ResultValue::passBut('public');
        }

        try {
            $vendor->fromValue(\get_class($first), 'protected-a');
        } catch(\InvalidArgumentException $e) {
            // marc-mabe case, filters only public constants
            return ResultValue::passBut('public');
        }

        return ResultValue::pass();
    }
}
