<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Modules\News\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function store(Request $request)
    {
        $news = News::create([
            'title' => $request->title,
        ]);

        return response([
            'news' => $news,
        ], 201);
    }

    public function update(Request $request)
    {
        $updatedNews = News::find(2);

        $updatedNews->title = $request->title;
        $updatedNews->save();

        return response([
            'news' => $updatedNews,
        ], 200);
    }
}
