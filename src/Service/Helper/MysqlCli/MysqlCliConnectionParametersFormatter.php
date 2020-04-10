<?php


namespace App\Service\Helper\MysqlCli;


/**
 * Generates mysql cli connection parameter string
 */
class MysqlCliConnectionParametersFormatter
{
    /**
     * @var array
     */
    private $urlComponents;

    private $cliParameters = [
        'host' => '-h',
        'port' => '-P',
        'user' => '-u',
        'pass' => '-p',
        'path' => ''
    ];

    public function __construct(string $databaseUrl)
    {
        $this->urlComponents = parse_url($databaseUrl);
        if ($this->urlComponents === false) {
            throw new \InvalidArgumentException("Malformed URL:'$databaseUrl'");
        }
    }

    public function format(array $options = []): string
    {
        $string = '';
        foreach ($this->cliParameters as $component => $flag) {
            if (!array_key_exists($component, $this->urlComponents)) {
                continue;
            }
            $value = $this->urlComponents[$component];
            if ($component === 'path') {
                //Remove trailing slash from dbname
                $value = ltrim($value, '/');
            }
            $string .= " $flag$value";
        }
        return $string;
    }
}
