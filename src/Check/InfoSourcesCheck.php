<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use PackageVersions\Versions;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class InfoSourcesCheck implements CheckInterface
{
    private static $map = [
        VendorInterface::SOURCE_CONSTANTS => 'C',
        VendorInterface::SOURCE_DOCBLOCKS => 'D',
        VendorInterface::SOURCE_STATIC => 'S',
        VendorInterface::SOURCE_CALLBACK => 'L',
        VendorInterface::SOURCE_ATTRIBUTES => 'A',
    ];

    public function getLabel(): string
    {
        return 'sources';
    }

    public function getDescription(): string
    {
        return 'Available enumeration members sources.'."\n"
            .'C - Constants,'."\n"
            .'D - Docblocks,'."\n"
            .'S - Static property,'."\n"
            .'L - Callback function,'."\n"
            .'A - PHP 8.0 Attributes';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $sources = $vendor->sources();
        $aliases = [];
        foreach($sources as $source) {
            if(false === array_key_exists($source, self::$map)) {
                throw new \LogicException(sprintf('There is no source with alias `%s`.', $source));
            }

            $aliases[] = self::$map[$source];
        }

        return ResultValue::info(implode(' ', $aliases));
    }
}
