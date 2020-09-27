<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Support\Acl\Models;

use Call\Models\AbstractModel;
use Illuminate\Database\Eloquent\Model;
use Call\Support\Acl\Concerns\HasPermissions;
use Call\Support\Acl\Contracts\Role as RoleContract;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

abstract class AbstractRole extends AbstractModel implements RoleContract
{
    use HasPermissions;

    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'special'];

    /**
     * Create a new Role instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('acl.tables.roles'));
    }

    public function getAttributeSlug($value){

        $this->slug = Str::slug($this->name);
    }

    public function getAccessAttribute()
    {

        return $this->permissions()->pluck(  'name','id');
    }

    public function access()
    {

        return $this->permissions();
    }


    /**
     * Roles can belong to many users.
     *
     * @return Model
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(config('auth.model') ?: config('auth.providers.users.model'))->withTimestamps();
    }

    /**
     * Determine if role has permission flags.
     *
     * @return bool
     */
    public function hasPermissionFlags(): bool
    {
        return ! is_null($this->special);
    }

    /**
     * Determine if the requested permission is permitted or denied
     * through a special role flag.
     *
     * @return bool
     */
    public function hasPermissionThroughFlag(): bool
    {
        if ($this->hasPermissionFlags()) {
            return ! ($this->special === 'no-access');
        }

        return true;
    }
}
