<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ResourceNews;
use App\Http\Controllers\Controller;
use App\Services\ParserXmlService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ParserController extends Controller
{
    public function __invoke(ParserXmlService $service)
    {
        $resources = ResourceNews::URLS;
        foreach ($resources as $resource) {
            dd($service->setUrl($resource)->parsing());
        }
    }

}
