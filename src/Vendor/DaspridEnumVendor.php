<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use DASPRiD\Enum\AbstractEnum;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class DaspridFirstEnum extends AbstractEnum
{
    protected const VALID_A = 'valid-a';
    protected const VALID_B = 'valid-b';

    public const PUBLIC_A = 'public-a';
    public const PUBLIC_B = 'public-b';
    protected const PROTECTED_A = 'protected-a';
    protected const PROTECTED_B = 'protected-b';
    private const PRIVATE_A = 'private-a';
    private const PRIVATE_B = 'private-b';
}

final class DaspridOtherEnum extends AbstractEnum
{
    protected const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class DaspridEnumVendor implements VendorInterface
{
    public function enumValidA(): object { return DaspridFirstEnum::VALID_A(); }
    public function enumValidB(): object { return DaspridFirstEnum::VALID_B(); }
    public function enumOther(): object { return DaspridOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'dasprid/enum'; }
    public function githubRepository(): string { return 'DASPRiD/Enum'; }

    public function fromKey(string $class, string $key): object { return $class::valueOf($key); }
    public function fromValue(string $class, $value): object { UnsupportedException::throwException(); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new DaspridFirstEnum('valid-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { UnsupportedException::throwException(); }
    public function getValue($enum) { UnsupportedException::throwException(); }

    public function equals($lhs, $rhs): bool { UnsupportedException::throwException(); }

    public function keyExists($key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { UnsupportedException::throwException(); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return DaspridFirstEnum::values(); }
    public function listValues(): array { return DaspridFirstEnum::values(); }
    public function listKeysValues(): array { return DaspridFirstEnum::values(); }
}
