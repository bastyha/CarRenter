<div>
    <form action="{{route("admin.newcar")}}" method="post">
        @csrf
        <label >
            License plate Number
            <input type="text" name="license_plate" required>
        </label>
        <label>
            Daily Price
            <input type="number" name="daily_price" required min="10">
        </label>

        <button type="submit">Add new car</button>
    </form>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
