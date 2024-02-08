<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function create(Model $model, $data)
    {
        $images = collect([]);
        foreach ($data['images'] as $item) {
            $image = DB::transaction(function () use ($item, $model) {
                $image = $model->images()->create([
                    'path' => $item['file']->hashName()
                ]);
                Storage::disk('public')->put('images/'.$item['file']->hashName(), $item['file']);
                return $image;
            });
            $images->push($image);
        }

        return $images;
    }
}
