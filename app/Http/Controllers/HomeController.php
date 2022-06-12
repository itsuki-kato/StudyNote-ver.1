<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Text;
use App\Category;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ホーム画面を表示する
     */
    public function index(Request $request)
    {
        // 検索フォームから送信されたキーワードを取得する
        $keyword = $request->input('keyword');
        // dd($keyword);
        // キーワードがあれば検索条件に合った一覧を表示する
        if ($keyword) {
            // dd($keyword);
            $user_id = $request->user()->id;
            $query = Text::query();
            $query
                ->where('text', 'LIKE', "%{$keyword}%");
            $Texts = $query->paginate(2);
        // それ以外だったら全件取得する
        } else {
            $Texts = Text::orderBy('created_at')->paginate(2);
        }

        // 閲覧用のカテゴリ名を取得する。
        $Categories = Category::all();

        return view('home', compact('Texts', 'Categories', 'keyword'));
    }

    /**
     * 新規作成画面を表示する
     */
    public function create()
    {
        $error_messages = '';
        $Categories = Category::all();

        return view('create', compact('Categories', 'error_messages'));
    }

    /**
     * 新規作成
     */
    public function create_new(Request $request)
    {
        $request->validate([
            'text' => 'required'
        ]);
        $Text = new Text;
        $Text->user_id = $request->user()->id;
        $Text->category_id = $request->category;
        $Text->text = $request->text;
        $Text->save();
        return redirect('/home');
    }

    /**
     * 編集画面を表示する
     */
    public function edit($id)
    {
        $Text = Text::find($id);
        // 閲覧用のカテゴリ名を取得する。
        $Categories = Category::all();
        // $Textのcategory_idを取得して、Categoriesテーブルから該当のカテゴリ名を取得する。
        $category_id = $Text->category_id;
        $targetCategory = Category::find($category_id);
        $targetCategoryName = $targetCategory->name;

        return view('edit', compact('Text', 'Categories', 'targetCategoryName'));
    }

    /**
     * 編集内容を保存する
     */
    public function edit_save(Request $request, $id)
    {
        // $mode = $request->input('mode');
        // dd($mode);

        $Text = Text::find($id);
        $Text->user_id = $request->user()->id;
        $Text->category_id = $request->category;
        $Text->text = $request->text;
        $Text->save();

        return redirect('/home');
    }

    /**
     * 削除する。
     */
    public function delete($id)
    {
        $Text = Text::find($id);
        $Text->delete();

        return redirect('/home');
    }
}
