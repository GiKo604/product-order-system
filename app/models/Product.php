<?php

class Product
{
    public ?int $id = null;
    public ?int $customer_id = null;
    public string $our_code;
    public string $client_code;
    public ?string $size = null;
    public ?string $cut_name = null;
    public ?string $foil_type = null;
    public ?float $color_coverage = null;
    public ?string $ean_code = null;
    public ?string $preview_file = null;
    public ?int $approval_status_id = null;
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
