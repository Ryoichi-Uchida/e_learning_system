{{-- I will display avatar only in the activity area of Dashboard  --}}
@if (Request::url() == 'http://localhost:8080/home')
    <div class="bg-white border p-3 m-3">
        <div class="row">
            <div class="col-2">
                <img src="/images/default.png" alt="" class="avatar">
            </div>
            <div class="col-10">
                <a href=""><h4>Ryo</h4></a>
                <h4>Following Yuki</h4>
                <p>2 days ago</p>
            </div>
        </div>
    </div>   
@else
    <div class="bg-white border p-3 m-3">
        <h4>Following Yuki</h4>
        <p>2 days ago</p>
    </div>
@endif

