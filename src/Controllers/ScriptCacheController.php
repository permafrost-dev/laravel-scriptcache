<?php

namespace Permafrost\ScriptCache\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ScriptCacheController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function storeData(Request $request)
    {
        $data = $request->input(['data']);
        $data = preg_replace('~[^a-zA-Z0-9_:\{\},\[\]\"\r\n\t\s]+~', '', $data);

        $tempid = uniqid('sc', true);

        cache()->put($request->user()->id ?? '0'.$tempid, $data, 60);

        return response()->json([
           'cache_id'=>$tempid,
            'ttl'=>60,
        ]);
    }

    public function retrieveData(Request $request, $token)
    {
        $data = null;
        $found = false;

        if ($token[0].$token[1] !== 'sc' || strpos($token, '.') === false) {
            return response()->json([
                'found'=>false,
               'cache_id'=>null,
               'data'=>null,
            ]);
        }

        if (cache()->has($request->user()->id ?? '0'.$token)) {
            $found = true;
            $data = cache()->get($request->user()->id ?? '0'.$token);
        }

        return response()->json([
            'found'=>$found,
           'cache_id'=>$token,
           'data'=>$data,
        ]);
    }
}
