@if(Session::has('message'))
    <div class="container">
        <div class="col-xs-12" style="margin-bottom: 20px;">
            <div class="modal-body bg-info">
                {{Session::get('message')}}
            </div>
        </div>
    </div>
@endif