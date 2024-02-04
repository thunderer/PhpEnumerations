<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use MabeEnum\Enum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class MarcmabeFirstEnum extends Enum
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

final class MarcmabeOtherEnum extends Enum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class MarcmabePhpenumVendor implements VendorInterface
{
    public function enumValidA(): object { return MarcmabeFirstEnum::VALID_A(); }
    public function enumValidB(): object { return MarcmabeFirstEnum::VALID_B(); }
    public function enumOther(): object { return MarcmabeOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'marc-mabe/php-enum'; }
    public function githubRepository(): string { return 'marc-mabe/php-enum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { return $class::byName($key); }
    public function fromValue(string $class, $value): object { return $class::byValue($value); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new MarcmabeFirstEnum('first'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { return $enum->getName(); }
    public function getValue($enum) { return $enum->getValue(); }

    public function equals($lhs, $rhs): bool { return $lhs->is($rhs); }

    public function keyExists(string $key): bool { return MarcmabeFirstEnum::hasName($key); }
    public function valueExists($value): bool { return MarcmabeFirstEnum::hasValue($value); }

    public function hasKey($enum, string $key): bool { return $enum->hasName($key); }
    public function hasValue($enum, $value): bool { return $enum->hasValue($value); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return MarcmabeFirstEnum::getNames(); }
    public function listValues(): array { return MarcmabeFirstEnum::getValues(); }
    public function listKeysValues(): array { return MarcmabeFirstEnum::getConstants(); }

    public function getInstances(): array { return MarcmabeFirstEnum::getEnumerators(); }
    public function valuesExist(array $list): bool { UnsupportedException::throwException(); }
    public function membersExist(array $list): bool { UnsupportedException::throwException(); }
    /** @var Enum $enum */
    public function instanceIn($enum, array $list): bool { UnsupportedException::throwException(); }
    /** @var Enum $enum */
    public function memberIn($enum, array $list): bool { UnsupportedException::throwException(); }
    /** @var Enum $enum */
    public function valueIn($enum, array $list): bool { UnsupportedException::throwException(); }
}
