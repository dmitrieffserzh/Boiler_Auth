<?php
/**
 * Created by PhpStorm.
 * User: dmitriev
 * Date: 16.08.2019
 * Time: 11:25
 */

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TNParseController extends Controller
{

    public function index()
    {
        return view('modules.TNParse.index');
    }


    public function upload(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {

            if ($request->hasFile('file')) {

                $file1 = $request->file('file_1');
                $file2 = $request->file('file_2');
                $file3 = $request->file('file_3');
                $file4 = $request->file('file_4');
                //$file_puth = $file->move(public_path('uploads'), time() . '_' . $file->getClientOriginalName());

                $handle = fopen($file1, 'r');
                $result_file_1 = array();
                $counter = 0;
                while (($data = fgetcsv($handle, '', '|')) !== FALSE) {
                    $counter++;
                    if ($counter == 1) {
                        continue;
                    }

                    foreach ($data as $key => $value) {
                        if (mb_detect_encoding($value, 'auto') != 'UTF-8') {
                            $data[$key] = iconv('cp866', 'UTF-8', $value);
                        }
                    }

                    echo "<strong style='color: #83a6f7;'>" . $data[0] . "</strong>   <strong>" . $data[1] . "</strong>";
                    echo "<p style='color: #a3a3a5;border-bottom: 1px Dashed #e6e6e6;padding: 0 0 1rem;'>" . $data[2] . $data[3] . "</p>";
                    array_pop($data);
                    $result_file_1[] = $data;
                }

                fclose($handle);
                dd($result_file_1);
            }

        } else {
            abort(404);
        }

    }

}