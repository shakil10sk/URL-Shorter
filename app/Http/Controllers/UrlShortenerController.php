<?php

namespace App\Http\Controllers;

use App\Traits\UrlShortnerTrait;
use App\Models\UrlShorters;
use Illuminate\Http\Request;

class UrlShortenerController extends Controller
{
    use UrlShortnerTrait;

    public function convertToShortUrl(Request $request) {
        if(!empty($request->longUrl)) {
            $shortUrl = $this->generateShortUrl($request->longUrl);
            return redirect('/')->with('shortUrl', $shortUrl);
        }
        return redirect('/');
    }

    public function redirectToOriginalUrl($shortUrl)
    {
        $this->redirectFromShortToLongUrl($shortUrl);
    }

}
