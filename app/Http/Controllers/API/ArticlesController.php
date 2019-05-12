<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Article;
use Yajra\Datatables\Datatables;

class ArticlesController extends Controller
{

    public function list()
    {
        $articles = Article::select('id', 'title', 'body', 'created_at', 'updated_at');

        return Datatables::of($articles)->make();
    }
}
