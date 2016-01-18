<?php
namespace model;

use vendor\db\ActiveRecord;

class Test extends ActiveRecord
{
    public function tableName()
    {
        return 'test';
    }
}
