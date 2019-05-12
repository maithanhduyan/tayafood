<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Article;
use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Debug\Exception\FatalThrowableError as Exception;

class ArticlesController extends BaseController
{

    public function list(Request $request)
    {
        try {
            $token = $request->header('Authorization');

            $articles = Article::select('id', 'title', 'body', 'created_at', 'updated_at');

            $user = Auth::user();
            //$success['token'] =  $user->createToken('MyApp')->accessToken;

            return Datatables::of($articles)->make()
                ->withHeaders([
                    'Accept' => 'application/json',
                    //'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBhZmRkOTgxZGM4Y2QyNDM5MzQyMDE1NTU2MzljZmUyNTM4YmI4MTY2MWI0OThmY2JhZTFhYzBiYjdlY2NhODJiNTczMTllNDZkZWVkNDRiIn0.eyJhdWQiOiIxIiwianRpIjoiMGFmZGQ5ODFkYzhjZDI0MzkzNDIwMTU1NTYzOWNmZTI1MzhiYjgxNjYxYjQ5OGZjYmFlMWFjMGJiN2VjY2E4MmI1NzMxOWU0NmRlZWQ0NGIiLCJpYXQiOjE1NTc1Nzk5MDQsIm5iZiI6MTU1NzU3OTkwNCwiZXhwIjoxNTg5MjAyMzA0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.uwZuZ2Mfx_8zcIKNRgYzoXra6lLyL98HX56LyBOH-VOiYR3aGu3nhJMIUE6m01NF5RDRqjziM3lWVhBJbbTXUAOa8BZNw3UVVs1ylUua9yiNQy82EAW7mI_pbQjGZAP45hWgQeqanZLRrJqHiLcnkwDSgNp_12U9tN0f3mQ2tgyv48eJnA0ERWgUF4Y7Pps_w7WjSGECeuFSMVPU7Ej5-xNz4rpRo_mRUWvrHldzWw2msp-EWgsag0wCyMfpKlSs6ZYFLAC0RLCyuPnNXLWb_IPO21ExbzoC2oXM2OarjFmQqwoBw5ygPwFU4xaIRX4uMf2KLMFyOmtU5AkNvgjH13EzJUGWj4-FaI0Oo2BagDMs1jjhgHsfgbbzbk_z7KvrmX7IuDVa3pp8xzLtrD7CHPYSOzPjDIjMeIx-WEd7BbzeXjEKguRO1OqFPJc8OQeSIonvb7aM4WMZ05uZAnhhacbsmqK61gWVIGimlsJKqwCWUL7ZoRY0q2JdyYWYUImrawYOXhsmrpJpMz3zzM8A-PKR5yuXzubALyd3B8YOMH2kQ6rsAkbFsRN_gud08uzIJ6yC1siHPxO4nGqxCfUR8zV9iZQzdeDIK4fa6DXG6smdZRRl9mgcBy0ZexyehuPFKdZDtT2go1rDuhmTDca3WeDOA5o5Ibu_x1FVznvIfD0',
                    'Authorization' => $token,
                ]);
            //return $this->sendResponse(Datatables::of($articles)->make(), 'success', $token);
        } catch (Exception $e) {
            return $this->sendError($e, 401);
        }
    }
}
