<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use BenSampo\Enum\Enum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class BensampoFirstEnum extends Enum
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

final class BensampoOtherEnum extends Enum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class BensampoLaravelenumVendor implements VendorInterface
{
    public function enumValidA(): object { return BensampoFirstEnum::VALID_A(); }
    public function enumValidB(): object { return BensampoFirstEnum::VALID_B(); }
    public function enumOther(): object { return BensampoOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'bensampo/laravel-enum'; }
    public function githubRepository(): string { return 'BenSampo/laravel-enum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { UnsupportedException::throwException(); }

    /** @param class-string<Enum> $class */
    public function fromValue(string $class, $value): object { return $class::fromValue($value); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new BensampoFirstEnum('public-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    /** @param Enum $enum */
    public function getKey($enum): string { return $enum->key; }
    /** @param Enum $enum */
    public function getValue($enum) { return $enum->value; }

    public function equals($lhs, $rhs): bool { return $rhs->is($lhs); }

    public function keyExists($key): bool { return BensampoFirstEnum::hasKey($key); }
    public function valueExists($value): bool { return BensampoFirstEnum::hasValue($value); }

    public function hasKey($enum, string $key): bool { return $enum->hasKey($key); }
    /** @var Enum $enum */
    public function hasValue($enum, $value): bool { return $enum->hasValue($value); }

    public function keyToValue(string $key) { return BensampoFirstEnum::getValue($key); }
    public function valueToKey($value): string { return BensampoFirstEnum::getKey($value); }
    public function listKeys(): array { return BensampoFirstEnum::getKeys(); }
    public function listValues(): array { return BensampoFirstEnum::getValues(); }
    public function listKeysValues(): array { return BensampoFirstEnum::asArray(); }

    public function getInstances(): array { return BensampoFirstEnum::getInstances(); }
    public function valuesExist(array $list): bool { UnsupportedException::throwException(); }
    public function membersExist(array $list): bool { UnsupportedException::throwException(); }
    /** @var Enum $enum */
    public function instanceIn($enum, array $list): bool { return $enum->is($list); }
    /** @var Enum $enum */
    public function memberIn($enum, array $list): bool { UnsupportedException::throwException(); }
    /** @var Enum $enum */
    public function valueIn($enum, array $list): bool { return $enum->is($list); }
}
