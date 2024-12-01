<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use App\Models\Room;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Storage;

class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();

        return view('landlord_admin.pages.room.index', compact('rooms'));
    }

    public function create()
    {
        // $categories = Category::all(); // Lấy danh sách danh mục
        $services = Service::all(); // Lấy danh sách dịch vụ
        return view('landlord_admin.pages.room.add', compact( 'services'));
    }

    public function store(Request $request)
    {

        // Xác thực dữ liệu đầu vào
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'area' => 'required',
                'service_id' => 'required|exists:services,id',
                'images' => 'required', // Thêm validate tổng thể cho images
                'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // Xác thực từng ảnh trong mảng
                'description' => 'required',
                'address' => 'required',
                'price' => 'required|numeric',
            ],
            [
                'name.required' => 'Bạn phải nhập tên phòng trọ',
                'area.required' => 'Bạn hãy nhập kích thước phòng trọ',
                'service_id.required' => 'Bạn phải lựa chọn dịch vụ phòng trọ',
                'price.required' => 'Bạn phải nhập giá phòng trọ',
                'price.numeric' => 'Bạn phải nhập giá là số',
                'address.required' => 'Bạn phải nhập địa chỉ phòng trọ',
                'description.required' => 'Bạn phải nhập mô tả',
                'images.required' => 'Bạn phải chọn ít nhất một ảnh',
                'images.*.image' => 'Tệp được tải lên phải là hình ảnh',
                'images.*.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc webp',
                'images.*.max' => 'Hình ảnh không được vượt quá 2MB',
            ]
        );


           $id_user=User::get()->role;
        $mainImagePath = null;

        if ($request->hasFile('images')) {
            $images = $request->file('images');


            $firstImage = $images[0];
            $mainImagePath = $firstImage->store('rooms', 'public'); // Lưu ảnh đầu tiên vào thư mục 'rooms' trong 'public'


            $room = Room::create([
                'name' => $request->name,
                // 'category_id' => $categoryId,
                'service_id' => $request->service_id,
                'address' => $request->address,
                'description' => $request->description,
                'price' => $request->price,
                'area' => $request->area,
                'user_id' => $id_user,
                'status' => 1,
                'image' => $mainImagePath, // Ảnh đầu tiên được lưu ở đây
            ]);


            // Kiểm tra nếu phòng được tạo thành công
            if (!$room) {
                return redirect()->back()->withErrors(['error' => 'Không thể tạo phòng.']);
            }

            // Lưu tất cả ảnh vào bảng `galleries`
            foreach ($images as $image) {
                $imagePath = $image->store('rooms', 'public'); // Lưu từng ảnh vào thư mục 'rooms' trong 'public'

                Gallery::create([
                    'room_id' => $room->id,
                    'image' => $imagePath,
                ]);
            }
        } else {
            return redirect()->back()->withErrors(['images' => 'Hình ảnh là bắt buộc.']);

        }

        // Chuyển hướng với thông báo thành công
        return  redirect()->route('landlord_admin.room.list')->with('success', 'Thêm thành công dữ liệu nhật phòng thành công!');
    }


    public function edit($id)
    {
        $room = Room::findOrFail($id);
        // $categories = Category::all(); // Lấy danh sách danh mục
        $services = Service::all(); // Lấy danh sách dịch vụ
        return view('landlord_admin.pages.room.edit', compact('room', 'services'));
    }

    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required',
            'service_id' => 'required|exists:services,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Xác thực từng ảnh trong mảng images
            'description' => 'required|string',
            'address' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        // Tìm phòng
        $room = Room::findOrFail($id);

        // Cập nhật thông tin cơ bản
        $room->update([
            'name' => $request->name,
            'service_id' => $request->service_id,
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->price,
            'area' => $request->area,
            'status' => $request->status ?? true,
        ]);


        // Xử lý cập nhật ảnh
        if ($request->hasFile('images')) {
            // Xóa ảnh cũ trong bảng `galleries` và thư mục lưu trữ
            foreach ($room->galleries as $gallery) {
                if (FacadesStorage::exists('public/' . $gallery->image)) {
                    FacadesStorage::delete('public/' . $gallery->image);
                }
                $gallery->delete();
            }

            // Lưu ảnh mới
            $images = $request->file('images');
            foreach ($images as $index => $image) {
                $imagePath = $image->store('rooms', 'public');

                // Nếu là ảnh đầu tiên, cập nhật làm ảnh chính của phòng
                if ($index === 0) {
                    $room->update(['image' => $imagePath]);
                }

                // Lưu ảnh vào bảng `galleries`
                Gallery::create([
                    'room_id' => $room->id,
                    'image' => $imagePath,
                ]);
            }
        }


        return redirect()->route('landlord_admin.room.list')->with('success', 'Cập nhật phòng thành công!');
    }


    public function destroy($id)
    {
        try {
            $room = Room::findOrFail($id); // Tìm phòng theo ID

            // Xóa phòng
            $room->delete();

            // Chuyển hướng với thông báo thành công
            return redirect()->route('landlord_admin.room.list')->with('success', 'Xóa phòng thành công!');
        } catch (\Exception $e) {
            // Chuyển hướng với thông báo lỗi
            return redirect()->route('landlord_admin.room.list')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }
}
