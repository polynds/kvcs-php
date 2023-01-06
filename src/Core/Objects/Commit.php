<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Objects;

class Commit extends AbstractKitObject
{
    protected Hash $tree;

    /**
     * @var Hash[]
     */
    protected array $parent;

    protected string $author;

    protected string $committer;

    protected string $gpgsig;

    protected string $message;

    public function __construct(Hash $parent, Hash $tree)
    {
        $this->parent[] = $parent;
        $this->tree = $tree;
        $this->hash = new Hash('');
        $this->setKitObjectType(KitObjectType::init(KitObjectType::COMMIT_OBJECT));
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function setCommitter(string $committer): self
    {
        $this->committer = $committer;
        return $this;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'tree' => $this->tree->getHashString(),
            'parent' => implode(',', array_map(function ($item) {
                return $item->getHashString();
            }, $this->parent)),
            'author' => $this->author,
            'committer' => $this->committer,
            'gpgsig' => $this->gpgsig,
        ];
    }
}
