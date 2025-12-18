<?php

class Customer
{
    public ?int $id = null;
    public string $name;
    public ?string $client_code = null;
    public ?string $email = null;
    public ?string $created_at = null;

    public function __construct(array $data = [])
    {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }
}
