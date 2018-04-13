<?php

namespace App\Handlers;

use Image;

class ImageUploadHandler
{
    protected $allow_ext = ['jpg', 'jpeg', 'png', 'gif'];

    public function save($file, $folder, $file_prefix, $max_width = false)
    {
        $folder_name = "uplodes/images/$folder/" . date('Ym', time()) . '/' . date('d', time()) . '/';

        $upload_path = public_path() . '/' . $folder_name;

        $extension = strtolower($file->getClientOriginalExtension()) ? : 'png';

        if (! in_array($extension, $this->allow_ext)) {
            return false;
        }

        $file_name = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;
        $file->move($upload_path, $file_name);

        if ($max_width && $extension != 'gif') {
            $this->reduceSize($upload_path . '/' . $file_name, $max_width);
        }

        return [
            'path' => config('app.url') . "/$folder_name/$file_name"
        ];
    }

    public function reduceSize($file_path, $max_width)
    {
        $image = Image::make($file_path);
        $image->resize($max_width, null, function($constraint) {
            // 设定宽度是 $max_width，高度等比例双方缩放
            $constraint->aspectRatio();

            // 防止裁图时图片尺寸变大
            $constraint->upsize();
        });
        $image->save();
    }

}