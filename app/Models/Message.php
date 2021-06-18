<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $table = 'messages';
    protected $fillable = ['from', 'to', 'message'];
    /**
     * @var mixed
     */
    private $to;
    /**
     * @var mixed
     */
    private $from;
}
