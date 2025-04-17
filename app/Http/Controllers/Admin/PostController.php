<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Функция которая создаёт поле для ввода информации о постах в поле администраци(панели)
    public function create() { 
        return view('admin.post.create');
    }
    // Создание правил на проверку информации при вводе(В начале требуется список полей и требования к ним)(Сообщения об ошибках валидации)
    public function store(Request $request){
          Validator::make(
            $request->all(),
            // Валидационные правила
            [
              
                'name' => [
                    'required', 'min:1', 'max:50'
                ],
                'slug' => [
                     'unique:project_news'
                ],
                'date' => [
                    'required', 'date'
                ],
                'description' => [
                    'required', 'min:1', 'max:50'
                ],
                'text' => [
                    'required', 'min:1', 'max:50'
                ],
            ],
            // Сообщения об ошибках валидации
            [
                'name.required' => 'Укажите название статьи',
                'name.min' => 'Поле "Название" должно содержать не менее 1 символа',
                'name.max' => 'Поле "Название" должно содержать не более 50-ти символов',
                
             
                'slug.unique' => 'Поле "Название" должно ,быть уникальным',

                'date.required' => 'Поле "Дата создания статьи" обязательно для заполнения',
                'date.date' => 'В поле "Дата создания статьи" указан неверный формат',
                

                'description.required' => 'Укажите описание статьи',
                'description.min' => 'Поле "Описание статьи" должно содержать не менее 1 символа',
                'description.max' => 'Поле "Описание статьи" должно содержать не более 50-ти символов',
             
                'text.required' => 'Введите текст статьи',
                'text.min' => 'Поле "Текст статьи" должно содержать не менее 1 символа',
                'text.max' => 'Поле "текст статьи" должно содержать не более 50-ти символов',

               
            ]

        )->validate(); 

        // Отправка на сервер
        $insert = DB::table('project_news')->insert([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'date' => $request->date,
            'description' => $request->description,
            'text' => $request->text,
            'created_at' => date('Y-m-d')
        ]);

        if ($insert) {
            return redirect()->back()->with('success', 'Данные успешно добавлены');
        }
    }
    // Открытие формы с данными
    public function index() {
        $posts = DB::table('project_news')->get();    

        return view('admin.post.index', compact('posts'));
    }


}
