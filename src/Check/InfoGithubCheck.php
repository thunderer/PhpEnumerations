<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class InfoGithubCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'repository';
    }

    public function getDescription(): string
    {
        return 'GitHub repository alias.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::info($vendor->githubRepository());
    }
}
