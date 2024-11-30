<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Room;
use Illuminate\Http\Request;

class ArticleAdminController extends Controller
{
    public function index () {
        $articles = Article::all();
        
        return view('admin-main.pages.article.index', compact('articles'));
    }
    


    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id); // Tìm phòng theo ID

            // Xóa phòng
            $article->delete();

            // Chuyển hướng với thông báo thành công
            return redirect()->route('admin.article.list')->with('success', 'Xóa phòng thành công!');
        } catch (\Exception $e) {
            // Chuyển hướng với thông báo lỗi
            return redirect()->route('admin.article.list')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function detail($id)
    {
        $article = Article::with(['category', 'room.galleries', 'room.service'])->findOrFail($id);
        

        return view('admin-main.pages.article.detail', compact('article'));
    }
    public function confirm($id){
        $article =Article::findOrFail($id);
        $article->update([
            'status'=> 2
        ]);
        return redirect()->route('admin.article.list')->with('success', 'Duyệt bài thành công!');
    }

}