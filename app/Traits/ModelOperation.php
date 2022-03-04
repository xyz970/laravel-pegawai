<?php
namespace App\Traits;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Basic model operation
 */
trait ModelOperation
{
    public function insert(Model $model, $data, $attribute)
    {
        for ($data=0; $data < count($data) ; $data++) { 
            for ($attribute=0; $attribute < count($attribute); $attribute++) { 
                $model[$attribute] = $data;
                $model->save();
            }
        }
    }
}

