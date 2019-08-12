<?php

use Permafrost\ScriptCache\Controllers\ScriptCacheController;

Route::prefix('/api/scriptcache')->group(static function () {
    Route::get('/{token}', [ScriptCacheController::class, 'retrieveData'])->where(['token'=>'[0-9a-zA-Z_\.\-]+']);
    Route::get('/', [ScriptCacheController::class, 'storeData']);
});
