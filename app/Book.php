<?php
/**
 * Created by PhpStorm.
 * User: strahinja.ristic
 * Date: 10/24/2017
 * Time: 11:23 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{


    protected $fillable = [
        'title', 'isbn',
    ];

}