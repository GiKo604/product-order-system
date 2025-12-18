<?php

class OrderController
{
    public function index()
    {
        echo 'Order list (TODO: načíst z DB)';
    }

    public function show($id)
    {
        echo 'Order detail id=' . (int)$id;
    }

    public function create()
    {
        echo 'Order create form';
    }

    public function store()
    {
        echo 'Order store (TODO: vložit do DB)';
    }

    public function updateStatus($id)
    {
        echo 'Order status update id=' . (int)$id;
    }
}
