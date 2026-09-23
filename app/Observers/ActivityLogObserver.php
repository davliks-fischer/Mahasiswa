<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class ActivityLogObserver
{
    public function created(Model $model): void
    {
        ActivityLog::create([
            'user_id'    => Auth::id(),
            'aksi'       => 'Menambah ' . class_basename($model) . ' #' . $model->getKey(),
            'route'      => optional(request()->route())->getName(),
            'detail'     => ['data_baru' => $model->getAttributes()],
            'ip_address' => request()->ip(),
        ]);
    }

    public function updated(Model $model): void
    {
        $sesudah = $model->getChanges();
        unset($sesudah['updated_at']);

        if (empty($sesudah)) {
            return;
        }

        $sebelum = [];
        foreach ($sesudah as $field => $nilaiBaru) {
            $sebelum[$field] = $model->getOriginal($field);
        }

        ActivityLog::create([
            'user_id'    => Auth::id(),
            'aksi'       => 'Mengubah ' . class_basename($model) . ' #' . $model->getKey(),
            'route'      => optional(request()->route())->getName(),
            'detail'     => ['sebelum' => $sebelum, 'sesudah' => $sesudah],
            'ip_address' => request()->ip(),
        ]);
    }
}