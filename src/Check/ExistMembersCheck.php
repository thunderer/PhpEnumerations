<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ExistMembersCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'exist-members';
    }

    public function getDescription(): string
    {
        return 'Verify that all given enum members exist.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $yes = $vendor->membersExist(['VALID_A', 'VALID_B']);
        $no = $vendor->membersExist(['INVALID']);

        return ResultValue::fromCondition($yes && false === $no);
    }
}
