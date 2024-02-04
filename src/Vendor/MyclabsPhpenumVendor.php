<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use MyCLabs\Enum\Enum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class MyclabsFirstEnum extends Enum
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

final class MyclabsOtherEnum extends Enum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class MyclabsPhpenumVendor implements VendorInterface
{
    public function enumValidA(): object { return MyclabsFirstEnum::VALID_A(); }
    public function enumValidB(): object { return MyclabsFirstEnum::VALID_B(); }
    public function enumOther(): object { return MyclabsOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'myclabs/php-enum'; }
    public function githubRepository(): string { return 'myclabs/php-enum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromValue(string $class, $value): object { return new MyclabsFirstEnum('valid-a'); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new MyclabsFirstEnum('valid-a'); }
    public function fromEnum($enum): object { return new MyclabsFirstEnum($enum); }

    public function getKey($enum): string { return $enum->getKey(); }
    public function getValue($enum) { return $enum->getValue(); }

    public function equals($lhs, $rhs): bool { return $lhs->equals($rhs); }
    public function keyExists(string $key): bool { return MyclabsFirstEnum::isValidKey($key); }
    public function valueExists($value): bool { return MyclabsFirstEnum::isValid($value); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { return MyclabsFirstEnum::search($value); }
    public function listKeys(): array { return MyclabsFirstEnum::keys(); }
    public function listValues(): array { return MyclabsFirstEnum::values(); }
    public function listKeysValues(): array { return MyclabsFirstEnum::toArray(); }

    public function getInstances(): array { UnsupportedException::throwException(); }
    public function valuesExist(array $list): bool { UnsupportedException::throwException(); }
    public function membersExist(array $list): bool { UnsupportedException::throwException(); }
    public function instanceIn($enum, array $list): bool { UnsupportedException::throwException(); }
    public function memberIn($enum, array $list): bool { UnsupportedException::throwException(); }
    public function valueIn($enum, array $list): bool { UnsupportedException::throwException(); }
}
