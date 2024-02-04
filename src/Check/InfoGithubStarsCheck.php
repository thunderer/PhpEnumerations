<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use GuzzleHttp\Client;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class InfoGithubStarsCheck implements CheckInterface
{
    /** @var string */
    private $handle;
    /** @var string */
    private $token;

    public function __construct(string $handle, string $token)
    {
        $this->handle = $handle;
        $this->token = $token;
    }

    public function getLabel(): string
    {
        return 'stars';
    }

    public function getDescription(): string
    {
        return 'GitHub repository stars.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        return ResultValue::info($this->fetchStars($vendor->githubRepository()));
    }

    private function fetchStars($repository): string
    {
        if('-' === $repository) { return '-'; }

        $path = __DIR__.'/../../var/cache/github/'.strtolower(str_replace('/', '_', $repository)).'.json';
        if(!file_exists($path)) {
            $client = new Client();
            $response = $client->get('https://api.github.com/repos/'.$repository, [
                'auth' => [$this->handle, $this->token],
            ]);
            if(200 !== $response->getStatusCode()) {
                throw new \RuntimeException('Failure!');
            }
            $json = $response->getBody()->getContents();
            @mkdir(dirname($path), 0777, true);
            if(false === file_put_contents($path, $json)) {
                throw new \RuntimeException('Failure!');
            }
        }

        $value = json_decode(file_get_contents($path), true)['stargazers_count'];

        return number_format($value);
    }
}
