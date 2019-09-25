<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ConvertToJsonCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'to-json';
    }

    public function getDescription(): string
    {
        return 'Convert to JSON using json_encode() and \JsonSerializable interface.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();

        $var = json_encode($first);
        switch(true) {
            case false === $first instanceof \JsonSerializable: {
                return method_exists($first, 'jsonSerialize')
                    ? ResultValue::failAnd('method')
                    : ResultValue::failAnd('iface');
            }
            case '"VALID_A"' === $var: { return ResultValue::passBut('key'); }
            default: { return ResultValue::fromSame('"valid-a"', $var); }
        }
    }
}
