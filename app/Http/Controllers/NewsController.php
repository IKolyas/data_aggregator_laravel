<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    //
    public function index()
    {
        return view('news', ['newsList' => $this->newsList]);
    }
    public function show(int $id)
    { 
        $news = $this->newsList[$id];
        return "<h2> $news </h2>";
    }
}
