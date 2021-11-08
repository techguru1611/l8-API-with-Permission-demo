<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Permission.
 */
class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'uuid', 'guard_name'];
}
