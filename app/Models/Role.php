<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Role.
 */
class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'uuid', 'guard_name'];
}
