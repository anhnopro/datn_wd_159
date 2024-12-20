<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Room;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {


        $userId = auth()->id(); // Lấy ID của người dùng đang đăng nhập

        // Thêm điều kiện where để chỉ lấy bài viết thuộc về user đó
        $articles = Article::with(['user', 'room', 'category'])
            ->where('user_id', $userId) // Điều kiện lọc
            ->orderByDesc('id')
            ->paginate(3);

        return view('landlord_admin.pages.article.index', compact('articles'));
    }
    public function create()
    {
        $rooms = Room::all();
        $categories = Category::all();
        return view('landlord_admin.pages.article.add', compact('rooms', 'categories'));
    }
    public function store(Request $request)
    {

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'category_id' => 'required|nullable|exists:categories,id',
                'room_id' => 'required|exists:rooms,id',
                'description' => 'required|string',
                'type' => 'required|in:regular,vip,urgent,free', // Kiểm tra giá trị hợp lệ của type
            ],
            [
                'title.required' => 'Tiêu đề không được để trống.',
                'title.string' => 'Tiêu đề phải là chuỗi ký tự.',
                'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
                'category_id.required' => 'Bạn phải chọn danh mục.',
                'category_id.exists' => 'Danh mục được chọn không tồn tại.',
                'room_id.required' => 'Phòng không được để trống.',
                'room_id.exists' => 'Phòng được chọn không tồn tại.',
                'description.required' => 'Mô tả không được để trống.',
                'description.string' => 'Mô tả phải là chuỗi ký tự.',
                'type.in' => 'Loại tin không hợp lệ.', // Đảm bảo rằng 'type' có giá trị hợp lệ
            ]
        );
        $user = Auth::user();


        // Tạo mới bài viết
        $article = Article::create([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'room_id' => $validatedData['room_id'],
            'description' => $validatedData['description'],
            'status' => 0, // Đặt trạng thái mặc định
            'articles_view' => 0,
            'user_id' => $user->id,
            'type' => $validatedData['type'], // Lưu loại tin vào cơ sở dữ liệu
        ]);

        // Kiểm tra xem bài viết có được tạo thành công không
        if (!$article) {
            return redirect()->back()->withErrors(['error' => 'Không thể thêm bài viết.'])->withInput();
        }

        // Chuyển hướng với thông báo thành công
        return redirect()
            ->route('landlord_admin.article.list')
            ->with('success', 'Thêm bài viết thành công!');
    }


    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Category::all(); // Lấy danh sách danh mục
        $rooms = Room::all(); // Lấy danh sách dịch vụ
        return view('landlord_admin.pages.article.edit', compact('article', 'categories', 'rooms'));
    }
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate(
            [
                'title' => 'required|string|max:255',
                'category_id' => 'nullable|exists:categories,id',
                'room_id' => 'required|exists:rooms,id',
                'description' => 'required|string',
                'type' => 'required|in:regular,vip,urgent,free',  // Xác thực trường 'type'
            ],
            [
                'title.required' => 'Tiêu đề không được để trống.',
                'title.string' => 'Tiêu đề phải là chuỗi ký tự.',
                'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
                'category_id.exists' => 'Danh mục được chọn không tồn tại.',
                'room_id.required' => 'Phòng không được để trống.',
                'room_id.exists' => 'Phòng được chọn không tồn tại.',
                'description.required' => 'Mô tả không được để trống.',
                'description.string' => 'Mô tả phải là chuỗi ký tự.',
                'type.required' => 'Loại bài viết không được để trống.',
                'type.in' => 'Loại bài viết không hợp lệ.',
            ]
        );

        // Tìm bài viết
        $article = Article::findOrFail($id);

        // Cập nhật bài viết
        $article->update([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'room_id' => $validatedData['room_id'],
            'description' => $validatedData['description'],
            'type' => $validatedData['type'],
        ]);

        return redirect()->route('landlord_admin.article.list')->with('success', 'Cập nhật bài viết thành công!');
    }



    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);

            // Xóa phòng
            $article->delete();

            // Chuyển hướng với thông báo thành công
            return redirect()->route('landlord_admin.article.list')->with('success', 'Xóa phòng thành công!');
        } catch (\Exception $e) {
            // Chuyển hướng với thông báo lỗi
            return redirect()->route('landlord_admin.article.list')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
    public function detail($id)
    {
        $article = Article::with(['category', 'room.galleries', 'room.service'])->findOrFail($id);

        return view('landlord_admin.pages.article.detail', compact('article'));
    }
}
