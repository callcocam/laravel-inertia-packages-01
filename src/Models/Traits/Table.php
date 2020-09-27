<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;


trait Table
{
    protected $actions=[];
    protected $options = [];
    protected $striped      = true;     //	Boolean		Add a stripes effect.	false
    protected $hover        = true;     //	Boolean		Change effect hover and flat.	false
    protected $bordered     = false;     //	px		Change the high maximum of the table, generating the scroll.	false
    protected $borderless   = true;    //	Boolean		Determines if multiple items can be selected.	false
    protected $outlined     = true;     //	Boolean		Eliminates the space between each tr.	false
    protected $small        = true;     //	Boolean		Determine if the filtering functionality through an input is active.	false
    protected $dark         = false;     //	Boolean		Determine if the page is active so that only a certain number of items can be displayed.	false
    protected $fixed        = false;      //	Number		Change the maximum number of items that can be displayed when the page is active.	5
    protected $footClone    = true;     // (vs-tr)	Boolean		Determine the state of the element with a color.
    protected $headVariant  = null;   // (vs-th)	String		Determine the value to be raffled and if this activates that functionality.
    protected $tableVariant = '';   // (vs-th)	String		Determine the value to be raffled and if this activates that functionality.
    protected $noCollapse   = false;        //	String		Change the text of the notification when there is no data in the table.


    /**
     * @return $this
     */
    protected function getOptionsAttributes(){

        $this->options = [
            'redirect_url'          => $this->refresh(null),
            'create_url'            => $this->create_url(null),
            'current_name'          => $this->index_route_name(null),
            'striped'               => $this->striped,
            'bordered'              => $this->bordered,
            'borderless'            => $this->borderless,
            'outlined'              => $this->outlined,
            'small'                 => $this->small,
            'hover'                 => $this->hover,
            'dark'                  => $this->dark,
            'fixed'                 => $this->fixed,
            'footClone'             => $this->footClone,
            'headVariant'           => $this->headVariant,
            'tableVariant'          => $this->tableVariant,
            'noCollapse'            => $this->noCollapse
        ];

        return $this;
    }


    /**
     * @return $this
     */
    protected function getActionsAttributes(){
        $actions = [];

        if($this->actions()){
            foreach ($this->actions() as $action) {

                $actions[] = [
                    'text'       => $action->text,
                    'icon'       => $action->icon,
                    'name'       => $action->name,
                    'route'      => $action->route,
                    'message'    => $action->message,
                    'default'    => $action->default,
                ];

            }
        }
        $this->actions = $actions;

        return $this;
    }
}
