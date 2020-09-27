<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Models;

use App\Models\Company;
use App\Models\Tenant;
use App\Models\User;
use Call\Models\Components\Traits\WithParameters;
use Call\Models\Traits\Attribute;
use Call\Models\Traits\EditRecord;
use Call\Models\Traits\Foreign;
use Call\Models\Traits\HasScopeGenerate;
use Call\Models\Traits\NewRecord;
use Call\Models\Traits\Pagination;
use Call\Models\Traits\Search;
use Call\Models\Traits\Select;
use Call\Models\Traits\Sorting;
use Call\Models\Traits\Table;
use Call\Scopes\UuidGenerate;
use Call\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class AbstractModel extends Model
{
    use UuidGenerate, Select, Search, Pagination,
        Sorting, Foreign,
        Attribute, Table, HasScopeGenerate,
        EditRecord, NewRecord, SoftDeletes, WithParameters;

    public function getSlugOptions()
    {
        if (is_string($this->slugTo())) {
            if (in_array($this->slugTo(), $this->fillable)) {
                return SlugOptions::create()
                    ->allowDuplicateSlugs()
                    ->generateSlugsFrom($this->slugFrom())
                    ->saveSlugsTo($this->slugTo());
            }
        }
    }

    protected function getComponent(){

        return null;
    }

    protected  function slugTo()
    {
        return "slug";
    }

    protected  function slugFrom()
    {
        return 'name';
    }

    public function tenants(){

        return $this->belongsToMany(Tenant::class)->withTimestamps();
    }

    public function companies(){

        return $this->belongsToMany(Company::class);
    }

    public function users(){

        return $this->belongsToMany(User::class);
    }

    public function pivot($class, $table = null){
        return $this->belongsToMany($class,$table);
    }
}
