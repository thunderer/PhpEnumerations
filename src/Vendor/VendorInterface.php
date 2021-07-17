<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Vendor;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
interface VendorInterface
{
    public const SOURCE_CONSTANTS = 1;
    public const SOURCE_DOCBLOCKS = 2;
    public const SOURCE_STATIC = 3;
    public const SOURCE_CALLBACK = 4;
    public const SOURCE_ATTRIBUTES = 5;

    public function enumValidA(): object;
    public function enumValidB(): object;
    public function enumOther(): object;

    public function packagistVendor(): string;
    public function githubRepository(): string;
    public function sources(): array;

    public function fromKey(string $class, string $key): object;
    public function fromValue(string $class, $value): object;
    public function fromConstant(string $class, string $key): object;
    public function fromConstructor(): void;
    public function fromEnum($enum): object;

    public function getKey($enum): string;
    public function getValue($enum);

    public function equals($lhs, $rhs): bool;

    public function keyExists(string $key): bool;
    public function valueExists($value): bool;
    public function hasKey($enum, string $key): bool;
    public function hasValue($enum, $value): bool;

    public function keyToValue(string $key);
    public function valueToKey($value): string;
    public function listKeys(): array;
    public function listValues(): array;
    public function listKeysValues(): array;
}
