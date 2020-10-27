<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */

 class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',       
    ];

    public function getNameAttribute()
    {
        return sprintf('%s %s', $this->first_name, $this->last_name);
    }
}
