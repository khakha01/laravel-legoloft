@extends('admin.layout.layout')
@Section('title', 'Admin | Liên hệ')
@Section('content')

    <div class="container-fluid">

        <div class="searchAdmin">
            <form id="filterFormContact" action="{{ route('contact.filter') }}" method="GET">
                @csrf
                <div class="row d-flex flex-row justify-content-between align-items-center">
                    <div class="col-12">
                        <div class="form-group mt-3">
                            <label for="title" class="form-label">Trạng thái</label>
                            <select class="form-select rounded-0" aria-label="Default select example" name="filter_status">
                                <option value="">Tất cả</option>
                                <option value="1" {{ request('filter_status') == '1' ? 'selected' : '' }}>Đã phản hồi
                                </option>
                                <option value="0" {{ request('filter_status') == '0' ? 'selected' : '' }}>Chưa phản hồi
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end align-items-end">
                    <button type="submit" class="btn border-0 rounded-0 text-light my-3" style="background: #4099FF">
                        <i class="fa-solid fa-filter pe-2" style="color: #ffffff;"></i>Lọc liên hệ
                    </button>
                </div>
            </form>

        </div>

        <form id="submitFormAdmin">
            @csrf
            <div class="buttonProductForm mt-3">
                <div class="">
                    @if (session('error'))
                        <div id="alert-message" class="alertDanger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div id="alert-message" class="alertSuccess">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="">
                    <button class="btn btnF2" type="button"
                        onclick="deleteAllContact('{{ route('deleteContactAdmin') }}')"><i class="pe-2 fa-solid fa-trash"
                            style="color: #ffffff;"></i>Xóa
                        phản hồi
                    </button>
                </div>

            </div>

            <div class="border p-2 mt-3">
                <h4 class="my-2"><i class="pe-2 fa-solid fa-list"></i>Danh sách khách hàng gửi liên hệ</h4>
                <table class="table table-bordered  pt-3">
                    <thead class="table-header">
                        <tr class="">
                            <th class=" py-2"></th>
                            <th class=" py-2">Người gửi</th>
                            <th class=" py-2">Email</th>
                            <th class=" py-2">Ngày gửi</th>
                            <th class=" py-2">Trạng thái</th>
                            <th class=" py-2">Hành động</th>

                        </tr>
                    </thead>

                    <tbody class="table-body">
                        @foreach ($contact as $ct)
                            <tr class="">
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <input type="checkbox" id="cbx_{{ $ct->id }}" class="hidden-xs-up"
                                            name="contact_id[]" value="{{ $ct->id }}">
                                        <label for="cbx_{{ $ct->id }}" class="cbx"></label>
                                    </div>
                                </td>
                                <td>{{ $ct->name }}</td>
                                <td>{{ $ct->email }}</td>
                                <td>{{ $ct->created_at }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            data-id="{{ $ct->id }}" id="switch-{{ $ct->id }}"
                                            {{ $ct->status == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="switch-{{ $ct->id }}">{{ $ct->status == 1 ? 'đã phản hồi' : 'chưa phản hồi' }}</label>
                                    </div>

                                </td>
                                <td class="m-0 p-0">
                                    <div class="actionAdminProduct m-0 py-3">
                                        <button class="btnActionProductAdmin2"><a
                                                href="{{ route('contactMail', $ct->id) }}"
                                                class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                    style="color: #ffffff;"></i>Gửi phản hồi</a></button>
                                    </div>
                                    <div class="actionAdminProduct m-0 py-3">
                                        <button class="btnActionProductAdmin2"><a
                                                href="{{ route('contactEdit', $ct->id) }}"
                                                class="text-decoration-none text-light"><i class="pe-2 fa-solid fa-pen"
                                                    style="color: #ffffff;"></i>Xem phản hồi</a></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <nav class="navPhanTrang">
                    {{-- {{ $comments->links() }} --}}
                </nav>
            </div>
        </form>

    </div>


@endsection

@section('contactAdminScript')
    <script>
        function deleteAllContact(url) {
            const selectedContacts = document.querySelectorAll('input[name="contact_id[]"]:checked');
            if (selectedContacts.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Cảnh báo!',
                    text: 'Vui lòng chọn ít nhất một liên hệ để xóa.',
                    confirmButtonText: 'Đồng ý',
                    width: '450px',
                    confirmButtonColor: "#3085d6"

                });
                return;
            }
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa liên hệ không?",
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
    <script>
        $(document).ready(function() {
            $('.form-check-input').on('click', function() {
                var contact_id = $(this).data('id'); // Lấy ID bài viết
                var status = $(this).is(':checked') ? 1 : 0; // Xác định trạng thái
                var label = $(this).siblings('label'); // Lấy label liền kề
                updateContactStatus(contact_id, status, label);
            });
        });
        // yeu cau thang cho kha viet js dang hoang!!!!
        function updateContactStatus(contact_id, status, label) {
            $.ajax({
                url: '{{ route('updateContactStatus', ':id') }}'.replace(':id', contact_id),
                type: 'PUT',
                data: {
                    '_token': '{{ csrf_token() }}', // CSRF token
                    'status': status
                },
                success: function(response) {
                    if (response.success) {
                        // Cập nhật trạng thái
                        label.text(status == 1 ? 'đã phản hồi' : 'chưa phản hồi');
                    }
                },
                error: function(error) {
                    console.error('Lỗi khi cập nhật trạng thái bài viết: ', error);
                    alert('Có lỗi xảy ra. Vui lòng thử lại!');
                }
            });
        }
    </script>


    {{-- <script>
        $(document).ready(function() {
            $('#filterFormComment').on('submit', function() {
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('
                   searchComment ') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('.table-body').html(response.html);
                    },
                    error: function(error) {
                        console.error('Lỗi khi lọc' + error);
                    }
                })
            })
        })
    </script>  --}}
@endsection
