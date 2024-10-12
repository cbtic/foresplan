<?php

namespace App\Domains\Auth\Models\Traits\Scope;

/**
 * Class RoleScope.
 */
trait EmpresaScope
{
    /**
     * @param $query
     * @param $term
     *
     * @return mixed
     */
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('nombre_comercial', 'like', '%'.$term.'%')
                ->orWhere('razon_social', 'like', '%'.$term.'%');
        });
    }
}
