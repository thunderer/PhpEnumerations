<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Konekt\Enum\Enum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class KonektFirstEnum extends Enum
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

final class KonektOtherEnum extends Enum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class KonektEnumVendor implements VendorInterface
{
    public function enumValidA(): object { return KonektFirstEnum::VALID_A(); }
    public function enumValidB(): object { return KonektFirstEnum::VALID_B(); }
    public function enumOther(): object { return KonektOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'konekt/enum'; }
    public function githubRepository(): string { return 'artkonekt/enum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromValue(string $class, $value): object { return $class::create($value); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new KonektFirstEnum('valid-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { return $enum->label(); }
    public function getValue($enum) { return $enum->value(); }

    public function equals($lhs, $rhs): bool { return $lhs->equals($rhs); }

    public function keyExists(string $key): bool { return KonektFirstEnum::hasConst($key); }
    public function valueExists($value): bool { return KonektFirstEnum::has($value); }

    public function hasKey($enum, string $key): bool { return $enum->hasConst($key); }
    public function hasValue($enum, $value): bool { return $enum->has($value); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return KonektFirstEnum::consts(); }
    public function listValues(): array { return KonektFirstEnum::values(); }
    public function listKeysValues(): array { return KonektFirstEnum::toArray(); }
}
