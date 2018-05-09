<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['person_id', 'contact', 'value'];

    public function person()
    {
        return $this->belongsTo('App\Person');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'contact' => $this->contact,
            'value' => $this->value,
            'created' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'updated' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
        ];
    }
}
