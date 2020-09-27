<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;

trait Attribute
{
    protected $columns = [];
    protected $data = [];
    protected $sources = [];
    /**
     *
     * @return mixed|null
     */
    protected function getAttrByAttribute()
    {
        $this->columns = [];
        foreach ($this->columns() as $col) {
            $this->columns[$col->name] = $col->toArray();
        }
        return $this;
    }

    /**
     *
     * @return mixed|null
     */
    protected function getAttrResultByAttribute($results)
    {
        $attribute = [];
        $attributes = [];
        if($results->isNotEmpty()):
            foreach ($results->items() as $items):
                foreach ($this->columns() as $col) {
                    $col->model($items);
                    if($col->hasComponents()){
                        $attribute[$col->name] = $col->getComponents();
                    }
                    else{
                        $attribute[$col->name] = $items[$col->name];
                    }
                }
                $attributes[] = $attribute;
            endforeach;
        endif;
        $this->data  = $attributes;
        return $this;
    }


    protected function getAttrSourceAttribute($paginator)
    {

        if($paginator && $paginator->isNotEmpty()):
            $this->sources["current_page"] = $paginator->currentPage();
            $this->sources["first_page_url"] = $paginator->total();
            $this->sources["from"] = $paginator->firstItem();
            $this->sources["last_page"] = $paginator->lastPage();
            $this->sources["last_page_url"] = $paginator->previousPageUrl();
            $this->sources["next_page_url"] = $paginator->nextPageUrl();
            $this->sources["path"] = $paginator->total();
            $this->sources["per_page"] = $paginator->perPage();
            $this->sources["prev_page_url"] = $paginator->previousPageUrl();
            $this->sources["to"] = $paginator->lastItem();
            $this->sources["total"] = $paginator->total();
            $this->sources["options"] = $paginator->getOptions();
        endif;
        return $this;

    }
}
