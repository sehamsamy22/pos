<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div class="">

            {{--<a href="{{route('admin.layout.main')}}" class="logo-wrapper">--}}

                {{--<img src="{{asset('website/img/logo-sm.png')}}" alt="شعار المشروع" style="background-color: white">--}}
            {{--</a>--}}
        </div>
        <!-- User -->
        <div class="user-box">
            <div class="user-img">
                @php $image = auth()->user()->image; @endphp
                @if($image != null or $image != "")
                    <img src="{{getimg($image)}}" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                    @else
                    <img src="{{asset('admin/assets/images/logo-sm.png')}}" alt="user-img" title="Mat Helme" class="img-circle img-thumbnail img-responsive">
                    @endif

                {{--<div class="user-status offline"><i class="zmdi zmdi-dot-circle"></i></div>--}}
            </div>
            <h5 style="margin-top: 40px;"><a href="#">{{auth()->user()->name}}</a> </h5>
            <ul class="list-inline">
                <li>
                    {{--{{route('user.get.profile')}}--}}
                    <a href="" >
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>

                <li>
                    <a href="#" class="text-custom" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="zmdi zmdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            {{ csrf_field() }}
        </form>
        <!-- End User -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul>
                <li class="text-muted menu-title">القائمة</li>
                <li><a href="{{route('dashboard.index')}}" class="waves-effect"><i class="zmdi zmdi-home"></i><span>الرئيسية</span></a></li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span> المستخدمين </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.users.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  المستخدمين    </a></li>
                        <li><a href="{{route('dashboard.users.create')}}"> <i class="zmdi zmdi-format-playlist-add"></i>إضافة  مستخدم     </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span> إداره التصنيفات  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.categories.index')}}"><i class="zmdi zmdi-view-list"></i>  التصنيفات الرئيسة    </a></li>
{{--                        <li><a href="{{route('dashboard.categories.create')}}"> <i class="zmdi zmdi-format-playlist-add"></i>إضافة  تصنيف رئيسى     </a></li>--}}
                        <li><a href="{{route('dashboard.subcategories.index')}}"><i class="zmdi zmdi-view-list"></i>عرض   التصنيفات الفرعية    </a></li>

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span>إدارة الأصناف و المنتجات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.products.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  الأصناف     </a></li>
                        <li><a href="{{route('dashboard.meals.index')}}"><i class="zmdi zmdi-view-list"></i>عرض المنتجات     </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span>إدارة العملاءوالاشتركات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.clients.index')}}"><i class="zmdi zmdi-view-list"></i>عرض العملاء     </a></li>
                        <li><a href="{{route('dashboard.measurements.index')}}"><i class="zmdi zmdi-view-list"></i>عرض القياسات     </a></li>
                        <li><a href="{{route('dashboard.subscriptions.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  الاشتركات    </a></li>
                        <li><a href="{{route('dashboard.clients_subscriptions.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  اشتركات   العملاء    </a></li>
                        <li><a href="{{route('dashboard.clients_visits.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  سجل زيارات   العملاء    </a></li>

                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span>إدارة المشتريات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.suppliers.index')}}"><i class="zmdi zmdi-view-list"></i>عرض الموردين     </a></li>

                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
