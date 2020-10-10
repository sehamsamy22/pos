<div class="side-bar right-bar">
    <a href="javascript:void(0);" class="right-bar-toggle">
        <i class="zmdi zmdi-close-circle-o"></i>
    </a>
    <h4 class="">الإشعارات</h4>
    <div class="notification-list nicescroll">
        <ul id="notifyPanel" class="list-group list-no-border user-list">

            {{--@forelse($notifications as $notify)--}}


            {{----}}
            {{--<li class="list-group-item">--}}
                {{--button to delete notification using ajax--}}
                {{--<a href="#" class="">--}}
                    {{--<i class="zmdi zmdi-close-circle-o"></i>--}}
                {{--</a>--}}
                {{--<a href="#" class="user-list-item">--}}
                    {{--<span class="name">{{\App\User::find($notify->user_id)->name}}</span>--}}
                    {{--<div class="avatar">--}}
                        {{--<img src="{{$notify->image}}" alt="">--}}
                    {{--</div>--}}
                    {{--<div class="user-desc">--}}
                        {{--<span class="name">{{$notify->title}}</span>--}}
                        {{--<span class="desc">{{$notify->body}}</span>--}}
                        {{--<span class="time">2 hours ago</span>--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{----}}


            {{--@empty--}}

                {{--<li class="list-group-item">--}}
                    {{--button to delete notification using ajax--}}

                    {{--<a href="#" class="user-list-item">لا يوجد إشعارات جديدة حالياً</a>--}}
                {{--</li>--}}

                {{--@endforelse--}}



            <li class="list-group-item">
                {{--button to delete notification using ajax--}}
                {{--{{route('notifications.index')}}--}}
                <a href="" class="user-list-item">عرض كل الإشعارات</a>
            </li>



        </ul>
    </div>
</div>
