<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core\Objects;

class Blob extends AbstractKitObject
{
    protected int $length;

    protected string $content; // 文本内容

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->hash = new Hash($this->content);
        $this->length = strlen($this->content);
        $this->setKitObjectType(KitObjectType::init(KitObjectType::BLOB_OBJECT));
    }

    public function toArray(): array
    {
        return [
            'type' => $this->type(),
            'length' => $this->length,
            'content' => $this->content,
        ];
    }
}
