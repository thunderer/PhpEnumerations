<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\Platenum\Enum\AbstractConstantsEnum;

final class ThundererFirstExtendsEnum extends AbstractConstantsEnum
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

final class ThundererOtherExtendsEnum extends AbstractConstantsEnum
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ThundererPlatenumExtendsVendor implements VendorInterface
{
    public function enumValidA(): object { return ThundererFirstExtendsEnum::VALID_A(); }
    public function enumValidB(): object { return ThundererFirstExtendsEnum::VALID_B(); }
    public function enumOther(): object { return ThundererOtherExtendsEnum::OTHER(); }

    public function packagistVendor(): string { return 'thunderer/platenum'; }
    public function githubRepository(): string { return 'thunderer/Platenum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS, self::SOURCE_DOCBLOCKS, self::SOURCE_STATIC, self::SOURCE_CALLBACK, self::SOURCE_ATTRIBUTES]; }

    public function fromKey(string $class, string $key): object { return $class::fromMember($key); }
    public function fromValue(string $class, $value): object { return $class::fromValue($value); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new ThundererFirstExtendsEnum('VALID_A', 'valid-a'); }
    public function fromEnum($enum): object { return ThundererFirstExtendsEnum::fromEnum($enum); }

    public function getKey($enum): string { return $enum->getMember(); }
    public function getValue($enum) { return $enum->getValue(); }

    public function equals($lhs, $rhs): bool { return $lhs->equals($rhs); }

    public function keyExists(string $key): bool { return ThundererFirstExtendsEnum::memberExists($key); }
    public function valueExists($value): bool { return ThundererFirstExtendsEnum::valueExists($value); }

    /** @param $enum ThundererFirstExtendsEnum */
    public function hasKey($enum, string $key): bool { return $enum->hasMember($key); }
    /** @param $enum ThundererFirstExtendsEnum */
    public function hasValue($enum, $value): bool { return $enum->hasValue($value); }

    public function keyToValue(string $key) { return ThundererFirstExtendsEnum::memberToValue($key); }
    public function valueToKey($value): string { return ThundererFirstExtendsEnum::valueToMember($value); }
    public function listKeys(): array { return ThundererFirstExtendsEnum::getMembers(); }
    public function listValues(): array { return ThundererFirstExtendsEnum::getValues(); }
    public function listKeysValues(): array { return ThundererFirstExtendsEnum::getMembersAndValues(); }

    public function getInstances(): array { return ThundererFirstExtendsEnum::getInstances(); }
    public function valuesExist(array $list): bool { return ThundererFirstExtendsEnum::valuesExist($list); }
    public function membersExist(array $list): bool { return ThundererFirstExtendsEnum::membersExist($list); }
    /** @param ThundererFirstTraitEnum $enum */
    public function instanceIn($enum, array $list): bool { return $enum->isIn($list); }
    /** @param ThundererFirstTraitEnum $enum */
    public function memberIn($enum, array $list): bool { return $enum->hasMemberIn($list); }
    /** @param ThundererFirstTraitEnum $enum */
    public function valueIn($enum, array $list): bool { return $enum->hasValueIn($list); }
}
