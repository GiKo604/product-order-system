
<?php

class ProductController
{
    public function index()
    {
        echo 'Product list (TODO: načíst z DB)';
    }

    public function show($id)
    {
        echo 'Product detail id=' . (int)$id;
    }

    public function create()
    {
        echo 'Product create form';
    }

    public function store()
    {
        echo 'Product store (TODO: vložit do DB)';
    }

    public function update($id)
    {
        echo 'Product update id=' . (int)$id;
    }

    public function delete($id)
    {
        echo 'Product delete id=' . (int)$id;
    }
}