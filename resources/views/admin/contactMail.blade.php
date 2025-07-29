@extends('admin.layout.layout')
@Section('title', 'Admin | Phản hồi lại mail')
@Section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center  my-3">
            <div class=""></div>
            <a class="text-decoration-none text-light bg-31629e py-2 px-2" href="{{route('contactAdmin')}}">Quay lại</a>
        </div>

        <form action="{{ route('sendReplycontactAdmin', $contact->id) }}" class="formAdmin" method="post" class="mt-5">
            @csrf
            <div class="buttonProductForm">
                <div class="">
                    <h2 class="title-page ">
                        Phản hồi mail </h2>
                </div>
                <div class="">

                </div>
            </div>
            <div class="row mt-3">
                <div class="form-group mt-3">
                    <label for="email" class="form-label">Người nhận</label>
                    <input type="email" class="form-control" name="email" value="{{ $contact->email }}" readonly>
                </div>
                <div class="form-group mt-3">
                    <label for="message" class="form-label">Nội dung phản hồi</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>

            </div> <button type="submit" class="btn btn-primary mt-3">Gửi phản hồi</button>

        </form>
    </div>

@endsection
