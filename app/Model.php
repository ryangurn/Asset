<?php

namespace App;

use Illuminate\Database\Eloquent\Model as m;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Model extends m
{
    use SoftDeletes, LogsActivity;

    protected $connection = 'mysql';
    protected static $logAttributes = ['*'];
    protected static $logFillable = true;
}
