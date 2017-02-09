<?php
namespace Romario25\UploadImage\Services;

class Validator
{

    private $extArray = ['jpg', 'gif', 'png'];
    private $mimeArray = ['image/gif', 'image/jpeg', 'image/png'];

    /**
     * Валидация переданного файла
     * @throws \InvalidArgumentException
     * @param string $file
     */
    public function validateImage($file)
    {

        // validation extensions
        $ext = $this->getFileExt($file);
        if (!in_array($ext, $this->extArray)) {
            throw new \InvalidArgumentException("Неверное расширение файла");
        }

        // validation mime
        $mime = $this->getMimeFile($file);
        dump($mime);
        if (!in_array($mime, $this->mimeArray)) {
            throw new \InvalidArgumentException("Неверный mime тип файла");
        }

        // validation image
        if (false === ($imageInfo = getimagesize($file))) {
            new \InvalidArgumentException("Файл не является изображением");
        }
        list($width, $height) = $imageInfo;
        if ($width == 0 || $height == 0) {
            new \InvalidArgumentException("Файл не является изображением");
        }
    }

    /**
     * Возвращает расширение файла
     * @param string $file
     * @return mixed
     */
    private function getFileExt($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * Возвращает mime файла
     * @param string $file
     * @return string
     */
    private function getMimeFile($file)
    {
        return mime_content_type($file);
    }
}