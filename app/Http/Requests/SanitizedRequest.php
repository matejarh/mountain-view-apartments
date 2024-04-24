<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Request;

abstract class SanitizedRequest extends Request {

    private $clean = false;

    public function all(){
        return $this->sanitize(parent::all());
    }


    protected function sanitize(Array $inputs){
        if($this->clean){ return $inputs; }

        foreach($inputs as $i => $item){
            $inputs[$i] = str(trim($this->najdi))->squish();
        }

        $this->replace($inputs);
        $this->clean = true;
        return $inputs;
    }
}
