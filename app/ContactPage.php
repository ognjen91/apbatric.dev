<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPage extends Model
{
    protected $fillable = ['adress', 'phone1', 'phone2', 'email',
  'skype', 'facebook', 'instagram'];
}
