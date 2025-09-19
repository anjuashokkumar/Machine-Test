<?php

namespace ContactForm\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $fillable = ['user_id', 'name', 'email', 'subject', 'message'];

    public function getDateAttribute()
    {
        return $this->created_at->format('Y-m-d'); 
    }
}