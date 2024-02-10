<?php

namespace App\Services;

use App\Models\Image;
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
            $model->images()->delete();
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
}
