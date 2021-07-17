<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use CommerceGuys\Enum\AbstractEnum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class CommerceguysFirstEnum extends AbstractEnum
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

final class CommerceguysOtherEnum extends AbstractEnum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class CommerceguysEnumVendor implements VendorInterface
{
    public function enumValidA(): object { UnsupportedException::throwException(); }
    public function enumValidB(): object { UnsupportedException::throwException(); }
    public function enumOther(): object { UnsupportedException::throwException(); }

    public function packagistVendor(): string { return 'commerceguys/enum'; }
    public function githubRepository(): string { return 'commerceguys/enum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromValue(string $class, $value): object { UnsupportedException::throwException(); }
    public function fromConstant(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromConstructor(): void { new CommerceguysFirstEnum(); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { UnsupportedException::throwException(); }
    public function getValue($enum) { UnsupportedException::throwException(); }

    public function equals($lhs, $rhs): bool { UnsupportedException::throwException(); }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { return CommerceguysFirstEnum::exists($value); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { return CommerceguysFirstEnum::getKey($value); }
    public function listKeys(): array { UnsupportedException::throwException(); }
    public function listValues(): array { UnsupportedException::throwException(); }
    public function listKeysValues(): array { return CommerceguysFirstEnum::getAll(); }
}
