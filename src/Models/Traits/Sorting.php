<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;


trait Sorting
{
    /**
     * Sorting.
     */

    /**
     * The initial field to be sorting by.
     *
     * @var string
     */
    public $sortField = 'id';

    /**
     * The initial direction to sort.
     *
     * @var bool
     */
    public $sortDirection = 'asc';

    /**
     * @param $attribute
     */
    public function sort($attribute): void
    {
        if ($this->sortField !== $attribute) {
            $this->sortDirection = 'asc';
        } else {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        }

        $this->sortField = $attribute;
    }
}
