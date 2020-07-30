<form action="{{ $actionUrl }}" method="POST">

    @csrf

    <label>種別</label>
    {{ $inquiryTypes[old('type')] }}
    <input type="hidden" name="type" value="{{ old('type') }}">

    <br><br>

    <label>氏名</label>
    {{ old('name') }}
    <input type="hidden" name="name" value="{{ old('name') }}">

    <br><br>

    <label>メールアドレス</label>
    {{ old('email') }}
    <input type="hidden" name="email" value="{{ old('email') }}">

    <br><br>

    <label>本文</label>
    {!!  nl2br(e(old('body'))) !!}
    <input type="hidden" name="body" value="{{ old('body') }}">

    <br><br>

    <input type="submit" name="actionType" value="return">
    <input type="submit" name="actionType" value="send">

</form>

