<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use GuzzleHttp\Client;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class InfoPackagistDownloadsCheck implements CheckInterface
{
    public function getLabel(): string
    {
        return 'downloads';
    }

    public function getDescription(): string
    {
        return 'Packagist total downloads number.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::info((string)$this->fetchDownloads($vendor->packagistVendor()));
    }

    private function fetchDownloads($package): int
    {
        $path = __DIR__.'/../../var/cache/packagist/'.strtolower(str_replace('/', '_', $package)).'.json';
        if(!file_exists($path)) {
            $client = new Client();
            $response = $client->get('https://packagist.org/packages/'.$package.'/stats.json');
            if(200 !== $response->getStatusCode()) {
                throw new \RuntimeException('Failure!');
            }
            $json = $response->getBody()->getContents();
            @mkdir(dirname($path), 0777, true);
            if(false === file_put_contents($path, $json)) {
                throw new \RuntimeException('Failure!');
            }
        }

        return json_decode(file_get_contents($path), true)['downloads']['total'];
    }
}
