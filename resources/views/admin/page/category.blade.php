@extends('admin.layout')
@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h1 class="text-center my-4">Quản lý danh mục</h1>
<button type="button" class="btn mb-2 btn-outline-primary" data-toggle="modal" data-target="#defaultModal">
    <span class="fe fe-plus fe-16 mr-2"></span>Thêm mới
</button>
<div class="row">
    <div class="col-md-12 my-4">
      <div class="card shadow">
        <div class="card-body">
          <div class="toolbar">
            <form class="form">
              <div class="form-row">
                <div class="form-group col-3 mr-auto">
                  <label for="search" class="sr-only">Search</label>
                  <input type="text" class="form-control" id="search1" value="" placeholder="Search">
                </div>
              </div>
            </form>
          </div>
          <!-- table -->
          <table class="table table-hover table-bordered border-v">
            <thead class="thead-dark">
              <tr>
                <th>STT</th>
                <th>Tên danh mục</th>
                <th>Ảnh mô tả</th>
                <th>Ghi chú</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="col-3">{{ $category->name }}</td>
                        <td class="col-2"><img class="img-fluid" src="{{ $category->image }}" alt="{{ $category->name }}"></td>
                        <td class="col-5">{{ $category->description }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary editCategoryButton" data-id="{{ $category->id }}"
                               data-toggle="modal" data-target="#modifyModal">Sửa</a>
                            <a href="#" class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                 @endforeach
            </tbody>
          </table>
          <nav aria-label="Table Paging" class="mb-0 text-muted">
            <ul class="pagination justify-content-center mb-0">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
</div> <!-- end section -->

<!-- Modal thêm mới -->
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="defaultModalLabel">Thêm mới</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="categoryForm" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="image">Hình ảnh minh hoạ</label>
                <input type="file" name="image" class="form-control-file" required>
              </div>
              <div class="form-group">
                <label for="description">Ghi chú</label>
                <textarea name="description" class="form-control" rows="4" required></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mx-auto">
            <button type="submit" class="btn btn-outline-primary">Lưu</button>
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal chỉnh sửa -->
<div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="modifyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modifyModalLabel">Chỉnh sửa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="categoryForm" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" id="edit-name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="image">Hình ảnh minh hoạ</label>
                <input type="file" name="image" id="edit-image" class="form-control-file">
                <!-- Hiển thị ảnh hiện tại -->
                <img id="current-image" src="" alt="Current Image" style="max-width: 100px; margin-top: 10px; display: none;">
              </div>
              <div class="form-group">
                <label for="description">Ghi chú</label>
                <textarea name="description" id="edit-description" class="form-control" rows="4" required></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="mx-auto">
            <button type="submit" class="btn btn-outline-primary">Lưu</button>
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Thoát</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các nút "Sửa" có class .editCategoryButton
    const editButtons = document.querySelectorAll('.editCategoryButton');

    // Thêm sự kiện click cho từng nút "Sửa"
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Lấy ID từ thuộc tính data-id
            const id = this.getAttribute('data-id');
            console.log('id của dữ liệu là: ' + id);
            
            // Gửi Ajax request để lấy thông tin danh mục
            fetch(`/admin/category/${id}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Dữ liệu danh mục:', data);

                    // Điền dữ liệu vào các ô input trong modal
                    document.querySelector('#modifyModal input[name="name"]').value = data.name;
                    document.querySelector('#modifyModal textarea[name="description"]').value = data.description;

                    // Hiển thị ảnh xem trước nếu có
                    const imageContainer = document.querySelector('#modifyModal input[name="image"]').parentNode;
                    const existingImage = imageContainer.querySelector('img');
                    if (existingImage) {
                        existingImage.remove();
                    }

                    if (data.image) {
                        const imagePreview = document.createElement('img');
                        imagePreview.src = data.image;
                        imagePreview.alt = 'Hình ảnh hiện tại';
                        imagePreview.style.width = '100px';
                        imagePreview.style.marginTop = '10px';
                        imageContainer.appendChild(imagePreview);
                    }
                    // Thiết lập hành động submit cho form để gửi request cập nhật
                    document.getElementById('categoryForm').action = `/admin/category/update/${id}`; // Đổi URL cho form submit
                })
                .catch(error => console.error('Error fetching category data:', error));
        });
    });

    // Bắt sự kiện submit của form để log dữ liệu
    const categoryForm = document.getElementById('categoryForm');
    categoryForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Ngăn form submit để kiểm tra dữ liệu

        // Lấy các giá trị từ form
        const name = document.querySelector('#modifyModal input[name="name"]').value;
        const description = document.querySelector('#modifyModal textarea[name="description"]').value;
        const imageInput = document.querySelector('#modifyModal input[name="image"]');
        const image = imageInput.files.length > 0 ? imageInput.files[0] : null;

        // Log các dữ liệu đã sửa
        console.log('Dữ liệu đã chỉnh sửa:');
        console.log('Tên danh mục:', name);
        console.log('Ghi chú:', description);
        if (image) {
            console.log('Hình ảnh mới:', image.name);
        } else {
            console.log('Không có hình ảnh mới được chọn.');
        }

        // Không gửi form đi sau khi log
    });
});

</script>
@endsection