<?php
namespace Romario25\UploadImage\Services;

class Upload
{

    /**
     * Загрузка файла
     * @param string $url Путь до изображения
     * @param string $path Где сохранять картинку
     * @throws \Exception
     */
    public function uploadFile($url, $path)
    {

        try {
            $fr = fopen($url, 'r');
            $fw = fopen($path, 'w+');

            while (!feof($fr) and $fr) {
                $data = fgets($fr, 2048);
                fwrite($fw, $data);
            }
            fclose($fr);
            fclose($fw);
        } catch (\Exception $e) {
            throw new \Exception("Ошибка при загрузке файла : ".$e->getMessage());
        }
    }

}