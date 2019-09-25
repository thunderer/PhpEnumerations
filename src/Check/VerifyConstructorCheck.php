<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class VerifyConstructorCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'verify-ctor';
    }

    public function getDescription(): string
    {
        return 'Calling instance constructor should not allow to change its state.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        try {
            $vendor->fromConstructor();
        } catch(\Error $e) {
            if(0 === strpos($e->getMessage(), 'Call to private')) {
                return ResultValue::pass();
            }
        }

        $enum = $vendor->enumValidA();
        try {
            $enum->__construct('valid-b');
            if('valid-b' === $vendor->getValue($enum)) {
                return ResultValue::failAnd('value');
            }
        } catch(\Error $e) {}

        try {
            $enum->__construct('VALID_B');
            if('VALID_B' === $vendor->getKey($enum)) {
                return ResultValue::failAnd('key');
            }
        } catch(\Error $e) {}

        return ResultValue::pass();
    }
}
