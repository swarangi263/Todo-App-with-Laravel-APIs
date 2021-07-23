<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    protected $table = 'tasks';

    protected $fillable = [
        // 'user_id',
        'task',
        'status',
    ];

    public $timestamps = false;

    public function user()
    {
        //Eloquent relationship is added to retrieve the tasks associated with the user
        //Every task belong to the particular user

        return $this->belongsTo(User::class);
    }
}
