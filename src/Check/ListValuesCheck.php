<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ListValuesCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'list-values';
    }

    public function getDescription(): string
    {
        return 'List enum member values.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $keys = ['VALID_A', 'VALID_B', 'PUBLIC_A', 'PUBLIC_B', 'PROTECTED_A', 'PROTECTED_B', 'PRIVATE_A', 'PRIVATE_B'];
        $values = ['valid-a', 'valid-b', 'public-a', 'public-b', 'protected-a', 'protected-b', 'private-a', 'private-b'];

        $actual = $vendor->listValues();

        $canString = true;
        set_error_handler(function() use(&$canString) { $canString = false; });
        $strval = array_map('strval', $actual);
        restore_error_handler();
        if(false === $canString) {
            return ResultValue::failAnd('cast');
        }

        $arrayValuesStrval = array_values($strval);

        switch(true) {
            case $values === $actual: { return ResultValue::pass(); }
            case empty($actual): { return ResultValue::failAnd('empty'); }
            case $keys === $actual: { return ResultValue::failAnd('keys'); }
            case ['valid-a', 'valid-b', 'public-a', 'public-b'] === $actual: { return ResultValue::passBut('public'); }
            case ['VALID_A', 'VALID_B', 'PUBLIC_A', 'PUBLIC_B'] === $arrayValuesStrval: { return ResultValue::failAnd('[K/O], public'); }
            case ['VALID_A', 'VALID_B', 'PROTECTED_A', 'PROTECTED_B'] === $arrayValuesStrval: { return ResultValue::failAnd('[K/O], protected'); }
            case $values === $arrayValuesStrval: { return ResultValue::passBut('values(strval)'); }
            case array_combine($values, $keys) === $actual: { return ResultValue::failAnd('[V/K]'); }
            default: { return ResultValue::failAnd('INVALID'); }
        }
    }
}
