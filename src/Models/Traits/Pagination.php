<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;


trait Pagination
{
    /**
     * Pagination.
     */

    /**
     * Displays per page and pagination links.
     *
     * @var bool
     */
    public $paginationEnabled = true;

    /**
     * Whether or not the per page checker is visible
     * Can have pagination on with the per page off.
     *
     * @var bool
     */
    public $perPageEnabled = true;

    /**
     * The options to limit the amount of results per page.
     *
     * @var array
     */
    public $perPageOptions = [10, 25, 50];


    /**
     * The label for the per page filter.
     *
     * @var string
     */
    public $perPageLabel;


    /**
     * The label for the per page filter.
     *
     * @var string
     */
    public $perPageName = "per_page";

    /**
     * The label for the per page filter.
     *
     * @var string
     */
    public $pageName = "page";

    /**
     * https://laravel-livewire.com/docs/pagination
     * Resetting Pagination After Filtering Data.
     */
    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function resetPage()
    {
        $this->updatesQueryString[$this->pageName] = 1;
    }
}
