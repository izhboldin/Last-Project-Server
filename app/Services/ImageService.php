<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function upload(Model $model, $data, $first = false, $replace = false)
    {
        $images = collect([]);

        if ($first) {
            $data['images'] = [$data['images'][0]];
        }

        if ($replace) {
            foreach ($model->images as $image) {
                $image->delete();
            }
        }

        foreach ($data['images'] as $item) {
            $image = DB::transaction(function () use ($item, $model) {
                $image = $model->images()->create([
                    'path' => $item['file']->hashName()
                ]);
                Storage::disk('public')->put('images/', $item['file']);
                return $image;
            });
            $images->push($image);
        }

        return $images;
    }

    public function delete(Model $model, $data)
    {
        foreach($model->images()->whereIn($data['images'])->get() as $image) {
            $image->delete();
        }
    }
}
