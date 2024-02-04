<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Spatie\Enum\Enum;
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
final class SpatieFirstEnum extends Enum
{
}

/**
 * @method static self OTHER()
 */
final class SpatieOtherEnum extends Enum
{
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class SpatieEnumVendor implements VendorInterface
{
    public function enumValidA(): object { return SpatieFirstEnum::VALID_A(); }
    public function enumValidB(): object { return SpatieFirstEnum::VALID_B(); }
    public function enumOther(): object { return SpatieOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'spatie/enum'; }
    public function githubRepository(): string { return 'spatie/enum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { return $class::from($key); }
    public function fromValue(string $class, $value): object { UnsupportedException::throwException(); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new SpatieFirstEnum('PUBLIC_A'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { UnsupportedException::throwException(); }
    public function getValue($enum): void { UnsupportedException::throwException(); }

    public function equals($lhs, $rhs): bool { return $lhs->equals($rhs); }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { UnsupportedException::throwException(); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return SpatieFirstEnum::toLabels(); }
    public function listValues(): array { return SpatieFirstEnum::toValues(); }
    public function listKeysValues(): array { return SpatieFirstEnum::toArray(); }

    public function getInstances(): array { UnsupportedException::throwException(); }
    public function valuesExist(array $list): bool { UnsupportedException::throwException(); }
    public function membersExist(array $list): bool { UnsupportedException::throwException(); }
    public function instanceIn($enum, array $list): bool { UnsupportedException::throwException(); }
    public function memberIn($enum, array $list): bool { UnsupportedException::throwException(); }
    public function valueIn($enum, array $list): bool { UnsupportedException::throwException(); }
}
