<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use HappyTypes\EnumerableType;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class HappytypesFirstEnum extends EnumerableType
{
    public const VALID_A = 'valid-a';
    public const VALID_B = 'valid-b';

    public const PUBLIC_A = 'public-a';
    public const PUBLIC_B = 'public-b';
    protected const PROTECTED_A = 'protected-a';
    protected const PROTECTED_B = 'protected-b';
    private const PRIVATE_A = 'private-a';
    private const PRIVATE_B = 'private-b';

    final public static function VALID_A() { return static::get('VALID_A', 'valid-a'); }
    final public static function VALID_B() { return static::get('VALID_B', 'valid-b'); }
}

final class HappytypesOtherEnum extends EnumerableType
{
    public const OTHER = 'other';

    final public static function OTHER() { return static::get('OTHER', 'other'); }
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class HappytypesEnumerabletypeVendor implements VendorInterface
{
    public function enumValidA(): object { return HappytypesFirstEnum::VALID_A(); }
    public function enumValidB(): object { return HappytypesFirstEnum::VALID_B(); }
    public function enumOther(): object { return HappytypesOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'happy-types/enumerable-type'; }
    public function githubRepository(): string { return 'antanas-arvasevicius/enumerable-type'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { return $class::fromId($key); }
    public function fromValue(string $class, $value): object { UnsupportedException::throwException(); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new HappytypesFirstEnum('VALID_', 'valid-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { return $enum->id(); }
    public function getValue($enum) { return $enum->name(); }

    public function equals($lhs, $rhs): bool { UnsupportedException::throwException(); }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { UnsupportedException::throwException(); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return HappytypesFirstEnum::enum(); }
    public function listValues(): array { return HappytypesFirstEnum::enum(); }
    public function listKeysValues(): array { return HappytypesFirstEnum::enum(); }
}
