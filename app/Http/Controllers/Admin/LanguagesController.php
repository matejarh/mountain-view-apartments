<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    public function compare(string $lang1, string $lang2 ): JsonResponse
    {
        $path = base_path() . '\lang';

        $file1 = $lang1 . '.json';
        $file2 = $lang2 . '.json';

        $lang1Json = json_decode(
            file_get_contents("$path/$file1"),
            true
        );
        $lang2Json = json_decode(
            file_get_contents("$path/$file2"),
            true
        );

        $diffkeys = array_diff_key($lang1Json, $lang2Json);

        return response()->json($diffkeys, 200);
    }
}
