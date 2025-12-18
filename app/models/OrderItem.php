<?php

class OrderItem
{
    public ?int $id = null;
    public int $order_id;
    public int $product_id;
    public int $quantity = 0;

    public function __construct(array $data = [])
    {
        foreach ($data as $k => $v) {
            if (property_exists($this, $k)) {
                $this->$k = $v;
            }
        }
    }
}
