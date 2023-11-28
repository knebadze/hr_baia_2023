<?php

namespace App\Repositories\Admin\Testimonial;

use App\Models\Testimonial;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TestimonialRepository
{
    function save($data) {
        $item = $data['data'];
        $testimonial = new Testimonial();

        $this->fillTestimonial($testimonial, $item);

        if (isset($data['file']) && $data['file'] instanceof UploadedFile) {
            $filePath = $this->uploadImage($data['file']);
            $testimonial->image_path = $filePath;
        }else{
            $testimonial->image_path = 'testimonial/default.jpg';
        }
        $testimonial->save();

        return $testimonial;
    }

    function update($data) {
        $item = $data['data'];
        $testimonial = Testimonial::find($item->id);
        $this->fillTestimonial($testimonial, $item);
        if (isset($data['file'])) {
            $this->deleteImage($testimonial->image_path);
        }

        if (isset($data['file']) && $data['file'] instanceof UploadedFile) {
            $filePath = $this->uploadImage($data['file']);
            $testimonial->image_path = $filePath;
        }

        $testimonial->update();
    }

    protected function fillTestimonial(Testimonial $testimonial, $item)
    {
        $testimonial->fullName_ka = $item->fullName_ka;
        $testimonial->fullName_en = $item->fullName_en; // Fixed typo in property name
        $testimonial->fullName_ru = $item->fullName_ru;
        $testimonial->profession_ka = $item->profession_ka;
        $testimonial->profession_en = $item->profession_en;
        $testimonial->profession_ru = $item->profession_ru;
        $testimonial->text_ka = $item->text_ka;
        $testimonial->text_en = $item->text_en;
        $testimonial->text_ru = $item->text_ru;
        $testimonial->is_active = $item->is_active;
    }

    protected function uploadImage(UploadedFile $file)
    {
        return $file->store('testimonial', 'public');
    }

    protected function deleteImage($filePath)
    {
        // Delete the old image from storage
        Storage::disk('public')->delete($filePath);
    }
}


