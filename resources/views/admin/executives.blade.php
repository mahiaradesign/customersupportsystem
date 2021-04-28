@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Users</div>
                    <div class="card-body">
                        @php 
                            $users = DB::table('users')->get(); 
                        @endphp
                        <div class="container">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Last Seen</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                @php $exec=DB::table('executive')->where('executive_id','=',$user->id)->get(); @endphp
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            @if(Cache::has('user-is-online-' . $user->id))
                                                <span class="text-success">Online</span>
                                                @if($user->role == 'executive')
                                                    @php $exec=DB::table('executive')->where('executive_id','=',$user->id)->update(['status'=>'online']); @endphp
                                                @endif
                                            @else
                                                <span class="text-secondary">Offline</span>
                                                @if($user->role == 'executive')
                                                    @php $exec=DB::table('executive')->where('executive_id','=',$user->id)->update(['status'=>'offline']); @endphp
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection