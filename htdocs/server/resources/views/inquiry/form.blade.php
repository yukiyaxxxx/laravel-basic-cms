<form action="{{ $actionUrl }}" method="POST">

    @csrf

    <label>種別</label>
    <input type="text" name="type" value="{{ old('type') }}">

    <br><br>

    <label>氏名</label>
    <input type="text" name="name" value="{{ old('name') }}">

    <br><br>

    <label>メールアドレス</label>
    <input type="text" name="email" value="{{ old('email') }}">

    <br><br>

    <label>本文</label>
    <textarea name="body" >{{ old('body') }}</textarea>

    <br><br>

    <input type="submit" name="actionType" value="confirm">

</form>
