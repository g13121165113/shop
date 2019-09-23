<?php

namespace App\Http\Middleware;
use DB;
use Closure;
use App\model\centers;

class Center
{
    
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = 1;
        // $id = request()->all();
        $data = centers::where(['id'=>$id])->first()->toArray();
        $request->attributes->add(['data'=>$data]);
        return $next($request);
    }
}
