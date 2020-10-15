<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id', 'amount', 'instructor_part', 'elearning_part', 'email' 
    ];

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
