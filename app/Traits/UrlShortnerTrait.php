<?php
namespace App\Traits;

use App\Models\UrlShorters;

trait UrlShortnerTrait
{

    public function generateShortUrl($longUrl)
    {
        if (!filter_var($longUrl, FILTER_VALIDATE_URL)) {
            return 'Invalid URL';
        }

        $existingUrl = UrlShorters::where(['original_url' => $longUrl])->first();
        if (!empty($existingUrl)) {
            return $existingUrl->short_url;
        }

        $shortUrl = $this->generateUniqueShortUrl();
        $storeData = UrlShorters::insert(['short_url'=> $shortUrl, 'original_url' => $longUrl]);
        if(!$storeData) {
            return 'this url can not be stored as short url';
        }
        return $shortUrl;
    }

    private function generateUniqueShortUrl() {
        do {
            $id = random_int(1, PHP_INT_MAX);
            $shortUrl = $this->base62Encode($id);
            $exstData = UrlShorters::where(['short_url' => $shortUrl])->get();
        } while (count($exstData) > 0);

        return $shortUrl;
    }

    public function redirectFromShortToLongUrl($shortUrl)
    {
         $originalUrl = UrlShorters::where(['short_url' => $shortUrl])->first()->original_url;

        if ($originalUrl) {
            header("Location: $originalUrl", true, 301);
            exit;
        } else {
            // Handle invalid short URL, e.g., 404 Not Found
            header("HTTP/1.0 404 Not Found");
            exit;
        }
    }


    private function base62Encode($num) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $base = strlen($chars);
        $str = '';

        while ($num > 0) {
            $rem = $num % $base;
            $str = $chars[$rem] . $str;
            $num = floor($num / $base);
        }

        return $str;
    }
}

?>
