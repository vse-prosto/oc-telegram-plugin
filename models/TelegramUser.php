<?php namespace VseProsto\Telegram\Models;

use Model;
use System\Classes\PluginManager;

/**
 * TelegramUser Model
 */
class TelegramUser extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string table associated with the model
     */
    public $table = 'vseprosto_telegram_user';

    /**
     * @var array guarded attributes aren't mass assignable
     */
    protected $guarded = [''];

    /**
     * @var array fillable attributes are mass assignable
     */
    protected $fillable = ['*'];

    /**
     * @var array rules for validation
     */
    public $rules = [];

    /**
     * @var array Attributes to be cast to native types
     */
    protected $casts = [];

    /**
     * @var array jsonable attribute names that are json encoded and decoded from the database
     */
    protected $jsonable = [];

    /**
     * @var array appends attributes to the API representation of the model (ex. toArray())
     */
    protected $appends = [];

    /**
     * @var array hidden attributes removed from the API representation of the model (ex. toArray())
     */
    protected $hidden = [];

    /**
     * @var array dates attributes that should be mutated to dates
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @var array hasOne and other relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function __construct(array $attributes = [])
    {
        $obPluginManager = PluginManager::instance();
        if ($obPluginManager->exists('RainLab.User')) {
            $this->hasOne['user'] = ['RainLab\User\Models\User'];
        }
        parent::__construct($attributes);
    }
}
