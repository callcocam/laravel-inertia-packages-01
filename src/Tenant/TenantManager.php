<?php
/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */
namespace Call\Tenant;
use App\Models\Tenant as TenantAlias;
use Illuminate\Support\Arr;

class TenantManager
{
    /**
     * @var TenantAlias
     */
    protected $tenant;
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    private $auth;

    /**
     * TenantManager constructor.
     * @param TenantAlias $tenant
     */
    public function __construct(TenantAlias $tenant)
    {
        $this->tenant = $tenant;
    }


    /**
     * @return mixed
     */
    public function hasTenant()
    {

        return $this->tenant->first();
    }


    /**
     * @return mixed
     */
    public function hasTenantUser()
    {
       $user =  $this->tenant->users()->pluck('email','id');
       if(!Arr::exists($user, auth()->id())){
          auth()->guard()->logout();
          return null;
        }
        return $this->tenant;
    }

    public function check($email){
      return $this->tenant->users()->where('email', $email)->count();
    }
}
