<link rel="stylesheet" href="{{URL::asset('hiddenform.css')}}">
<div>
    <form action="{{route('main.search')}}" id="datepicker" method="POST">
        @csrf
        <label>Start Date
            <input name="startDate" id="startDate" onchange="setMinEnd()" type="date" value="{{$startDate}}">
        </label>
        <label >End date
            <input name="endDate" onchange="(()=>{document.getElementById('datepicker').submit()})()" id="endDate" type="date" value="{{$endDate}}"  readonly >
        </label>
    </form>

    <table >
        <tr>
            <th>License plate of car</th>
            <th>Daily Price</th>
        </tr>
        @foreach ($cars as $item)
        <tr onclick="unhide('{{$item->license_plate}}','{{$item->daily_price}}', '{{$startDate??'2000-01-01'}}','{{$endDate??'2000-01-02'}}' )">
            <td >{{$item->license_plate}}</td>
            <td>{{$item->daily_price}}</td>
            
        </tr>
        
        @endforeach

    </table>
    <div id="userdata" class="hdfor-cont">

        <form action="{{route('main.rentpoint')}}" method="POST" class="hdfor" >
            @csrf
            <div id="form-head"></div>
            <label for="name" >
                Name
            </label>
            <input type="text" id="name" name="name" required>

            <label for="email" >
                Email
            </label>
            <input type="email" id="email" name="email" required>

            <label for="address">
                Address
            </label>
            <input type="text" id="address" name="address" required>

            <label for="phone">
                Phone number
            </label>
            <input type="phone" id="phone" name="phone" required>

            <label for="numberOdays">
                Number of Days
            </label>
            <input type="number" id="numberOdays" readonly>

            <label for="price">
                Summarized price
            </label>
            <input type="number" id="price" readonly>

            <button type="submit">Rent</button>
            <button type="reset" onclick="hide()">Back</button>
            <input type="text" name="license_plate" id="license_plate" hidden>
            <input type="date" name="start_date" id="start_date" hidden>
            <input type="date" name="end_date" id="end_date" hidden>
        </form>
    </div>
    
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
<script src="{{URL::asset('js/formlogic.js')}}"></script>
<script>

    var mindate = new Date().toLocaleDateString('fr-ca');
    document.getElementById("startDate").min=mindate;
    document.getElementById("endDate").min=mindate;
    function setMinEnd() {
        let new_min= document.getElementById("startDate").value;
        document.getElementById("startDate").readOnly = true;
        document.getElementById("endDate").min=new_min;
        document.getElementById("endDate").value=new_min;
        document.getElementById("endDate").readOnly=false;
        document.getElementById("endDate").showPicker();
        document.getElementById("endDate").focus();
    }
</script>
