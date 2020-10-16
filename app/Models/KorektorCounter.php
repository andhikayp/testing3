<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KorektorCounter extends Model
{
    
    protected $primaryKey='korektor_id';
    public $incrementing = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'korektor_counter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'korektor_id', 'essays_assigned_count',
        'essays_corrected_count'
    ];
    


    public function user() {
        return $this->hasMany('App\Models\User', 'id');
    }

    
}
