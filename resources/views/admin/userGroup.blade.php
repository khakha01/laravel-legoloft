@extends('admin.layout.layout')
@section('title', 'Admin | Nhóm khách hàng')
@section('content')

    <div class="container-fluid">


        <form id="submitFormAdmin">
            @csrf
            <div class="buttonProductForm">
                <div class="m-0 p-0">
                    @if (session('error'))
                        <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="m-0 p-0">
                    <a href="{{ route('userGroupAdd') }}" class="btn btnF1 text-decoration-none text-light">
                        <i class="pe-2 fa-solid fa-plus" style="color: #ffffff;"></i> Tạo Nhóm khách hàng
                    </a>
                    <button class="btn btnF2" type="button"
                        onclick="deleteAllUserGroup('{{ route('userGroupCheckboxDelete') }}')">
                        <i class="pe-2 fa-solid fa-trash" style="color: #ffffff;"></i>Xóa
                    </button>
                </div>

            </div>

            <div class="border p-2">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh Sách Nhóm khách hàng</h4>
                <table class="table table-bordered pt-3">
                    <thead class="table-header">
                        <tr>
                            <th class="py-2">

                            </th>

                            <th class="py-2">Tên Nhóm khách hàng</th>
                            <th class="py-2">Hình ảnh</th>
                            <th class="py-2">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($userGroups as $group)
                            <tr>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <input type="checkbox" id="cbx_{{ $group->id }}" class="hidden-xs-up"
                                            name="userGroup_id[]" value="{{ $group->id }}">
                                        <label for="cbx_{{ $group->id }}" class="cbx"></label>
                                    </div>
                                </td>
                                <td class="nameAdmin">
                                    <p>{{ $group->name }}</p>
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('img/' . $group->image) }}" alt=""
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                </td>
                                <td class="m-0 p-0">
                                    <div class="actionAdminProduct m-0 py-3">
                                        <button class="btnActionProductAdmin2">
                                            <a href="{{ route('userGroupEdit', $group->id) }}"
                                                class="btn btnF1 text-decoration-none text-light">
                                                <i class="pe-2 fa-solid fa-pencil-alt" style="color: #ffffff;"></i> Sửa nhóm
                                                khách hàng
                                            </a>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>

        <nav class="navPhanTrang">
            <ul class="pagination">
                <li></li>
            </ul>
        </nav>
    </div>

    <script>
        document.getElementById('selectAll').onclick = function() {
            let checkboxes = document.querySelectorAll('input[name="userGroup_id[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        };
    </script>
    <script>
        function deleteAllUserGroup(url) {
            const selectedUserGroups = document.querySelectorAll('input[name="userGroup_id[]"]:checked');
            if (selectedUserGroups.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cảnh báo!',
                    text: 'Vui lòng chọn ít nhất một nhóm khách hàng để xóa.',
                    confirmButtonText: 'Đồng ý',
                    width: '400px',
                    confirmButtonColor: "#3085d6"

                });
                return;
            }
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa nhóm khách hàng không?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Tôi đồng ý!",
                cancelButtonText: "không!",
                customClass: {
                    title: 'custom-title-h1' // Thêm lớp tùy chỉnh cho tiêu đề
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    submitForm(url, 'post');
                }
            });
        }
    </script>
@endsection
