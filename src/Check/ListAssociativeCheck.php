<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\Utility\Utility;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ListAssociativeCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'list-assoc';
    }

    public function getDescription(): string
    {
        return 'List enum members and values.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $keys = ['VALID_A', 'VALID_B', 'PUBLIC_A', 'PUBLIC_B', 'PROTECTED_A', 'PROTECTED_B', 'PRIVATE_A', 'PRIVATE_B'];
        $values = ['valid-a', 'valid-b', 'public-a', 'public-b', 'protected-a', 'protected-b', 'private-a', 'private-b'];

        $actual = $vendor->listKeysValues();

        if(false === Utility::attemptStringCastList($actual)) {
            return ResultValue::failAnd('cast');
        }
        set_error_handler(function() use(&$canString) { $canString = false; });
        $strval = array_map('strval', $actual);
        restore_error_handler();

        switch(true) {
            case empty($actual): { return ResultValue::failAnd('empty'); }
            case ['VALID_A' => 'valid-a', 'VALID_B' => 'valid-b', 'PUBLIC_A' => 'public-a', 'PUBLIC_B' => 'public-b'] === $strval: { return ResultValue::passBut('public'); }
            case ['VALID_A' => 'VALID_A', 'VALID_B' => 'VALID_B', 'PUBLIC_A' => 'PUBLIC_A', 'PUBLIC_B' => 'PUBLIC_B'] === $strval: { return ResultValue::failAnd('[K/O], public'); }
            case ['VALID_A' => 'VALID_A', 'VALID_B' => 'VALID_B', 'PROTECTED_A' => 'PROTECTED_A', 'PROTECTED_B' => 'PROTECTED_B'] === $strval: { return ResultValue::failAnd('[K/O], protected'); }
            case array_combine($keys, $keys) === $strval: { return ResultValue::failAnd('[K/O]'); }
            case array_combine(array_map('strtolower', $keys), $keys) === $actual: { return ResultValue::failAnd('[lowerK/K]'); }
            case array_combine($values, $keys) === $actual: { return ResultValue::passBut('[V/K]'); }
            default: { return ResultValue::fromSame(array_combine($keys, $values), $actual); }
        }
    }
}
