<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Objects;

class Blob extends AbstractKObject
{
    protected Hash $hash;

    protected int $size;

    protected string $obj; //文本内容

    public function __construct(string $obj)
    {
        $this->obj = $obj;
        $this->hash = new Hash($this->obj);
    }

    public function hash(): Hash
    {
        return $this->hash;
    }

    public function type(): string
    {
        return KObject::BLOB_OBJECT;
    }

    public function write(): string
    {
        return pack('s4/s/c4/s*', $this->type(), 0x00, strlen($this->obj), $this->obj);
    }

    public function read(string $bytes): array
    {
        return unpack('s4/s/c4/s*', $bytes);
    }
}
