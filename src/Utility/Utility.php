<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Utility;

use Thunder\PhpEnumerations\Check\CheckInterface;
use Thunder\PhpEnumerations\Check\CreateInstancesCheck;
use Thunder\PhpEnumerations\Check\ExistMembersCheck;
use Thunder\PhpEnumerations\Check\ExistValuesCheck;
use Thunder\PhpEnumerations\Check\HasKeyInCheck;
use Thunder\PhpEnumerations\Check\HasValueInCheck;
use Thunder\PhpEnumerations\Check\HasInstanceInCheck;
use Thunder\PhpEnumerations\Check\ConvertToJsonCheck;
use Thunder\PhpEnumerations\Check\ConvertToKeyCheck;
use Thunder\PhpEnumerations\Check\ConvertToStringCheck;
use Thunder\PhpEnumerations\Check\ConvertToValueCheck;
use Thunder\PhpEnumerations\Check\CreateInstanceCheck;
use Thunder\PhpEnumerations\Check\CreateUsingConstCheck;
use Thunder\PhpEnumerations\Check\CreateUsingEnumCheck;
use Thunder\PhpEnumerations\Check\CreateUsingKeyCheck;
use Thunder\PhpEnumerations\Check\CreateUsingValueCheck;
use Thunder\PhpEnumerations\Check\EqualsInstanceofCheck;
use Thunder\PhpEnumerations\Check\EqualsLooseCheck;
use Thunder\PhpEnumerations\Check\EqualsMethodCheck;
use Thunder\PhpEnumerations\Check\EqualsStrictCheck;
use Thunder\PhpEnumerations\Check\ExistsKeyCheck;
use Thunder\PhpEnumerations\Check\ExistsValueCheck;
use Thunder\PhpEnumerations\Check\HasKeyCheck;
use Thunder\PhpEnumerations\Check\HasValueCheck;
use Thunder\PhpEnumerations\Check\InfoGithubUpdateCheck;
use Thunder\PhpEnumerations\Check\InfoPackagistDownloadsCheck;
use Thunder\PhpEnumerations\Check\InfoGithubCheck;
use Thunder\PhpEnumerations\Check\InfoGithubStarsCheck;
use Thunder\PhpEnumerations\Check\InfoPackagistCheck;
use Thunder\PhpEnumerations\Check\InfoSourcesCheck;
use Thunder\PhpEnumerations\Check\InfoVersionCheck;
use Thunder\PhpEnumerations\Check\ListAssociativeCheck;
use Thunder\PhpEnumerations\Check\ListKeysCheck;
use Thunder\PhpEnumerations\Check\ListKeyToValueCheck;
use Thunder\PhpEnumerations\Check\ListValuesCheck;
use Thunder\PhpEnumerations\Check\ListValueToKeyCheck;
use Thunder\PhpEnumerations\Check\MagicCallCheck;
use Thunder\PhpEnumerations\Check\MagicCloneCheck;
use Thunder\PhpEnumerations\Check\MagicInvokeCheck;
use Thunder\PhpEnumerations\Check\MagicPropertiesCheck;
use Thunder\PhpEnumerations\Check\SeparatorCheck;
use Thunder\PhpEnumerations\Check\VerifyBaseCheck;
use Thunder\PhpEnumerations\Check\VerifyConstructorCheck;
use Thunder\PhpEnumerations\Check\MagicSerializationCheck;
use Thunder\PhpEnumerations\Check\VerifyInstanceCheck;
use Thunder\PhpEnumerations\Vendor\BensampoLaravelenumVendor;
use Thunder\PhpEnumerations\Vendor\CommerceguysEnumVendor;
use Thunder\PhpEnumerations\Vendor\DaspridEnumVendor;
use Thunder\PhpEnumerations\Vendor\ElaoEnumVendor;
use Thunder\PhpEnumerations\Vendor\EloquentEnumerationEnumerationVendor;
use Thunder\PhpEnumerations\Vendor\EloquentEnumerationMultitonVendor;
use Thunder\PhpEnumerations\Vendor\EskyEnumVendor;
use Thunder\PhpEnumerations\Vendor\Greg0ireEnumVendor;
use Thunder\PhpEnumerations\Vendor\HappytypesEnumerabletypeVendor;
use Thunder\PhpEnumerations\Vendor\KonektEnumVendor;
use Thunder\PhpEnumerations\Vendor\MarcmabePhpenumVendor;
use Thunder\PhpEnumerations\Vendor\MyclabsPhpenumVendor;
use Thunder\PhpEnumerations\Vendor\PhpNativeVendor;
use Thunder\PhpEnumerations\Vendor\SpatieEnumVendor;
use Thunder\PhpEnumerations\Vendor\ThundererPlatenumExtendsVendor;
use Thunder\PhpEnumerations\Vendor\ThundererPlatenumTraitVendor;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class Utility
{
    /** @return list<VendorInterface> */
    public static function vendors(): array
    {
        return [
            new BensampoLaravelenumVendor(),
            new CommerceguysEnumVendor(),
            new DaspridEnumVendor(),
            // new ElaoEnumVendor(),
            new EloquentEnumerationEnumerationVendor(),
            new EloquentEnumerationMultitonVendor(),
            new EskyEnumVendor(),
            new Greg0ireEnumVendor(),
            // new HappytypesEnumerabletypeVendor(),
            new KonektEnumVendor(),
            new MyclabsPhpenumVendor(),
            new MarcmabePhpenumVendor(),
            new SpatieEnumVendor(),
            new ThundererPlatenumTraitVendor(),
            new ThundererPlatenumExtendsVendor(),
            new PhpNativeVendor(),
        ];
    }

    /** @return list<CheckInterface> */
    public static function checks(): array
    {
        return [
            new InfoPackagistCheck(),
            new InfoPackagistDownloadsCheck(),
            new InfoGithubUpdateCheck(getenv('GITHUB_HANDLE'), getenv('GITHUB_TOKEN')),
            new InfoGithubCheck(),
            new InfoGithubStarsCheck(getenv('GITHUB_HANDLE'), getenv('GITHUB_TOKEN')),
            new InfoVersionCheck(),
            new InfoSourcesCheck(),
            new SeparatorCheck(),

            new CreateInstanceCheck(),
            new CreateUsingKeyCheck(),
            new CreateUsingValueCheck(),
            new CreateUsingConstCheck(),
            new CreateUsingEnumCheck(),
            new CreateInstancesCheck(),
            new SeparatorCheck(),

            new ConvertToKeyCheck(),
            new ConvertToValueCheck(),
            new ConvertToStringCheck(),
            new ConvertToJsonCheck(),
            new SeparatorCheck(),

            new EqualsInstanceofCheck(),
            new EqualsStrictCheck(),
            new EqualsLooseCheck(),
            new EqualsMethodCheck(),
            new SeparatorCheck(),

            new HasKeyCheck(),
            new HasValueCheck(),
            new HasKeyInCheck(),
            new HasValueInCheck(),
            new HasInstanceInCheck(),
            new ExistsKeyCheck(),
            new ExistsValueCheck(),
            new ExistMembersCheck(),
            new ExistValuesCheck(),
            new SeparatorCheck(),

            new ListKeyToValueCheck(),
            new ListValueToKeyCheck(),
            new ListKeysCheck(),
            new ListValuesCheck(),
            new ListAssociativeCheck(),
            new SeparatorCheck(),

            new VerifyInstanceCheck(),
            new VerifyBaseCheck(),
            new VerifyConstructorCheck(),
            new SeparatorCheck(),

            new MagicSerializationCheck(),
            new MagicCloneCheck(),
            new MagicInvokeCheck(),
            new MagicPropertiesCheck(),
            new MagicCallCheck(),
        ];
    }

    public static function description(string $key): string
    {
        foreach(self::checks() as $check) {
            if($check->getLabel() === $key) {
                return $check->getDescription();
            }
        }

        return '-';
    }

    public static function causesError(callable $fn): bool
    {
        $called = false;
        set_error_handler(function() use(&$called) { $called = true; });
        $fn();
        restore_error_handler();

        return $called;
    }

    public static function attemptStringCast($enum): bool
    {
        $castToString = function() use($enum) {
            return (string)$enum;
        };
        try {
            if(self::causesError($castToString)) {
                return false;
            }
        } catch(\Error $e) {
            return 'Object of class '.\get_class($enum).' could not be converted to string' !== $e->getMessage();
        }

        return true;
    }

    public static function attemptStringCastList(array $list): bool
    {
        foreach($list as $item) {
            if(false === self::attemptStringCast($item)) {
                return false;
            }
        }

        return true;
    }

    public static function causesException(callable $fn): bool
    {
        try {
            $fn();
        } catch(\Throwable $e) {
            return true;
        }

        return false;
    }

    public static function causesAnyProblem(callable $fn): bool
    {
        $called = false;

        try {
            set_error_handler(function() use(&$called) { $called = true; });
            $fn();
            restore_error_handler();
        } catch(\Throwable $e) {
            return true;
        }

        return $called;
    }
}
