<?php

namespace App\Application\DTOs;

class UserDTO
{
    public function __construct(
        public int    $id,
        public string $name,
        public string $email
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'] ?? 0,
            $data['name'] ?? '',
            $data['email'] ?? ''
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}
