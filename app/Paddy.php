<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paddy extends Model
{
    public function paddystock(){
        return $this->belongsTo('App\PaddyStock');
    }
    protected $table = "paddystock";
    private $type;
    private $amount;

    public function _constructor($type, $amount) {

        $this->type = $type;
        $amount->amount = $amount;
    }

    public function getType() {
        return $this->type;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }
    
}
