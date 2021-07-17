<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

use Eloquent\Enumeration\AbstractMultiton;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;

final class EloquentMultitonFirstEnum extends AbstractMultiton
{
    public const VALID_A = 'valid-a';
    public const VALID_B = 'valid-b';

    public const PUBLIC_A = 'public-a';
    public const PUBLIC_B = 'public-b';
    protected const PROTECTED_A = 'protected-a';
    protected const PROTECTED_B = 'protected-b';
    private const PRIVATE_A = 'private-a';
    private const PRIVATE_B = 'private-b';

    protected static function initializeMembers()
    {
        new static('VALID_A');
        new static('VALID_B');

        new static('PUBLIC_A');
        new static('PUBLIC_B');
        new static('PROTECTED_A');
        new static('PROTECTED_B');
        new static('PRIVATE_A');
        new static('PRIVATE_B');
    }
}

final class EloquentMultitonOtherEnum extends AbstractMultiton
{
    public const OTHER = 'other';
}

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class EloquentEnumerationMultitonVendor implements VendorInterface
{
    public function enumValidA(): object { return EloquentMultitonFirstEnum::VALID_A(); }
    public function enumValidB(): object { return EloquentMultitonFirstEnum::VALID_B(); }
    public function enumOther(): object { return EloquentEnumerationOtherEnum::OTHER(); }

    public function packagistVendor(): string { return 'eloquent/enumeration'; }
    public function githubRepository(): string { return 'eloquent/enumeration'; }
    public function sources(): array { return [self::SOURCE_CONSTANTS]; }

    public function fromKey(string $class, string $key): object { return $class::memberByKey($key); }
    public function fromValue(string $class, $value): object { UnsupportedException::throwException(); }
    public function fromConstant(string $class, $key): object { UnsupportedException::throwException(); }
    public function fromConstructor(): void { new EloquentMultitonFirstEnum('VALID_A', 'valid-a'); }
    public function fromEnum($enum): object { UnsupportedException::throwException(); }

    public function getKey($enum): string { return $enum->key(); }
    public function getValue($enum) { UnsupportedException::throwException(); }
    public function equals($lhs, $rhs): bool { UnsupportedException::throwException(); }

    public function keyExists(string $key): bool { UnsupportedException::throwException(); }
    public function valueExists($value): bool { UnsupportedException::throwException(); }

    public function hasKey($enum, string $key): bool { UnsupportedException::throwException(); }
    public function hasValue($enum, $value): bool { UnsupportedException::throwException(); }

    public function keyToValue(string $key) { UnsupportedException::throwException(); }
    public function valueToKey($value): string { UnsupportedException::throwException(); }
    public function listKeys(): array { return EloquentMultitonFirstEnum::members(); }
    public function listValues(): array { UnsupportedException::throwException(); }
    public function listKeysValues(): array { return EloquentMultitonFirstEnum::members(); }
}
