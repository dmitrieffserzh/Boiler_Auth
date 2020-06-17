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


    public function upload(Request $request)
    {
        if ($request->ajax() && $request->isMethod('post')) {


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

                    DB::beginTransaction();

                    try {
                        $section = new TNParseSection();
                        $section->section = (int)$data[0];
                        $section->name = $data[1];
                        $section->note = $data[2];
                        $section->start_date = $data[3];
                        $section->end_date = $data[4] ? $data[4] : '';
                        $section->save();

                    } catch (ValidationException $e) {
                        DB::rollback();
                        echo $progress['error'][] = "<div>Ошибка! Не удалось выполнить транзакцию!</div>";
                    }

                }

                fclose($handle);


                // 2 FILE
                $test = TNParseSection::all();


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
                        $group->name = $data[1];
                        $group->note = $data[2];
                        $group->start_date = $data[3];
                        $group->end_date = $data[4] ? $data[4] : '';
                        $group->save();


                    } catch (ValidationException $e) {
                        DB::rollback();
                        echo $progress['error'][] = "<div>Ошибка! Не удалось выполнить транзакцию!</div>";
                    }

                }


            }


        } else {
            abort(404);
        }

    }
}
