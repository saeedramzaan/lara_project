<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $connection = 'second_db';
    protected $table = 'members';

    public $timestamps = false;
    // protected $primaryKey = null;
    // public $incrementing = false;

 //  protected $table = 'questions'; // Specify your table name

    protected $primaryKey = 'q_id'; // Specify the primary key column

    public $incrementing = true; // Ensure incrementing is set to true

    protected $keyType = 'int'; // Ensure key type is integer

    protected $fillable = [
        'question','answer',
    ];
}
