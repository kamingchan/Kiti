<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class topic extends Model
{
    public function getContentWithBy()
    {
        if ($this->author == "")
            return $this->text;
        else
            return $this->text." by: ".$this->author;
    }
}
