<style>
    .error {
        color: #f00;
    }
</style>

<form action="{{ $actionUrl }}" method="POST">

    @csrf

    <label>種別</label>

    @foreach($inquiryTypes as $key => $value)
        <label>
            <input type="radio" name="type" value="{{ $key }}" @if($key == old('type'))  checked @endif>
            {{ $value }}
        </label>
    @endforeach

    {{--    <input type="text" name="type" value="{{ old('type') }}">--}}
    @error('type')
    <p class="error">
        {{ $message }}
    </p>
    @enderror

    <br><br>

    <label>氏名</label>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')
    <p class="error">
        {{ $message }}
    </p>
    @enderror

    <br><br>

    <label>メールアドレス</label>
    <input type="text" name="email" value="{{ old('email') }}">
    @error('email')
    <p class="error">
        {{ $message }}
    </p>
    @enderror

    <br><br>

    <label>本文</label>
    <textarea name="body">{{ old('body') }}</textarea>
    @error('body')
    <p class="error">
        {{ $message }}
    </p>
    @enderror

    <br><br>

    <input type="submit" name="actionType" value="confirm">

</form>
