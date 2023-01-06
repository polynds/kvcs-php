<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\FileSystem;

use function str_starts_with;

class Finder
{
    public const DOT = '.';

    public const DOUBLE_DOT = '..';

    protected string $path;

    protected array $ignore = [];

    private function __construct(string $path)
    {
        $this->path = $path;
    }

    public static function open(string $path): Finder
    {
        return new static($path);
    }

    public function ignore(string $file): Finder
    {
        $this->ignore[] = $file;
        return $this;
    }

    /**
     * 返回包含所有文件的一维数组.
     */
    public function find(string $path = null): array
    {
        $stack = [];
        $path = $path ?? $this->path;
        $result = [];
        $files = scandir($path);
        foreach ($files as $file) {
            if ($this->filterDot($file)) {
                continue;
            }

            $isContinue = false;
            foreach ($this->ignore as $ignore) {
                if (str_starts_with($path . DIRECTORY_SEPARATOR . $file, $ignore)) {
                    $isContinue = true;
                }
            }
            if ($isContinue) {
                continue;
            }

            $_file = $path . DIRECTORY_SEPARATOR . $file;
            if (is_dir($_file)) {
                $stack[] = $_file;
            } else {
                $result[] = new \SplFileInfo($_file);
            }
        }

        while (! empty($dir = array_pop($stack))) {
            $result = array_merge($result, $this->find($dir));
        }

        return $result;
    }

    /**
     * @return FileNode[]
     */
    public function scan(string $path = null): array
    {
        $result = [];
        $path = $path ?? $this->path;
        $files = scandir($path);
        foreach ($files as $key => $file) {
            if ($this->filterDot($file)) {
                continue;
            }
            $filePath = $path . DIRECTORY_SEPARATOR . $file;
            $splFileInfo = new \SplFileInfo($filePath);
            if (is_dir($filePath)) {
                $result[$key] = (new FileNode())
                    ->setType(FileType::init(FileType::TYPE_DIR))
                    ->setName($file)
                    ->setPath($filePath)
                    ->setMtime($splFileInfo->getMTime())
                    ->setCtime($splFileInfo->getCTime())
                    ->setFiles($this->scan($filePath));
            } else {
                $result[$key] = (new FileNode())
                    ->setType(FileType::init(FileType::TYPE_FILE))
                    ->setName($file)
                    ->setMtime($splFileInfo->getMTime())
                    ->setCtime($splFileInfo->getCTime())
                    ->setPath($filePath);
            }
        }
        return $result;
    }

    /**
     * 返回一颗目录树数组.
     */
    public function tree(string $path = null): array
    {
        $path = $path ?? $this->path;
        $result = [];
        $files = scandir($path);
        foreach ($files as $key => $file) {
            if ($this->filterDot($file)) {
                continue;
            }

            if (in_array($file, $this->ignore)) {
                continue;
            }

            $_file = $path . DIRECTORY_SEPARATOR . $file;

            if (is_dir($_file)) {
                $result[$key]['child'] = array_merge($result, $this->tree($_file));
            } else {
                $result[$key] = new \SplFileInfo($_file);
            }
        }

        return $result;
    }

    public function filterDot(mixed $file): bool
    {
        return in_array($file, [self::DOT, self::DOUBLE_DOT]);
    }
}
