<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\ValueObject;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ResultValue
{
    private $result;

    private function __construct(string $result)
    {
        $this->result = $result;
    }

    public function __toString(): string
    {
        return $this->result;
    }

    /* --- NAMED --- */

    public static function fromSame($lhs, $rhs): self
    {
        return $lhs === $rhs ? static::pass() : static::failNotSame($lhs, $rhs);
    }

    public static function fromCondition(bool $condition): self
    {
        return $condition ? static::pass() : static::fail();
    }

    /* --- TYPES --- */

    public static function separator(): self
    {
        return new self('BREAK');
    }

    public static function info(string $comment): self
    {
        return new self('INFO, '.$comment);
    }

    public static function pass(): self
    {
        return new static('PASS');
    }

    public static function passBut(string $reason): self
    {
        return new static('PASS, '.$reason);
    }

    public static function todo(): self
    {
        return new static('TODO');
    }

    public static function fail(): self
    {
        return new static('FAIL');
    }

    public static function failAnd(string $comment): self
    {
        return new static('FAIL, '.$comment);
    }

    public static function failNotSame($lhs, $rhs): self
    {
        $debug = is_array($rhs) ? json_encode(array_map('strval', $rhs)) : json_encode($rhs);

        return static::failAnd('FAIL `'.var_export($lhs, true).'` !== `'.var_export($rhs, true).'` (<b>'.$debug.'</b>)');
    }
}
