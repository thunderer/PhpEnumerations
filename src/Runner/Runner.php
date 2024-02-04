<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Runner;

use Thunder\PhpEnumerations\Check\CheckInterface;
use Thunder\PhpEnumerations\Exception\NotImplementedException;
use Thunder\PhpEnumerations\Exception\UnsupportedException;
use Thunder\PhpEnumerations\Utility\Utility;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class Runner
{
    public function run(): array
    {
        $results = [];
        $checks = Utility::checks();
        foreach(Utility::vendors() as $vendor) {
            $name = substr(\get_class($vendor), strrpos(\get_class($vendor), '\\') + 1);
            $name = str_replace('Vendor', '', $name);

            $record = [];
            foreach($checks as $check) {
                if(array_key_exists($check->getLabel(), $record)) {
                    throw new \LogicException(sprintf('Duplicate check label `%s` from `%s`.', $check->getLabel(), $check::class));
                }
                $result = $this->runHandler($vendor, $check);
                if('BREAK' === (string)$result) {
                    $record[] = $result;
                    continue;
                }
                $record[$check->getLabel()] = $result;
            }
            $record['summary'] = self::computeSummary($record);

            $results[$name] = $record;
        }

        uasort($results, fn(array $lhs, array $rhs) => strnatcasecmp($rhs['summary'], $lhs['summary']));

        return $results;
    }

    private function runHandler(VendorInterface $vendor, CheckInterface $handler)
    {
        try {
            return $handler->execute($vendor);
        } catch(NotImplementedException $e) {
            return 'TODO';
        } catch(UnsupportedException $e) {
            return 'N/A';
        } catch(\Throwable $e) {
            return 'ERROR: ('.\get_class($e).') '.$e->getMessage().' ('.$e->getFile().'@'.$e->getLine().')';
        }
    }

    private static function computeSummary(array $record): string
    {
        $sum = [];
        foreach($record as $key => $value) {
            switch(true) {
                case 0 === strpos((string)$value, 'PASS'): { @$sum['pass']++; break; }
                case 0 === strpos((string)$value, 'FAIL'): { @$sum['fail']++; break; }
                case 0 === strpos((string)$value, 'N/A'): { @$sum['n/a']++; break; }
                case 0 === strpos((string)$value, 'TODO'): { @$sum['todo']++; break; }
                case 0 === strpos((string)$value, 'ERROR'): { @$sum['fail']++; break; }
                case 0 === strpos((string)$value, 'INFO'): { @$sum['text']++; break; }
                case 0 === strpos((string)$value, 'BREAK'): { @$sum['breaks']++; break; }
                case is_int($key): { @$sum['separator']++; break; }
                default: { throw new \LogicException(sprintf('Unrecognized result key `%s` value `%s`.', $key, $value)); }
            }
        }

        return ''
            .($sum['pass'] ?? 0).'P '
            .(($sum['fail']  ?? 0) ? $sum['fail'].'F '  : '')
            .(($sum['n/a']  ?? 0) ? $sum['n/a'].'N '  : '')
            .(($sum['todo'] ?? 0) ? $sum['todo'].'T' : '');
    }
}
