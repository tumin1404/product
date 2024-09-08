<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.page.category',compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
        ]);

        // Kiểm tra và tạo thư mục upload/categories nếu chưa tồn tại
        if (!file_exists(public_path('upload/categories'))) {
            mkdir(public_path('upload/categories'), 0777, true);
        }

        // Xử lý lưu ảnh vào thư mục upload/categories
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('upload/categories'), $imageName);

        // Lưu dữ liệu vào bảng categories
        Category::create([
            'name' => $request->name,
            'image' => '/upload/categories/' . $imageName,
            'description' => $request->description,
        ]);

        // Chuyển hướng về trang danh mục với thông báo thành công
        return redirect()->route('admin.category')->with('success', 'Danh mục đã được thêm mới thành công.');
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        // Log dữ liệu từ request
        \Log::info('Dữ liệu nhận được từ form:', $request->all());
        // Tìm danh mục theo ID
        $category = Category::findOrFail($id);

        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cập nhật dữ liệu
        $category->name = $request->name;
        $category->description = $request->description;

        // Kiểm tra xem có tải lên ảnh mới không
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/categories'), $imageName);

            // Xóa ảnh cũ nếu có
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $category->image = 'upload/categories/' . $imageName;
        }

        // Lưu dữ liệu và log kết quả
        if ($category->save()) {
            \Log::info('Cập nhật danh mục thành công:', ['id' => $category->id]);
            return response()->json(['success' => true, 'message' => 'Cập nhật danh mục thành công!']);
        } else {
            \Log::error('Cập nhật danh mục thất bại:', ['id' => $category->id]);
            return response()->json(['success' => false, 'message' => 'Cập nhật danh mục thất bại!']);
        }
    }

    public function delete()
}
