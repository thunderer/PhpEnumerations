<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\Utility\Utility;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ConvertToStringCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'to-string';
    }

    public function getDescription(): string
    {
        return 'Cast enum instance to string to obtain its value.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();

        $castToString = function() use($first) {
            return (string)$first;
        };
        if(Utility::causesError($castToString)) {
            return ResultValue::failAnd('magic');
        }

        $value = (string)$first;
        if('VALID_A' === $value) {
            return ResultValue::passBut('key');
        }

        return ResultValue::fromSame('valid-a', $value);
    }
}
