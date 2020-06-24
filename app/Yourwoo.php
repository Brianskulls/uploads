<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Yourwoo extends Model
{
    protected $table = "yourwoo";
    protected $fillable = ['filesFileName', 'filesSort', 'filesAccountId', 'filesString', 'filesActive', 'filesAddedBy'];
    public $timestamps = false;
}
