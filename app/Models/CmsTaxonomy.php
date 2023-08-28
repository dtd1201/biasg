<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsTaxonomy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tb_cms_taxonomys';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'json_params' => 'object',
    ];
    public function parent()
    {
        return $this->belongsTo(CmsTaxonomy::class, 'parent_id', 'id');
    }
}
