<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyplayerlist extends Model
{
    protected $table = "keyplayerlist";
    protected $fillable = ['filesFileName', 'filesSort', 'filesAccountId', 'filesString', 'filesActive', 'filesAddedBy'];
    public $timestamps = false;
}
