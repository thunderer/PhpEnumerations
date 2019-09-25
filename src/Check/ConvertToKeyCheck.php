<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ConvertToKeyCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'to-key';
    }

    public function getDescription(): string
    {
        return 'Get member label from enum instance.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();

        $var = $vendor->getKey($first);
        switch(true) {
            case 'valid-a' === $var: { return ResultValue::failAnd('value'); }
            default: { return ResultValue::fromSame('VALID_A', $var); }
        }
    }
}
