<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Exception;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class NotImplementedException extends \RuntimeException
{
    public static function throwException(): self
    {
        throw new self();
    }
}
