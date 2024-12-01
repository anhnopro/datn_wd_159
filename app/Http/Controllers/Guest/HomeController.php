<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        // Lấy các bài viết có category_id bằng $categoryId
        // Lấy các bài viết có category_id = 1 và status = 2, giới hạn 8 bài
        $articlesVip = Article::where('category_id', 1)
            ->where('type', 'urgent')  
            ->limit(8)
            ->get();

        // Lấy các bài viết có status = 2, giới hạn 8 bài và sắp xếp theo articles_view giảm dần
        $articlesHot = Article::where('status', 2)  // Điều kiện lọc theo status = 2
            ->orderBy('articles_view', 'desc') // Sắp xếp theo articles_view giảm dần
            ->limit(8)  // Giới hạn 8 bài
            ->get();


        // Lấy toàn bộ danh mục
        $categories = Category::get();

        return view('pages.guest.home', compact('articlesHot', 'articlesVip', 'categories'));
    }

    public function detail($id)
    {
        $article = Article::find($id);
        $article->increment('articles_view');
        $idRoom = $article->room->id;
        $room = Room::find($idRoom);
        $images = Gallery::where('room_id', $idRoom)->get();
        $articleRecents = Article::orderBy('id', 'desc') // Sắp xếp theo thời gian tạo giảm dần
            ->limit(3)
            ->get();
        $categories = Category::all();

        return view('pages.guest.detail', compact('article', 'room', 'images', 'articleRecents', 'categories'));
    }


    public function filter(Request $request)
    {
        // Lấy thông tin lọc từ request
        $categoryId = $request->get('category_id');
        $priceRange = $request->get('price');
        $address = $request->get('address');

        // Áp dụng logic lọc
        $articles = Article::with('room')
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($priceRange, function ($query, $priceRange) {
                if ($priceRange == 1) {
                    $query->whereHas('room', fn($q) => $q->where('price', '<', 1000000));
                } elseif ($priceRange == 2) {
                    $query->whereHas('room', fn($q) => $q->whereBetween('price', [1000000, 3000000]));
                } elseif ($priceRange == 3) {
                    $query->whereHas('room', fn($q) => $q->where('price', '>', 3000000));
                }
            })
            ->when($address, function ($query, $address) {
                $query->whereHas('room', fn($q) => $q->where('address', 'LIKE', '%' . $address . '%'));
            })
            ->get();

        // Trả về view với kết quả lọc
        return view('pages.guest.filter', compact('articles'));
    }
}
