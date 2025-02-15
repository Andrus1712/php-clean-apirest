<?php

namespace App\Application\DTOs;

class TaskDTO
{
    public function __construct(
        public ?int    $id,
        public string $title,
        public string $description,
        public string $status
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? 0,
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['status'] ?? ''
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ];
    }
}
