<?php

namespace app\core\utility;

use app\core\http\Request;

/**
 *
 * @author Agbeja Oluwatobiloba <tobiagbeja4 at gmail.com>
 */
trait ImageUploadTrait
{
    private $tmp_dir;
    private $tmp_dir_route;
    private $upload_dir;
    private $image_model;
    private $image_model_foreign_key;

    /**
     * @param Request $request
     */
    public function ajaxUploadImage(Request $request)
    {
        $files = $request->allFiles();
        if (!empty($files)) {
            foreach ($files as $key => $file) {
                $name = time() . '.' . $file->guessClientExtension();
                $path = $this->generateUrl($this->tmp_dir_route, ['name' => $name]);
                $file->move($this->tmp_dir, $name);
                $image = $this->image_model::create([
                    'name' => $name,
                    'path' => $path,
                    'size' => $file->getClientSize(),
                    'mimeType' => $file->getClientMimeType(),
                    'type' => $request->type,
                    $this->image_model_foreign_key => 1
                ]);
                echo json_encode([
                    'id' => $image->id,
                    'name' => $name,
                    'path' => $path
                ]);
                die;
            }
        }
        echo json_encode(['message' => 'files empty']);
        die;
    }

    public function ajaxDeleteImage(Request $request, $id)
    {
        $image = $this->image_model::find($id);
        if (unlink('C:/wamp/www' . $image->path)) {
            $image->delete();
            echo json_encode(['message' => 'image deleted']);
            die;
        }
        echo json_encode(['message' => 'something went wrong']);
        die;
    }

}