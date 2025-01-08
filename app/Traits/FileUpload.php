<?php

namespace App\Traits;

use ReflectionClass;
use Illuminate\Http\Request;

trait FileUpload
{
    public function uploadImages(Request $request, $model)
    {
        if ($request->hasFile('images')) {

            $files = is_array($request->file('images'))
                ? $request->file('images')
                : [$request->file('images')];

            // Create a directory based on model type and ID
            $directory = $this->getBaseClassName($model) . '/' . $model->id;

            foreach ($files as $file) {
                $imageName = time() . '_' . uniqid() . '.' . strtolower($file->getClientOriginalExtension());
                $file->storeAs($directory, $imageName, 'public');

                // Save the file Path in Database
                $model->image()->updateOrCreate(
                    ['imageable_id' => $model->id, 'imageable_type' => get_class($model)],
                    ['path' => $imageName]
                );
            }
        }
    }

    /**
     * Get the base class name in plural lowercase form for the directory.
     *
     * @param mixed $model
     * @return string
     */
    private function getBaseClassName($model)
    {
        $reflect = new ReflectionClass($model);

        // Handle class names ending with 'y'
        if (substr($reflect->getShortName(), -1) === 'y') {
            return strtolower(substr($reflect->getShortName(), 0, -1) . 'ie') . 's';
        }

        return strtolower($reflect->getShortName()) . 's';
    }
}
