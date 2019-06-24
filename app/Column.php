<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Column extends Model
{
    use SoftDeletes, LogsActivity;

    protected $connection = 'mysql';
    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
}
