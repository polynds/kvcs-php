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
    protected array $files = [];

    /**
     * @var string[]
     */
    protected array $dirs = [];

    public function __construct(string $repositoryPath)
    {
        $this->path = $repositoryPath . DIRECTORY_SEPARATOR . self::FILE_NAME;
        $this->reload();
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

    private function initDirs(): void
    {
        $this->dirs = [];
        $baseDir = dirname($this->path);
        $this->dirs[] = $baseDir . DIRECTORY_SEPARATOR . Repository::DIR_NAME;
        $this->dirs[] = $baseDir . DIRECTORY_SEPARATOR . Repository::DIR_GIT_NAME;
    }

    private function initFiles(): void
    {
        $this->files = [];
    }

    private function parse(): void
    {
        if (!file_exists($this->path)) {
            return;
        }
        $handel = fopen($this->path, 'r');
        if (!$handel) {
            return;
        }
        while (($line = fgets($handel)) !== false) {
            $line = trim($line);
            $baseDir = dirname($this->path);
            $line = $baseDir . (str_starts_with($line, DIRECTORY_SEPARATOR) ? '' : DIRECTORY_SEPARATOR) . $line;
            if (is_dir($line)) {
                $this->dirs[] = $line;
            } elseif (is_file($line)) {
                $this->files[] = $line;
            }
        }
        $this->dirs = array_unique($this->dirs);
        $this->files = array_unique($this->files);
        fclose($handel);
    }
}
