<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use App\Models\Post;
use App\Models\ProjectNews;


class PostController extends Controller
{
    //
    public function create() {
        return view('cabinet.post.create');
    }

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

    public function index() {
        $posts = DB::table('project_news')->get();

        return view('cabinet.post.index', compact('posts'));
    }

/*добавила */
    public function destroy(Request $request, ProjectNews $post)
    {
        //dd($request, $post);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Пост удален');

    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('cabinet.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }
}
