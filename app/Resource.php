<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded  = array('id');

    /**
     * Get the resource's template.
     *
     * @return Template
     */
    public function template()
    {
        return $this->belongsTo(Template::class,'template_id');
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @return bool|int
     */
    public function update(array $attributes = [])
    {
        if (isset($attributes['isHidden'])) {
            $attributes['deleted_at'] = $attributes['isHidden'] ? date('Y-m-d H:i:s'): null;
            unset($attributes['isHidden']);
        }
        // Remove hash from the colors
        if (str_contains($attributes['backgroundColor'], '#')) {
            $attributes['backgroundColor'] = str_replace('#', '', $attributes['backgroundColor']);
        }
        if (str_contains($attributes['creditTitleColor'], '#')) {
            $attributes['creditTitleColor'] = str_replace('#', '', $attributes['creditTitleColor']);
        }

        return parent::update($attributes);
    }

    /**
     * Save the model to the database.
     *
     * @param  array  $options
     * @return bool
     */
    public function save(array $options = [])
    {
        if (isset($this->attributes['isHidden'])) {
            $this->attributes['deleted_at'] = $this->attributes['isHidden'] ? date('Y-m-d H:i:s'): null;
            unset($this->attributes['isHidden']);
        }

        return parent::save($options);
    }
}
