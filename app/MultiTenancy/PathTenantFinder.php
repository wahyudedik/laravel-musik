<?php

namespace App\MultiTenancy;

use App\Models\Tenant;

use Illuminate\Http\Request;
use Spatie\Multitenancy\TenantFinder\TenantFinder;

class PathTenantFinder extends TenantFinder
{
    public function findForRequest(Request $request): ?Tenant
    {
        $path = $request->path();
        $segments = explode('/', $path);
        
        if (empty($segments[0])) {
            return null;
        }
        
        $tenantId = $segments[0];
        
        // Langsung cek tenant berdasarkan custom field - misalnya 'path_id'
        return Tenant::where('path_id', $tenantId)->first();
    }
}
