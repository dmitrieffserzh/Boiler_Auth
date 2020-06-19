<?php

namespace App\Http\Controllers;

use App\Models\Modules\TNParse\TNParse;
use App\Models\Modules\TNParse\TNParseSubProduct;
use Illuminate\Http\Request;

class SearchController extends Controller
{




    public function search(Request $request) {

        if ($request->ajax() && $request->isMethod('post')) {

            $result = TNParseSubProduct::where('name', '=', $request->search)->get();
            return $result->toJson();

        } else {
            abort(404);
        }

    }

}
