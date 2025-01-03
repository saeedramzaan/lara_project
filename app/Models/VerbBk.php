<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class VerbBk extends Model
{
      // Local Postgres Database 
    use HasFactory;
    
    public $timestamps = false;
    protected $connection = 'second_db';
    // protected $primaryKey = null;
    // public $incrementing = false;

    protected $table = 'verbs'; // Specify your table name

    protected $primaryKey = 'q_id'; // Specify the primary key column

    public $incrementing = true; // Ensure incrementing is set to true

    protected $keyType = 'int'; // Ensure key type is integer

    protected $fillable = [
        'question','verb_no', 'answer', 'updated_date', 'correct_answer'
    ];

 

  

}
