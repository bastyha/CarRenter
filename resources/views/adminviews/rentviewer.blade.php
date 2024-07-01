<div>
    <table>
        <tr>
            <th>Car's license plate</th>
            <th>Borrower's email</th>
            <th>Start of rent</th>
            <th>End of rent</th>
        </tr>
        @foreach ($rents as $item)
            <tr>
                <td>{{$item->license_plate}}</td>
                <td>{{$item->renter_email}}</td>
                <td>{{$item->rent_start}}</td>
                <td>{{$item->rent_end}}</td>
            </tr>
        @endforeach
    </table>

</div>
