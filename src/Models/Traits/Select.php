<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;


use Call\Models\Components\AbstractField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

trait Select
{

    protected $components;
    /**
     * @return AbstractField
     */
    abstract  public function columns();

    public function actions(){
        return [];
    }


    public function filter(Builder $builder, $request, $filters){

        $this->request = $request;

        $this->updatesQueryString = array_merge($this->updatesQueryString,$request->query());
        //INICIA O FILTRO
        if ($this->searchEnabled && in_array($this->search_query,array_keys($this->updatesQueryString)) && !empty(trim($this->updatesQueryString[$this->search_query]))) {

            $builder->where(function (Builder $builder) {

                foreach ($this->columns() as $column) {

                    if ($column->searchable) {
                        if (is_callable($column->searchCallback)) {

                            $builder = app()->call($column->searchCallback, ['builder' => $builder, 'term' => $this->updatesQueryString[$this->search_query]]);

                        } elseif (Str::contains($column->name, '.')) {

                            $relationship = $this->relationship($column->name);

                            $builder->orWhereHas($relationship->attribute, function (Builder $builder) use ($relationship) {

                                $builder->where($relationship->attribute, 'like', '%'.$this->updatesQueryString[$this->search_query].'%');

                            });

                        } else {
                            $builder->where($builder->getModel()->getTable().'.'.$column->name, 'like', '%'.$this->updatesQueryString[$this->search_query].'%');

                        }
                    }

                }
            });
        }
        //FINALIZA O FILTRO

        $this->sortField = $this->getUpdatesQueryString('column', 'created_at');

        $this->sortDirection = $this->getUpdatesQueryString('direction', 'desc');

        if (Str::contains($this->sortField, '.')) {

            $relationship = $this->relationship($this->sortField);

            $sortField = $this->attribute($builder, $relationship->attribute, $relationship->attribute);

        } else {

            $sortField = sprintf('%s.%s',$this->getTable(),$this->sortField);

        }

        if (($column = $this->getColumnByAttribute($this->sortField)) !== null && is_callable($column->sortCallback)) {

            return app()->call($column->sortCallback, ['builder' => $builder, 'direction' => $this->sortDirection]);

        }

        if($this->paginationEnabled):
            $results = $builder->orderBy($sortField, $this->sortDirection)->paginate($this->getUpdatesQueryString($this->perPageName),["*"], $this->pageName);
        else:
            $results = $builder->orderBy($sortField, $this->sortDirection)->get();
        endif;

        $this->getActionsAttributes();

        $this->getAttrByAttribute();

        if($results){
            $this->getAttrResultByAttribute($results);
            $this->getAttrSourceAttribute($results);
        }
        $this->getOptionsAttributes();

        return [
            'columns'=>$this->columns,
            'source'=>$this->sources,
            'actions'=>$this->actions,
            'options'=>$this->options,
            'data'=>$this->data,
        ];
    }

    private function getUpdatesQueryString($key, $default=null){

        if(isset($this->updatesQueryString[$key]))
            return $this->updatesQueryString[$key];

        return $default;
    }
}
