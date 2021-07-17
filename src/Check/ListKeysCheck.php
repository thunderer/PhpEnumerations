<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\Utility\Utility;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ListKeysCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'list-keys';
    }

    public function getDescription(): string
    {
        return 'List enum member labels.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $keys = ['VALID_A', 'VALID_B', 'PUBLIC_A', 'PUBLIC_B', 'PROTECTED_A', 'PROTECTED_B', 'PRIVATE_A', 'PRIVATE_B'];
        $values = ['valid-a', 'valid-b', 'public-a', 'public-b', 'protected-a', 'protected-b', 'private-a', 'private-b'];

        $actual = $vendor->listKeys();

        if(false === Utility::attemptStringCastList($actual)) {
            return ResultValue::failAnd('cast');
        }
        set_error_handler(function() use(&$canString) { $canString = false; });
        $strval = array_map('strval', $actual);
        restore_error_handler();

        $arrayValuesStrval = array_values($strval);

        switch(true) {
            case empty($actual): { return ResultValue::failAnd('empty'); }
            case ['VALID_A', 'VALID_B', 'PUBLIC_A', 'PUBLIC_B'] === $arrayValuesStrval: { return ResultValue::passBut('[K/O], public'); }
            case ['VALID_A', 'VALID_B', 'PROTECTED_A', 'PROTECTED_B'] === $arrayValuesStrval: { return ResultValue::passBut('[K/O], protected'); }
            case array_map('strtolower', $keys) === $actual: { return ResultValue::failAnd('lowerK'); }
            case array_combine($keys, $keys) === $strval: { return ResultValue::passBut('[K/O]'); }
            case array_combine($values, $keys) === $actual: { return ResultValue::passBut('[V/K]'); }
            default: { return ResultValue::fromSame($keys, $actual); }
        }
    }
}
