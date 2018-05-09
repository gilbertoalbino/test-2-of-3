<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = ['name'];

    public function contacts()
    {
        return $this->hasMany('App\Contact');
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contacts' => $this->contacts,
            'created' => Carbon::parse($this->created_at)->format('d/m/Y H:i:s'),
            'updated' => Carbon::parse($this->updated_at)->format('d/m/Y H:i:s'),
        ];
    }
}
