<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Leave extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'description',
        'from',
        'to',
        'type',
        'attachment',
        'substitute_staff_id',
        'substitute_staff_status',
        'hod_status',
        'principal_status',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function substitute_staff()
    {
        return $this->belongsTo(User::class, 'substitute_staff_id');
    }
}
