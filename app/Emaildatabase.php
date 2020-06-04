<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emaildatabase extends Model
{
    protected $table = "emaildatabase";
    protected $fillable = ['filesFileName', 'filesSort', 'filesAccountId', 'filesString', 'filesActive', 'filesAddedBy'];
    public $timestamps = false;
}
