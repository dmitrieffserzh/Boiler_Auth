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


        $result = array();

        if ($request->ajax() && $request->isMethod('post')) {

            if ($request->hasFile('file')) {

                $file = $request->file('file');
                $file_puth = $file->move(public_path('uploads'), time() . '_' . $file->getClientOriginalName());

                $handle = fopen($file_puth, 'r');
                while (($data = fgetcsv($handle, '', '|')) !== FALSE) {

//print_r($data);
                    if (isset($data[1]))
                        if (mb_detect_encoding($data[1], 'auto') != 'UTF-8') {
                            $data[1] = iconv('cp866', 'UTF-8', trim($data[1]));
                        }




                    if (isset($data[2]))
                        if (mb_detect_encoding($data[2], 'auto') != 'UTF-8') {
                            $data[2] = iconv('cp866', 'UTF-8', trim($data[2]));
                        }
                    if (isset($data[3]))
                        if (mb_detect_encoding($data[3], 'auto') != 'UTF-8') {
                            $data[3] = iconv('cp866', 'UTF-8', trim($data[3]));
                        }
                    if (isset($data[4]))
                        if (mb_detect_encoding($data[4], 'auto') != 'UTF-8') {
                            $data[4] = iconv('cp866', 'UTF-8', trim($data[4]));
                        }
                    if (isset($data[5]))
                        if (mb_detect_encoding($data[5], 'auto') != 'UTF-8') {
                            $data[5] = iconv('cp866', 'UTF-8', trim($data[5]));
                        }

                    echo "<strong style='color: #83a6f7;'>" . $data[0] . "</strong>   <strong>" . $data[1] . "</strong>";
                    echo "<p style='color: #a3a3a5;border-bottom: 1px Dashed #e6e6e6;padding: 0 0 1rem;'>" . $data[2] . $data[3] ."</p>";

                }

                fclose($handle);

            }

        } else {
            abort(404);
        }

    }

}