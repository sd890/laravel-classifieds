@extends('web.profile.layout.site')
@section('content')
<main class="main-content">
    <div class="card">
        <div class="card-body">
            <h3>تایید موبایل</h3>
            <p>لطفاً کد ارسال شده به موبایل خود را وارد کنید:</p>

            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ route('sms.verify.post') }}">
                @csrf
                <div class="form-group">
                    <label for="code">کد تایید</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">تایید مویایل</button>
            </form>
        </div>
    </div>
</main>
@endsection
