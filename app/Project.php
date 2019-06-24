<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Project extends Model
{
    use SoftDeletes, LogsActivity;

    /**
     * @var string
     * Prefer the mysql structured connection
     */
    protected $connection = 'mysql';
    /**
     * @var array
     * We are logging all attributes
     */
    protected static $logAttributes = ['*'];
    /**
     * @var bool
     * We are logging all fillable attributes
     */
    protected static $logFillable = true;

    /**
     * @var array
     * The data model attributes that the user
     * can fill, and bulk edit.
     */
    protected $fillable = [
        'name',
        'max_model_count'
    ];

    /**
     * @var array
     * We we do not want to be displayed
     */
    protected $hidden = [
        'deleted_at'
    ];

    /**
     * @var array
     * Creation Validator
     */
    public $createValidator = [
        'name' => [
            'required',
            'min:3',
            'max:255',
        ],
        'max_model_count' => [
            'required',
            'integer'
        ]
    ];

    /**
     * @var array
     * Read Validator
     */
    public $readValidator = [
        'id' => [
            'required',
            'exists:projects,id',
            'integer'
        ]
    ];

    /**
     * @var array
     * Update Validator
     */
    public $updateValidator = [
        'id' => [
            'required',
            'exists:projects,id',
            'integer'
        ],
        'name' => [
            'required',
            'min:3',
            'max:255',
            'alpha_num'
        ],
        'max_model_count' => [
            'required',
            'integer'
        ]
    ];

    /**
     * @var array
     * Delete Validator
     */
    public $deleteValidator = [
        'id' => [
            'required',
            'exists:projects,id',
            'integer'
        ]
    ];

    /**
     * @var array
     * Handles the autocasting of data types
     */
    protected $casts = [
        'max_model_count' => 'integer'
    ];

    /**
     * @param $value
     * Set the name attribute and enforce formatting
     */
    public function setNameAttribute($value)
    {
        $ret = '';
        $explode = explode(" ", $value);
        foreach ($explode as $e)
        {
            if(!is_numeric(intval($e)))
            {
                dump($e);
                $ret += ucfirst(strtolower($e));
            }
            else
            {
                $ret = $ret . ' ' . $e;
            }
        }

        $this->attributes['name'] = trim($ret);
    }

    /**
     * @param $value
     * @return mixed
     * Get the name attribute.
     */
    public function getNameAttribute($value)
    {
        return $value;
    }

    /**
     * @param $value
     * Set the max_model_count attribute and
     * enforce formatting
     */
    public function setMaxModelCountAttribute($value)
    {
        $this->attributes['max_model_count'] = intval($value);
    }

    /**
     * @param $value
     * @return mixed
     * Get the max_model_count attribute
     */
    public function getMaxModelCountAttribute($value)
    {
        return $value;
    }

    /**
     * @return false|string
     * Print the current model
     */
    public function getPrintAttribute()
    {
        dump(json_encode($this));
    }



}
