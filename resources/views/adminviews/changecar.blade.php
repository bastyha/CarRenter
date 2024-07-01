<div>
    
    <table >
        <tr>
            <th>License plate of car</th>
            <th>Daily Price</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($cars as $item)
        <tr >
            <form action="{{route('admin.changecar')}}" method="post">
                @csrf
                <td><input type="text" id="license_plate" name="license_plate" value="{{$item->license_plate}}" required readonly></td>
                <td><input type="number" name="daily_price" onchange="showButtons('{{$item->license_plate}}')" value="{{$item->daily_price}}" required min="10"></td>
                <td>
                    <button type="submit" hidden class="button-{{$item->license_plate}}">Change</button>
                </td>
                <td>
                    <button type="reset" hidden class="button-{{$item->license_plate}}" onclick="hidebuttons('{{$item->license_plate}}')">Reset</button>
                </td>
            </form>
            
        </tr>
        
        @endforeach
    </table>
    
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

<script>
    function showButtons(license_plate){
        for(item of document.getElementsByClassName("button-"+license_plate)){
           item.hidden=false;            
        }

    }
    function hidebuttons(license_plate){
        for(item of document.getElementsByClassName("button-"+license_plate)){
           item.hidden=true;
        }
    }
</script>