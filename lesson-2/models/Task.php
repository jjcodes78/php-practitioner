<?php

class Task implements JsonSerializable
{
    protected int $id;
    protected string $task;
    protected bool $completed;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
