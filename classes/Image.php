<?php

class Image extends Base
{
    public $file;

    public $productId;

    public static function getTableName()
    {
        return 'images';
    }


}