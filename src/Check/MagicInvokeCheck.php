<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class MagicInvokeCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'magic-invoke';
    }

    public function getDescription(): string
    {
        return 'Enum instances should not be callable.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        try {
            $vendor->enumValidA()();
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
