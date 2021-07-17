<?php
declare(strict_types=1);
namespace Thunder\PhpEnumerations\Check;

use GuzzleHttp\Client;
use Thunder\PhpEnumerations\ValueObject\ResultValue;
use Thunder\PhpEnumerations\Vendor\VendorInterface;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
final class InfoGithubUpdateCheck implements CheckInterface
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
        return 'updated';
    }

    public function getDescription(): string
    {
        return 'Last update to GitHub project repository.';
    }

    public function execute(VendorInterface $vendor): ResultValue
    {
        $now = new \DateTimeImmutable();
        $date = $this->fetchLastCommitDate($vendor->githubRepository());
        $diff = $now->getTimestamp() - $date->getTimestamp();
        if($diff < 24 * 3600) {
            return ResultValue::info('<1d');
        }
        if($diff > 365 * 24 * 3600) {
            return ResultValue::info('>1y');
        }

        $map = [
            'w' => 7 * 24 * 60 * 60,
            'd' =>     24 * 60 * 60,
            'h' =>          60 * 60,
            'm' =>               60,
            's' =>                1,
        ];
        $string = [];
        foreach($map as $alias => $value) {
            $x = (int)($diff / $value);
            if($x > 0) {
                $string[] = $x.$alias;
            }
            $diff -= $x * $value;
        }

        return ResultValue::info(implode(' ', array_slice($string, 0, 2)));
    }

    private function fetchLastCommitDate($repository): ?\DateTimeImmutable
    {
        $path = __DIR__.'/../../var/cache/github/'.strtolower(str_replace('/', '_', $repository)).'-commits.json';
        if(!file_exists($path)) {
            $client = new Client();
            $response = $client->get('https://api.github.com/repos/'.$repository.'/commits', [
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

        $date = json_decode(file_get_contents($path), true)[0]['commit']['committer']['date'];
        $date = new \DateTimeImmutable($date);

        return $date;
    }
}
