<?php
namespace Romario25\UploadImage;

use Romario25\UploadImage\Services\Upload;
use Romario25\UploadImage\Services\Validator;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.17
 * Time: 11:28
 */
class UploadImage
{
    private $path;
    private $url;

    private $uploadService;
    private $validateService;

    /**
     * UploadImage constructor.
     * @param string $url Путь до изображения
     * @param string $path Где сохранять картинку
     */
    public function __construct($url, $path)
    {
        $this->path = $path;
        $this->url = $url;
        $this->uploadService = new Upload();
        $this->validateService = new Validator();

        chmod(__DIR__.'/temp', 777);
    }

    /**
     * Загрузчик изображения
     * @throws \Exception
     */
    public function upload()
    {
        // разобьем url строку на массив и вытяним последний элемент
        dump($this->url);
        $arr = explode('/', $this->url);
        $nameFile = end($arr);
        dump($nameFile);
        $this->uploadService->uploadFile($this->url, __DIR__."/temp/".$nameFile);

        // validation temp file
        $this->validateService->validateImage(__DIR__."/temp/".$nameFile);

        // upload в переданную директорию
        $this->uploadService->uploadFile($this->url, $this->path.'/'.$nameFile);

        unlink(__DIR__."/temp/".$nameFile);
    }


}