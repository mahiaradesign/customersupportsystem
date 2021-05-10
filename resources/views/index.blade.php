@include('includes.htmlhead')
@include('includes.navbar')

<div class="redirect_link">
    <a href="/login">Admin/Exceutive Login</a>
</div>
{{-- If got success --}}
@if($message=Session::get('fdbk_succes'))
    <div class="popup success">
        <i class="fa fa-check-circle main-icon" aria-hidden="true"></i>
        <p>{{$message}}</p>
        <i class="fa fa-times close" aria-hidden="true"></i>
    </div>
@endif

{{-- If got Failure --}}
@if($message=Session::get('already_fdbk'))
    <div class="popup danger">
        <i class="fa fa-exclamation-circle main-icon" aria-hidden="true"></i>
        <p>{{$message}}</p>
        <i class="fa fa-times close" aria-hidden="true"></i>
    </div>
@endif
@if($message=Session::get('inactive'))
    <div class="popup danger">
        <i class="fa fa-exclamation-circle main-icon" aria-hidden="true"></i>
        <p>{{$message}}</p>
        <i class="fa fa-times close" aria-hidden="true"></i>
    </div>
@endif
<script src="/js/executive/assigned_task.js"></script>
@include('includes.footer')
@include('includes.htmlend')