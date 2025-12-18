<?php

class User
{
    public ?int $id = null;
    public string $name;
    public string $email;
    public string $password;
    public string $role = 'uživatel';
    public ?string $created_at = null;
    public ?string $updated_at = null;

    public function __construct(array $data = [])
    {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }
}