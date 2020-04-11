<?php

namespace App\Entity;

abstract class AbstractVocabularyEntity implements CrudEntityInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $value;

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function toArray(bool $ancestors = true, bool $descendants = false)
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
        ];
    }
}
