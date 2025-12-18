<?php

class Order
{
    public ?int $id = null;
    public ?int $customer_id = null;
    public ?int $status_id = null;
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
