<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class VerifyBaseCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'verify-base';
    }

    public function getDescription(): string
    {
        return 'There should be no generic typehint for all derived enums.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $first = $vendor->enumValidA();
        $second = $vendor->enumValidB();

        $classes = array_intersect(class_parents($first), class_parents($second));
        $interfaces = array_diff(array_intersect(class_implements($first), class_implements($second)), ['JsonSerializable']);

        if(empty($classes) && empty($interfaces)) {
            return ResultValue::pass();
        }

        $items = array_values(array_merge($classes, $interfaces));
        /* $prefix = substr($items[0], 0, strpos($items[0], '\\', strpos($items[0], '\\') + 1) + 1);
        $items = array_map(function(string $fqcn) use($prefix) {
            return str_replace($prefix, '', $fqcn);
        }, $items); */

        return ResultValue::failAnd((string)\count($items));
    }
}
