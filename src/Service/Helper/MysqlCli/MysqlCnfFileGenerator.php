<?php

namespace App\Service\Helper\MysqlCli;

class MysqlCnfFileGenerator
{
    /**
     * @var array
     */
    private $urlComponents;

    /**
     * @var string
     */
    private $tmpName;

    private $componentsTranslator = [
        'host' => 'localhost',
        'port' => 3306,
        'user' => null,
        'pass' => null,
        'path' => null,
    ];

    private function getFileContent(): string
    {
        $parameters = [];
        foreach ($this->componentsTranslator as $component => $default) {
            $parameter = array_key_exists($component, $this->urlComponents)
                ? $this->urlComponents[$component]
                : $default;
            if ($component === 'path') {
                continue;
            }
            $parameters[] = $parameter;
        }

        return <<<EOL
[client]
  host = $parameters[0]
  port = $parameters[1]
  user = $parameters[2]
  password = $parameters[3]
EOL;
    }

    public function __construct(string $databaseUrl)
    {
        $this->urlComponents = parse_url($databaseUrl);
        if (false === $this->urlComponents) {
            throw new \InvalidArgumentException("Malformed URL:'$databaseUrl'");
        }
    }

    public function generate(): string
    {
        if ($this->tmpName) {
            throw new \RuntimeException('One shot generator');
        }
        $this->tmpName = tempnam(sys_get_temp_dir(), 'rDig');
        file_put_contents($this->tmpName, $this->getFileContent());

        return $this->tmpName;
    }

    public function getFilePath(): string
    {
        return $this->tmpName;
    }

    public function delete(): void
    {
        if (file_exists($this->tmpName)) {
            unlink($this->tmpName);
        }
    }

    public function __destruct()
    {
        $this->delete();
    }
}
