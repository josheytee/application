<?php


namespace app\core\view\form;


class File extends FormChildren
{
    public $uploadUrl;
    public $deleteUrl;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->setTemplate('form/file');
    }

    public function assign()
    {
        return parent::assign() + [
                'uploadUrl' => $this->uploadUrl,
                'deleteUrl' => $this->deleteUrl
            ];
    }
}
