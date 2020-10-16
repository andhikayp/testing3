<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use App\Models\

class SoalCorrectionsCounter extends Model
{

    protected $primaryKey='soal_id';
    public $incrementing = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'soal_corrections_counter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable =[
        'soal_id', 'essays_total_count',
        'essays_corrected_count'
    ];

    public function soal() {
        return $this->belongsTo('App\Models\Soal', 'soal_id');
    }

}
