<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class MagicCloneCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'magic-clone';
    }

    public function getDescription(): string
    {
        return 'Cloning enum instances should not be allowed.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        try {
            clone $vendor->enumValidA();
        } catch(\Error $e) {
            if(0 === strpos($e->getMessage(), 'Call to private')) {
                return ResultValue::passBut('private');
            }
        } catch(\Exception $e) {
            return ResultValue::pass();
        }

        return ResultValue::fail();
    }
}
