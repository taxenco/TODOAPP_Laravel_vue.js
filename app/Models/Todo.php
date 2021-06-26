<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
Use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Todo extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'todos';
    
    protected $fillable = ['task','completed'];

    protected $dates = ['created_at', 'updated_at'];

    public function getCreatedAtAttribute($date) {
        
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }
    
    public function getUpdatedAtAttribute($date) {
        
        return Carbon::parse($date)->format('Y-m-d H:i:s');
    }

    public function getTaskAttribute($task) {
        
        $lowerCasestring = strtolower($task);
        
        return ucfirst($lowerCasestring);
    }

    public function setTaskAttribute($task) {
        
        
       $this->attributes['task'] = ucfirst(strtolower($task));
    }
}