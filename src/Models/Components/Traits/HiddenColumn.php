<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Components\Traits;


trait HiddenColumn
{

    protected $hidden = [
        'list'                   =>false,
        'show'                   =>false,
        'create'                 =>false,
        'edit'                   =>false,
        'destroy'                =>false,
    ];

    /**
     * @var string
     */
    public function hidden_list($hidden = true): self
    {
        return $this->hidden('list', $hidden);
    }

    /**
     * @var string
     */
    public function hidden_show($hidden = true): self
    {
        return $this->hidden('show', $hidden);
    }

    /**
     * @var string
     */
    public function hidden_create($hidden = true): self
    {
        return $this->hidden('create', $hidden);
    }

    /**
     * @var string
     */
    public function hidden_edit($hidden = true): self
    {
        return $this->hidden('edit', $hidden);
    }

    /**
     * @var string
     */
    public function hidden_destroy($hidden = true): self
    {
        return $this->hidden('destroy', $hidden);
    }
    /**
     * @param $key
     * @param bool $hidden
     * @return HiddenColumn
     */
    public function hidden($key, $hidden=true): self
    {
        if(in_array($key, array_keys($this->hidden))){
           $this->hidden[$key] = $hidden;
        }
        return $this;
    }

    /**
     * @return bool[]
     */
    public function getHidden(): array
    {
        return is_array($this->hidden) ? $this->hidden : [];
    }
}
