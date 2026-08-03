@extends('web.profile.layout.site')
@section('content')
<main class="main-content">
    <div class="card">
        <div class="card-body">
            <h3>تایید ایمیل</h3>
            <p>لطفاً کد ارسال شده به ایمیل خود را وارد کنید:</p>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('email.verify.post') }}">
                @csrf
                <div class="form-group">
                    <label for="code">کد تایید</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">تایید ایمیل</button>
            </form>
        </div>
    </div>
</main>
@endsection
