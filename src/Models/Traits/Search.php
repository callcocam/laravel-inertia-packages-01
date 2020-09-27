<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models\Traits;


trait Search
{
    /**
     * updatesQueryString.
     */

    /**
     * Whether array de filters.
     *
     * @var array
     */
    protected $updatesQueryString = [];
    /**
     * Search.
     */

    /**
     * Whether or not searching is enabled.
     *
     * @var bool
     */
    public $searchEnabled = true;

    /**
     * false = disabled
     * int = Amount of time in ms to wait to send the search query and refresh the table.
     *
     * @var int
     */
    public $searchDebounce = 350;

    /**
     * Whether or not to disable the search bar when it is searching/loading new data.
     *
     * @var bool
     */
    public $disableSearchOnLoading = true;

    /**
     * The initial search string.
     *
     * @var string
     */
    public $search_query = 'search';

    /**
     * The placeholder for the search box.
     *
     * @var string
     */
    public $searchLabel;

    /**
     * The message to display when there are no results.
     *
     * @var string
     */
    public $noResultsMessage;

}
