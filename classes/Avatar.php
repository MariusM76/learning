<?php

class Avatar extends Base
{
    public $image;

    public $userId;

    public static function getTableName()
    {
        return 'avatars';
    }
}