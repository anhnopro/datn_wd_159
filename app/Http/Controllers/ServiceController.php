<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('landlord_admin.pages.service.index', compact('services'));
    }

    public function create()
    {
        return view('landlord_admin.pages.service.add');
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate(
            [
                'service_type' => 'required|string|max:255',
                'electric' => 'required|numeric|min:0',
                'water' => 'required|numeric|min:0',
                'wifi' => 'required|numeric|min:0',
                'garbage' => 'required|numeric|min:0',
                'other' => 'nullable|numeric|min:0',
            ],
            [
                // Thông báo lỗi cụ thể cho từng trường
                'service_type.required' => 'Vui lòng nhập tên dịch vụ.',
                'service_type.string' => 'Tên dịch vụ phải là chuỗi ký tự.',
                'service_type.max' => 'Tên dịch vụ không được vượt quá 255 ký tự.',
                
                'electric.required' => 'Vui lòng nhập giá điện.',
                'electric.numeric' => 'Giá điện phải là số.',
                'electric.min' => 'Giá điện phải lớn hơn hoặc bằng 0.',
                
                'water.required' => 'Vui lòng nhập giá nước.',
                'water.numeric' => 'Giá nước phải là số.',
                'water.min' => 'Giá nước phải lớn hơn hoặc bằng 0.',
                
                'wifi.required' => 'Vui lòng nhập giá wifi.',
                'wifi.numeric' => 'Giá wifi phải là số.',
                'wifi.min' => 'Giá wifi phải lớn hơn hoặc bằng 0.',
                
                'garbage.required' => 'Vui lòng nhập giá vệ sinh.',
                'garbage.numeric' => 'Giá vệ sinh phải là số.',
                'garbage.min' => 'Giá vệ sinh phải lớn hơn hoặc bằng 0.',
                
                'other.numeric' => 'Dịch vụ khác phải là số.',
                'other.min' => 'Giá dịch vụ khác phải lớn hơn hoặc bằng 0.',
            ]
        
        
    );
    
        // Lấy user_id từ Auth và lưu dữ liệu
        $data = $request->all();
        $data['user_id'] = Auth::id();
    
        Service::create($data);
    
        return redirect()->route('landlord_admin.service.list')
            ->with('success', 'Dịch vụ đã được tạo thành công!');
    }



    public function show($id)
    {
        $service = Service::findOrFail($id);
        return response()->json($service);
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('landlord_admin.pages.service.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'service_type' => 'required|string|max:255',
                'electric' => 'required|numeric|min:0',
                'water' => 'required|numeric|min:0',
                'wifi' => 'required|numeric|min:0',
                'garbage' => 'required|numeric|min:0',
                'other' => 'nullable|numeric|min:0',
            ],
            [
                // Thông báo lỗi cụ thể cho từng trường
                'service_type.required' => 'Vui lòng nhập tên dịch vụ.',
                'service_type.string' => 'Tên dịch vụ phải là chuỗi ký tự.',
                'service_type.max' => 'Tên dịch vụ không được vượt quá 255 ký tự.',
                
                'electric.required' => 'Vui lòng nhập giá điện.',
                'electric.numeric' => 'Giá điện phải là số.',
                'electric.min' => 'Giá điện phải lớn hơn hoặc bằng 0.',
                
                'water.required' => 'Vui lòng nhập giá nước.',
                'water.numeric' => 'Giá nước phải là số.',
                'water.min' => 'Giá nước phải lớn hơn hoặc bằng 0.',
                
                'wifi.required' => 'Vui lòng nhập giá wifi.',
                'wifi.numeric' => 'Giá wifi phải là số.',
                'wifi.min' => 'Giá wifi phải lớn hơn hoặc bằng 0.',
                
                'garbage.required' => 'Vui lòng nhập giá vệ sinh.',
                'garbage.numeric' => 'Giá vệ sinh phải là số.',
                'garbage.min' => 'Giá vệ sinh phải lớn hơn hoặc bằng 0.',
                
                'other.numeric' => 'Dịch vụ khác phải là số.',
                'other.min' => 'Giá dịch vụ khác phải lớn hơn hoặc bằng 0.',
            ]
        );
        

        $service = Service::findOrFail($id);
        $service->update($request->all());

        return redirect()->route('landlord_admin.service.list')->with('success', 'Dịch vụ đã được cập nhật thành công!');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete(); // Thực hiện xóa dịch vụ

        return redirect()->route('landlord_admin.service.list')->with('success', 'Dịch vụ đã được xóa thành công!');
    }
}