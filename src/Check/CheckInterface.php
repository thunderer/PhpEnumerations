<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
interface CheckInterface
{
    public function getLabel(): string;

    public function getDescription(): string;

    public function execute(VendorInterface $vendor): ResultValue;
}
