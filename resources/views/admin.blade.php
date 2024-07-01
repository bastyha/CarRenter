<div>
    <nav>
        
        <a href="{{route('admin')}}/newcar"><div>New Car</div></a>
        <a href="{{route('admin')}}/rentviewer"><div>Rents</div></a>
        <a href="{{route('admin')}}/changecar"><div>Change Car</div></a>
    </nav>
    @includeIf($page)

</div>
