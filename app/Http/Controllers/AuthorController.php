<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // READ処理
    public function index()
    {
        $authors = Author::all();
        // dd($authors);
        return view('index', ['authors' => $authors]);
    }

    public function find()
    {
        return view('find', ['input' => '']);
    }

    public function search(Request $request)
    {
        $author = Author::find($request->input);
        $param = [
            'author' => $author,
            'input' => $request->input
        ];

        return view('find', $param);
    }

    // CREATE処理
    public function add()
    {
        return view('add');
    }

    public function create(AuthorRequest $request)
    {
        $form = $request->all();
        Author::create($form);
        return redirect('/');
    }

    // UPDATE処理
    public function edit(Request $request)
    {
        $author = Author::find($request->id);
        return view('edit', ['form' => $author]);
    }

    public function update(AuthorRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Author::where('id', $request->id)->update($form);
        return redirect('/');
    }

    // DELETE処理
    public function delete(Request $request)
    {
        $author = Author::find($request->id);
        return view('delete', ['form' => $author]);
    }

    public function remove(AuthorRequest $request)
    {
        Author::find($request->id)->delete();
        return redirect('/');
    }
}