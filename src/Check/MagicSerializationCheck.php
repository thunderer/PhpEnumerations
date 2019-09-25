<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class MagicSerializationCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'magic-serialize';
    }

    public function getDescription(): string
    {
        return 'Serialization should be either blocked or work properly.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();

        try {
            $second = serialize($first);
        } catch(\Exception $e) {
            return ResultValue::passBut('no sleep');
        }

        try {
            $second = unserialize($second);
        } catch(\Exception $e) {
            return ResultValue::passBut('no wakeup');
        }

        return ResultValue::fromCondition($vendor->equals($first, $second));
    }
}
