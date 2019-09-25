<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Greg0ire\Enum\AbstractEnum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class Greg0ireFirstEnum extends AbstractEnum
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

final class Greg0ireOtherEnum extends AbstractEnum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class Greg0ireEnumVendor implements VendorInterface
{
    public function enumValidA(): object { UnsupportedException::throwException(); }
    public function enumValidB(): object { UnsupportedException::throwException(); }
    public function enumOther(): object { UnsupportedException::throwException(); }

    public function packagistVendor(): string { return 'greg0ire/enum'; }
    public function githubRepository(): string { return 'greg0ire/enum'; }

    public function fromKey(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromValue(string $class, $value): object { UnsupportedException::throwException(); }
    public function fromConstant(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromConstructor(): void { new Greg0ireFirstEnum('PUBLIC_A', 'public-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { UnsupportedException::throwException(); }
    public function getValue($enum) { UnsupportedException::throwException(); }

    public function equals($lhs, $rhs): bool { UnsupportedException::throwException(); }

    public function keyExists(string $key): bool { return Greg0ireFirstEnum::isValidName($key); }
    public function valueExists($value): bool { return Greg0ireFirstEnum::isValidValue($value); }

    public function hasKey($enum, string $key): bool { return $enum->hasKey($key); }
    public function hasValue($enum, $value): bool { return $enum->hasValue($value); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return Greg0ireFirstEnum::getKeys(); }
    public function listValues(): array { return Greg0ireFirstEnum::getConstants(); }
    public function listKeysValues(): array { UnsupportedException::throwException(); }
}
