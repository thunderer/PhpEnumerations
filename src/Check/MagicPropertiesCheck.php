<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\Utility\Utility;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class MagicPropertiesCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'magic-props';
    }

    public function getDescription(): string
    {
        return 'Dynamic properties with magic __set(), __get(), __isset(), and __unset() should not be allowed.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $enum = $vendor->enumValidA();

        $set = Utility::causesException(function() use($enum) { $enum->certainlyInvalidProperty = 'certainlyInvalidValue'; });
        $get = Utility::causesException(function() use($enum) { $enum->certainlyInvalidProperty; });
        $isset = Utility::causesException(function() use($enum) { return isset($enum->certainlyInvalidProperty); });
        $unset = Utility::causesException(function() use($enum) { unset($enum->certainlyInvalidProperty); });

        return ResultValue::fromCondition($set && $get && $isset && $unset);
    }
}
