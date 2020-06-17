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
use ZipArchive;

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
                // VALIDATE ZIP
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

                foreach ($file_list as $file) {
                    $handle = fopen($file, 'r');
                    $result_file = array();
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
                        $result_file[] = $data;
                    }

                    fclose($handle);
                }


                // dd($file_list);

                /*

                                $handle = fopen($file, 'r');
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


                */


            } else {
                abort(404);
            }

        }
    }

}