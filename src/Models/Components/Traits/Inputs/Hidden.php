<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components\Traits\Inputs;


trait Hidden
{
    public function hidden_field(){
        $this->type = "hidden";
        $this->hidden_list();
        return $this;
    }
}
