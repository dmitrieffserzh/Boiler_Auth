<?php
/**
 * Created by PhpStorm.
 * User: dmitriev
 * Date: 16.08.2019
 * Time: 11:25
 */

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\Modules\TNParse\TNParseGroup;
use App\Models\Modules\TNParse\TNParseProduct;
use App\Models\Modules\TNParse\TNParseSubProduct;
use App\Models\Modules\TNParse\TNParseSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use ZipArchive;
use Dotenv\Exception\ValidationException;

class TNParseController extends Controller
{

    public function index()
    {
        return view('modules.TNParse.index');
    }


    public function search(Request $request) {



        if ($request->ajax() && $request->isMethod('post')) {

            $q =$request->get('search');
dd($q);
            $result = TNParseSubProduct::where('name' ,'=', $q)->first();
            //dd($result);





        return  $result; //response()->json($result);
        }



    }



    public function upload(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {

            ini_set('max_execution_time', 300);
            $progress = [];

            if ($request->hasFile('file')) {
                // TODO
                // VALIDATE ZIP FILE
                $validator = $request->validate([
                    'file' => 'required|mimes:zip,gzip'
                ]);
                /*
                    return "<div>Ошибка! Не разрешенный тип файла!<br>Для загрузки разрешены только Zip-файлы!</div>";
                */

                echo $progress['success'][] = "<div>Архив загружен...</div>";

                $file = $request->file('file');
                $file_puth = $file->move(public_path('uploads/modules/TNParse'), $file->getClientOriginalName());

                $file_dir = $file_puth->getPath() . '/' . date('dmY_His') . '_' . str_replace('.ZIP', '', $file_puth->getBasename());


                $zip = new ZipArchive;
                $zip->open($file_puth->getLinkTarget());
                $zip->extractTo($file_dir);
                if ($zip->close() == true) {
                    echo $progress['success'][] = "<div>Архив распакован...</div>";
                } else {
                    return $progress['error'][] = "<div>Ошибка! Не удалось распаковать архив!</div>";
                }

                if (unlink($file_puth)) {
                    echo $progress['success'][] = "<div>Архив удален... </div>";
                };

                $file_list = glob($file_dir . "/\*.[tT][xX][tT]");
                if (empty($file_list))
                    echo $progress['error'][] = "<div>Ошибка! Не удалось найти файлы!</div>";

                if (count($file_list) != 4)
                    echo $progress['error'][] = "<div>Ошибка! В архиве недостаточно файлов!</div>";


                // OPEN TRANSACTION
                DB::beginTransaction();

                // 1 FILE
                $handle = fopen($file_list[0], 'r');

                fgetcsv($handle, '', '|');
                while (($data = fgetcsv($handle, '', '|')) !== FALSE) {

                    array_pop($data);
                    foreach ($data as $key => $value) {
                        if (mb_detect_encoding($value) != 'UTF-8') {
                            $data[$key] = iconv('cp866', 'UTF-8', $value);
                        }
                    }

                    try {
                        $section = new TNParseSection();
                        $section->section = (int)$data[0];
                        $section->name = $data[1];
                        $section->note = $data[2];
                        $section->start_date = $data[3];
                        $section->end_date = $data[4] ? $data[4] : null;
                        $section->save();

                    } catch (ValidationException $e) {
                        DB::rollback();
                        echo $progress['error'][] = "<div>Ошибка! Не удалось выполнить транзакцию!</div>";
                    }
                }
                fclose($handle);


                // 2 FILE
                $handle = fopen($file_list[1], 'r');

                fgetcsv($handle, '', '|');
                while (($data = fgetcsv($handle, '', '|')) !== FALSE) {
                    array_pop($data);
                    foreach ($data as $key => $value) {
                        if (mb_detect_encoding($value) != 'UTF-8') {
                            $data[$key] = iconv('cp866', 'UTF-8', $value);
                        }
                    }

                    try {
                        $group = new TNParseGroup();
                        $group->section = (int)$data[0];
                        $group->group = (int)$data[1];
                        $group->name = $data[2];
                        $group->note = $data[3];
                        $group->start_date = $data[4];
                        $group->end_date = $data[5] ? $data[5] : null;
                        $group->save();

                    } catch (ValidationException $e) {
                        DB::rollback();
                        echo $progress['error'][] = "<div>Ошибка! Не удалось выполнить транзакцию!</div>";
                    }
                }
                fclose($handle);


                // 3 FILE
                $handle = fopen($file_list[2], 'r');

                fgetcsv($handle, '', '|');
                while (($data = fgetcsv($handle, '', '|')) !== FALSE) {
                    array_pop($data);
                    foreach ($data as $key => $value) {
                        if (mb_detect_encoding($value) != 'UTF-8') {
                            $data[$key] = iconv('cp866', 'UTF-8', $value);
                        }
                    }

                    try {
                        $product = new TNParseProduct();
                        $product->group = (int)$data[0];
                        $product->product = $data[1];
                        $product->name = $data[2];
                        $product->start_date = $data[3];
                        $product->end_date = $data[4] ? $data[4] : null;
                        $product->save();

                    } catch (ValidationException $e) {
                        DB::rollback();
                        echo $progress['error'][] = "<div>Ошибка! Не удалось выполнить транзакцию!</div>";
                    }
                }
                fclose($handle);


                // 4 FILE
                $handle = fopen($file_list[3], 'r');

                fgetcsv($handle, '', '|');
                while (($data = fgetcsv($handle, '', '|')) !== FALSE) {
                    array_pop($data);
                    foreach ($data as $key => $value) {
                        if (mb_detect_encoding($value) != 'UTF-8') {
                            $data[$key] = iconv('cp866', 'UTF-8', $value);
                        }
                    }

                    try {
                        $sub_product = new TNParseSubProduct();
                        $sub_product->group = (int)$data[0];
                        $sub_product->product = $data[1];
                        $sub_product->sub_product = $data[2];
                        $sub_product->name = $data[3];
                        $sub_product->start_date = $data[4];
                        $sub_product->end_date = $data[5] ? $data[5] : null;
                        $sub_product->save();

                    } catch (ValidationException $e) {
                        DB::rollback();
                        echo $progress['error'][] = "<div>Ошибка! Не удалось выполнить транзакцию!</div>";
                    }
                }
                fclose($handle);

                DB::commit();

                echo $progress['success'][] = "<div>Операция выполнена успешно...</div>";
            }

        } else {
            abort(404);
        }
    }
}
