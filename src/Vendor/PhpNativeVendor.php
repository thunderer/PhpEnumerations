<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

/**
 * @method static self VALID_A()
 * @method static self VALID_B()
 * @method static self PUBLIC_A()
 * @method static self PUBLIC_B()
 * @method static self PROTECTED_A()
 * @method static self PROTECTED_B()
 * @method static self PRIVATE_A()
 * @method static self PRIVATE_B()
 */
enum PhpNativeFirstEnum: string
{
    case VALID_A = 'valid-a';
    case VALID_B = 'valid-b';
    case PUBLIC_A = 'public-a';
    case PUBLIC_B = 'public-b';
    case PROTECTED_A = 'protected-a';
    case PROTECTED_B = 'protected-b';
    case PRIVATE_A = 'private-a';
    case PRIVATE_B = 'private-b';
}

/**
 * @method static self OTHER()
 */
enum PhpNativeOtherEnum: string
{
    case OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class PhpNativeVendor implements VendorInterface
{
    public function enumValidA(): object { return PhpNativeFirstEnum::VALID_A; }
    public function enumValidB(): object { return PhpNativeFirstEnum::VALID_B; }
    public function enumOther(): object { return PhpNativeOtherEnum::OTHER; }

    public function packagistVendor(): string { return '-'; }
    public function githubRepository(): string { return '-'; }
    public function sources(): array { return [self::SOURCE_NATIVE]; }

    public function fromKey(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromValue(string $class, $value): object { return $class::from($value); }
    public function fromConstant(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromConstructor(): void { UnsupportedException::throwException(); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { return $enum->name; }
    public function getValue($enum) { return $enum->value; }

    public function equals($lhs, $rhs): bool { return $lhs === $rhs; }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { UnsupportedException::throwException(); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return PhpNativeFirstEnum::cases(); }
    public function listValues(): array { return PhpNativeFirstEnum::cases(); }
    public function listKeysValues(): array { return PhpNativeFirstEnum::cases(); }

    public function getInstances(): array { return PhpNativeFirstEnum::cases(); }
    public function valuesExist(array $list): bool { UnsupportedException::throwException(); }
    public function membersExist(array $list): bool { UnsupportedException::throwException(); }
    public function instanceIn($enum, array $list): bool { UnsupportedException::throwException(); }
    public function memberIn($enum, array $list): bool { UnsupportedException::throwException(); }
    public function valueIn($enum, array $list): bool { UnsupportedException::throwException(); }
}
