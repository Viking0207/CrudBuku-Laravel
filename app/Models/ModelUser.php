<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelUser extends Authenticatable
{
    use HasFactory;

    protected $table = 'tb_user';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'status',
    ];

    public $timestamps = true;

    public function pembelis()
    {
        return $this->hasMany(ModelPembeli::class, 'user_id', 'id');
    }
}
