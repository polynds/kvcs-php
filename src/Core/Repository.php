<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use Kit\ApplicationContext;
use Kit\Core\FileSystem\Directory;
use Kit\Core\FileSystem\FileMode;
use Kit\Core\FileSystem\Path;
use Kit\Core\ObjectDatabase\ObjectDatabase;
use Kit\Core\ObjectDatabase\ObjectFactory;
use Kit\Core\ObjectDatabase\Objects\KitObjectType;
use Kit\Core\ObjectDatabase\Objects\Tree;
use Kit\Core\ObjectDatabase\Objects\TreeEntry;
use Kit\Core\Refs\Refs;
use Kit\Core\StagingArea\StagingArea;
use Kit\Exception\DirectoryNotExistException;
use Kit\Exception\ObjectNotExistException;

/**
 * 版本库.
 */
class Repository
{
    public const DIR_NAME = '.kit';

    public const DIR_GIT_NAME = '.git';

    /**
     * 暂存区.
     */
    protected StagingArea $stagingArea;

    /**
     * 版本数据库.
     */
    protected ObjectDatabase $objectDatabase;

    protected string $path;

    protected Head  $head;

    protected Refs  $refs;

    public function __construct(string $basePath)
    {
        $this->path = $basePath . DIRECTORY_SEPARATOR . self::DIR_NAME;
        $this->stagingArea = new StagingArea($this->path);
        $this->objectDatabase = new ObjectDatabase($this->path);
        $this->head = new Head($this->path);
        $this->refs = new Refs($this->path);
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getStagingArea(): StagingArea
    {
        return $this->stagingArea;
    }

    public function getObjectDatabase(): ObjectDatabase
    {
        return $this->objectDatabase;
    }

    public function init()
    {
        Directory::create($this->path);
        $this->stagingArea->init();
        $this->objectDatabase->init();
        $this->head->init();
        $this->refs->init();
    }

    /**
     * 根据暂存区内容生成tree对象，并保存.
     */
    public function commit(string $message)
    {
        $stagingArea = ApplicationContext::getApplication()->getRepository()->getStagingArea();
        $objectDatabase = ApplicationContext::getApplication()->getRepository()->getObjectDatabase();
        $indexs = $stagingArea->load()->getIndex();
        /** @var Tree[] $trees */
        $trees = [];
        foreach ($indexs as $index) {
            // 处理文件目录，生成tree对象
            $pathArr = Path::split($index->getPath());
            $pathArr = array_reverse($pathArr);
            $prev = '';
            foreach ($pathArr as $path) {
                $pathName = Path::getCurPathName($path);
                if (isset($trees[$path])) {
                    $tree = $trees[$path];
                } else {
                    $tree = ObjectFactory::createTree($pathName, $path);
                }
                // 把当前tree加入到父级tree中
                if (! empty($prev) && isset($trees[$prev])) {
                    $trees[$prev]->addEntry(new TreeEntry(
                        FileMode::init(FileMode::DIRECTORY),
                        $tree->getHashString(),
                        $pathName,
                        $path,
                        KitObjectType::init(KitObjectType::TREE_OBJECT)
                    ));
                }
                $trees[$path] = $tree;
                $prev = $path;
            }

            // 处理文件名，按照目录结构将文件信息写入tree对象中
            $pathName = $pathArr[count($pathArr) - 1] ?? Path::DOT;
            $tree = $trees[$pathName] ?? null;
            $blob = ObjectFactory::findForHash($index->getFileHash());
            if (is_null($blob)) {
                throw new ObjectNotExistException($index->getFileName(), 'Not found in staging area.');
            }
            $tree->addEntry(new TreeEntry(
                $index->getFileMode(),
                $index->getFileHash(),
                $index->getFileName(),
                $index->getPath(),
                KitObjectType::init(KitObjectType::BLOB_OBJECT)
            ));
        }

        // 保存所有的tree,生成commit对象
        foreach ($trees as $tree) {
            $objectDatabase->store($tree);
        }

        // 生成commit对象
//        $commit = ObjectFactory::createCommit($topTree,$message);
//        $objectDatabase->store($commit);
    }

    private function check()
    {
        if (! is_dir($this->path)) {
            throw new DirectoryNotExistException(self::DIR_NAME);
        }
    }
}
