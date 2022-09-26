<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

class KitIgnore
{
    public const FILE_NAME = '.kitignore';

    protected string $path;

    /**
     * @var string[]
     */
    protected array $files;

    /**
     * @var string[]
     */
    protected array $dirs;

    public function __construct(string $repositoryPath)
    {
        $this->path = $repositoryPath . DIRECTORY_SEPARATOR . self::FILE_NAME;
        $this->initDirs();
        $this->initFiles();
        $this->parse();
    }

    /**
     * @return string[]
     */
    public function getIgnoreFiles(): array
    {
        return $this->files;
    }

    /**
     * @return string[]
     */
    public function getIgnoreDirs(): array
    {
        return $this->dirs;
    }

    /**
     * 当忽略文件有变化时进行重载.
     */
    public function reload(): static
    {
        $this->initDirs();
        $this->initFiles();
        $this->parse();
        return $this;
    }

    private function initDirs()
    {
        $this->dirs = [];
        $this->dirs[] = Repository::DIR_NAME;
    }

    private function initFiles()
    {
        $this->files = [];
    }

    private function parse()
    {
        if (! file_exists($this->path)) {
            return;
        }
        $handel = fopen($this->path, 'r');
        if (! $handel) {
            return;
        }
        while (feof($handel) !== false) {
            $line = fgets($handel);var_dump($line);
            if (is_dir($line)) {
                $this->dirs[] = $line;
            } elseif (is_file($line)) {
                $this->files[] = $line;
            }
        }
    }
}
