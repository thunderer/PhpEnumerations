<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Thunder\Platenum\Enum\ConstantsEnumTrait;

final class ThundererFirstTraitEnum implements \JsonSerializable
{
    public const VALID_A = 'valid-a';
    public const VALID_B = 'valid-b';

    public const PUBLIC_A = 'public-a';
    public const PUBLIC_B = 'public-b';
    protected const PROTECTED_A = 'protected-a';
    protected const PROTECTED_B = 'protected-b';
    private const PRIVATE_A = 'private-a';
    private const PRIVATE_B = 'private-b';

    use ConstantsEnumTrait;
}

final class ThundererOtherTraitEnum implements \JsonSerializable
{
    public const OTHER = 'other';

    use ConstantsEnumTrait;
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ThundererPlatenumTraitVendor implements VendorInterface
{
    public function enumValidA(): object { return ThundererFirstTraitEnum::VALID_A(); }
    public function enumValidB(): object { return ThundererFirstTraitEnum::VALID_B(); }
    public function enumOther(): object { return ThundererOtherTraitEnum::OTHER(); }

    public function packagistVendor(): string { return 'thunderer/platenum'; }
    public function githubRepository(): string { return 'thunderer/Platenum'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS, self::SOURCE_DOCBLOCKS, self::SOURCE_STATIC, self::SOURCE_CALLBACK, self::SOURCE_ATTRIBUTES]; }

    public function fromKey(string $class, string $key): object { return $class::fromMember($key); }
    public function fromValue(string $class, $value): object { return $class::fromValue($value); }
    public function fromConstant(string $class, string $key): object { return $class::$key(); }
    public function fromConstructor(): void { new ThundererFirstTraitEnum('VALID_A', 'valid-a'); }
    public function fromEnum($enum): object { return ThundererFirstTraitEnum::fromEnum($enum); }

    public function getKey($enum): string { return $enum->getMember(); }
    public function getValue($enum) { return $enum->getValue(); }

    public function equals($lhs, $rhs): bool { return $lhs->equals($rhs); }

    public function keyExists(string $key): bool { return ThundererFirstTraitEnum::memberExists($key); }
    public function valueExists($value): bool { return ThundererFirstTraitEnum::valueExists($value); }
    public function hasKey($enum, string $key): bool { return $enum->hasMember($key); }
    public function hasValue($enum, $value): bool { return $enum->hasValue($value); }

    public function keyToValue(string $key) { return ThundererFirstTraitEnum::memberToValue($key); }
    public function valueToKey($value): string { return ThundererFirstTraitEnum::valueToMember($value); }
    public function listKeys(): array { return ThundererFirstTraitEnum::getMembers(); }
    public function listValues(): array { return ThundererFirstTraitEnum::getValues(); }
    public function listKeysValues(): array { return ThundererFirstTraitEnum::getMembersAndValues(); }
}
