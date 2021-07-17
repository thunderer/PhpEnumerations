<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Esky\Enum\Enum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class EskyFirstEnum extends Enum
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

final class EskyOtherEnum extends Enum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class EskyEnumVendor implements VendorInterface
{
    public function enumValidA(): object { return EskyFirstEnum::VALID_A(); }
    public function enumValidB(): object { return EskyFirstEnum::VALID_B(); }
    public function enumOther(): object { return EskyOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'commerceguys/enum'; }
    public function githubRepository(): string { return 'BenSampo/laravel-enum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { return $class::createFromConstantName($key); }
    public function fromValue(string $class, $value): object { UnsupportedException::throwException(); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new EskyFirstEnum('valid-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { return $enum->getName(); }
    public function getValue($enum) { return $enum->getValue(); }

    public function equals($lhs, $rhs): bool { return $lhs->isEqual($rhs); }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { return EskyFirstEnum::isValidValue($value); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return EskyFirstEnum::getNames(); }
    public function listValues(): array { return EskyFirstEnum::getValues(); }
    public function listKeysValues(): array { return EskyFirstEnum::getNames(); }
}
