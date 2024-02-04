<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Elao\Enum\AutoDiscoveredValuesTrait;
use Elao\Enum\Enum;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class ElaoFirstEnum extends Enum
{
    public const VALID_A = 'valid-a';
    public const VALID_B = 'valid-b';

    public const PUBLIC_A = 'public-a';
    public const PUBLIC_B = 'public-b';
    protected const PROTECTED_A = 'protected-a';
    protected const PROTECTED_B = 'protected-b';
    private const PRIVATE_A = 'private-a';
    private const PRIVATE_B = 'private-b';

    use AutoDiscoveredValuesTrait;
}

final class ElaoOtherEnum extends Enum
{
    public const OTHER = 'other';

    use AutoDiscoveredValuesTrait;
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ElaoEnumVendor implements VendorInterface
{
    public function enumValidA(): object { return ElaoFirstEnum::VALID_A(); }
    public function enumValidB(): object { return ElaoFirstEnum::VALID_B(); }
    public function enumOther(): object { return ElaoOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'elao/enum'; }
    public function githubRepository(): string { return 'Elao/PhpEnums'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { UnsupportedException::throwException(); }
    public function fromValue(string $class, $value): object { return $class::get($value); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new ElaoFirstEnum('VALID_A', 'valid-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { UnsupportedException::throwException(); }
    public function getValue($enum) { return $enum->getValue(); }

    public function equals($lhs, $rhs): bool { return $lhs->equals($rhs); }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { return ElaoFirstEnum::accepts($value); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { return $enum->is($value); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { UnsupportedException::throwException(); }
    public function listValues(): array { return ElaoFirstEnum::values(); }
    public function listKeysValues(): array { return ElaoFirstEnum::instances(); }

    public function getInstances(): array { NotImplementedException::throwException(); }
    public function valuesExist(array $list): bool { NotImplementedException::throwException(); }
    public function membersExist(array $list): bool { NotImplementedException::throwException(); }
    public function instanceIn($enum, array $list): bool { NotImplementedException::throwException(); }
    public function memberIn($enum, array $list): bool { NotImplementedException::throwException(); }
    public function valueIn($enum, array $list): bool { NotImplementedException::throwException(); }
}
