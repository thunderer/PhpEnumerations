<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\ValueObject;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class ResultValue
{
    private $result;
    private ?string $note;

    private function __construct(string $result, ?string $note = null)
    {
        $this->result = $result;
        $this->note = $note;
    }

    public function __toString(): string
    {
        return $this->result;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    /* --- NAMED --- */

    public static function fromSame($lhs, $rhs): self
    {
        return $lhs === $rhs ? self::pass() : self::failNotSame($lhs, $rhs);
    }

    public static function fromCondition(bool $condition): self
    {
        return $condition ? self::pass() : self::fail();
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

    public static function pass(?string $note = null): self
    {
        return new self('PASS', $note);
    }

    public static function passBut(string $reason, ?string $note = null): self
    {
        return new self('PASS, '.$reason, $note);
    }

    public static function todo(): self
    {
        return new self('TODO');
    }

    public static function fail(): self
    {
        return new self('FAIL');
    }

    public static function failAnd(string $comment): self
    {
        return new self('FAIL, '.$comment);
    }

    public static function failAndComment(string $comment, string $note): self
    {
        return new self('FAIL, '.$comment, $note);
    }

    public static function failNotSame($lhs, $rhs): self
    {
        $debug = is_array($rhs) ? json_encode(array_map('strval', $rhs)) : json_encode($rhs);

        return self::failAnd('FAIL `'.var_export($lhs, true).'` !== `'.var_export($rhs, true).'` (<b>'.$debug.'</b>)');
    }
}
