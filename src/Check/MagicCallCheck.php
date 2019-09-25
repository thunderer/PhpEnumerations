<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\Utility\Utility;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class MagicCallCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'magic-call';
    }

    public function getDescription(): string
    {
        return 'Cloning enum instances should not be allowed.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::fromCondition(Utility::causesAnyProblem(function() use($vendor) {
            $vendor->enumValidA()->certainlyInvalidMethod();
        }));
    }
}
