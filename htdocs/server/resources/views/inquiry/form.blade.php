<form action="{{ $actionUrl }}" method="POST">

    @csrf

    <input type="text" name="name" value="{{ old('name') }}">
    <textarea name="body" >{{ old('body') }}</textarea>

    <input type="submit" name="actionType" value="confirm">

</form>
