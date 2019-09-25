<?php
declare(strict_types=1);
namespace X;

use Thunder\PhpEnumerations\Runner\Runner;
use Thunder\PhpEnumerations\Utility\Utility;
use Twig\Environment;
use Twig\Extension\ExtensionInterface;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;
use Twig\TwigTest;

ini_set('display_errors', '1');
error_reporting(E_ALL);

require __DIR__.'/../vendor/autoload.php';

$twig = new Environment(new FilesystemLoader([__DIR__.'/../templates']));
$twig->addExtension(new class implements ExtensionInterface {
    public function getTokenParsers() {}
    public function getNodeVisitors() {}
    public function getFilters(): array {
        return [
            new TwigFilter('startsWith', function(string $value, string $part) { return 0 === strpos($value, $part); }),
            new TwigFilter('breakCapitals', function(string $value) { return array_filter(preg_split('~(?=[A-Z])~', $value)); }),
            new TwigFilter('description', function(string $value) { return Utility::description($value); }),
        ];
    }
    public function getTests(): array {
        return [new TwigTest('numeric', 'is_numeric')];
    }
    public function getFunctions() {}
    public function getOperators() {}
});

echo $twig->render('result.twig', [
    'results' => (new Runner())->run(),
]);
