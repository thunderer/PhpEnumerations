<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Eloquent\Enumeration\AbstractEnumeration;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class EloquentEnumerationFirstEnum extends AbstractEnumeration
{
    public const VALID_A = 'valid-a';
    public const VALID_B = 'valid-b';

    public const PUBLIC_A = 'public-a';
    public const PUBLIC_B = 'public-b';
    protected const PROTECTED_A = 'protected-a';
    protected const PROTECTED_B = 'protected-b';
    private const PRIVATE_A = 'private-a';
    private const PRIVATE_B = 'private-b';
}

final class EloquentEnumerationOtherEnum extends AbstractEnumeration
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class EloquentEnumerationEnumerationVendor implements VendorInterface
{
    public function enumValidA(): object { return EloquentEnumerationFirstEnum::VALID_A(); }
    public function enumValidB(): object { return EloquentEnumerationFirstEnum::VALID_B(); }
    public function enumOther(): object { return EloquentEnumerationOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'eloquent/enumeration'; }
    public function githubRepository(): string { return 'eloquent/enumeration'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { return $class::memberByKey($key); }
    public function fromValue(string $class, $value): object { return $class::memberByValue($value); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new EloquentEnumerationFirstEnum('VALID_A', 'valid-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { return $enum->key(); }
    public function getValue($enum) { return $enum->value(); }

    public function equals($lhs, $rhs): bool { UnsupportedException::throwException(); }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { UnsupportedException::throwException(); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return EloquentEnumerationFirstEnum::members(); }
    public function listValues(): array { return EloquentEnumerationFirstEnum::members(); }
    public function listKeysValues(): array { return EloquentEnumerationFirstEnum::members(); }

    public function getInstances(): array { UnsupportedException::throwException(); }
    public function valuesExist(array $list): bool { UnsupportedException::throwException(); }
    public function membersExist(array $list): bool { UnsupportedException::throwException(); }
    /** @param AbstractEnumeration $enum */
    public function instanceIn($enum, array $list): bool { return $enum->anyOfArray($list); }
    /** @param AbstractEnumeration $enum */
    public function memberIn($enum, array $list): bool { UnsupportedException::throwException(); }
    /** @param AbstractEnumeration $enum */
    public function valueIn($enum, array $list): bool { UnsupportedException::throwException(); }
}
