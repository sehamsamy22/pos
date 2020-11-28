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
                    <a href="{{route('dashboard.settings.index')}}" >
                        <i class="zmdi zmdi-settings">
                        </i>
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
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-layers"></i><span> إداره التصنيفات  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.categories.index')}}"><i class="zmdi zmdi-view-list"></i>  التصنيفات الرئيسة    </a></li>
{{--                        <li><a href="{{route('dashboard.categories.create')}}"> <i class="zmdi zmdi-format-playlist-add"></i>إضافة  تصنيف رئيسى     </a></li>--}}
                        <li><a href="{{route('dashboard.subcategories.index')}}"><i class="zmdi zmdi-view-list"></i>عرض   التصنيفات الفرعية    </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-pizza"></i><span>إدارة الأصناف و المنتجات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.products.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  الأصناف</a></li>
                        <li><a href="{{route('dashboard.meals.index')}}"><i class="zmdi zmdi-view-list"></i>عرض المنتجات </a></li>
                        <li><a href="{{route('dashboard.stores.index')}}"><i class="zmdi zmdi-view-list"></i>عرض المخزون </a></li>
                        <li><a href="{{route('dashboard.stores.purchase_order')}}"><i class="zmdi zmdi-view-list"></i> طلبية شراء المخزن </a></li>
                        <li><a href="{{route('dashboard.stores.cooker_view')}}"><i class="zmdi zmdi-view-list"></i>   استلام الكميات وتجهيز الوجبات </a></li>
                        <li><a href="{{route('dashboard.stores.operarion_manger_view')}}"><i class="zmdi zmdi-view-list"></i>   استلام الوجبات  وتوزعها</a></li>
                        <li><a href="{{route('dashboard.stores.driver_manger_view')}}"><i class="zmdi zmdi-view-list"></i>      توزيع الوجبات للسائقين</a></li>

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span>إدارة العملاءوالاشتركات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.clients.index')}}">عرض العملاء     </a></li>
                        <li><a href="{{route('dashboard.measurements.index')}}">إضافة وتعديل دليل القياسات     </a></li>
                        <li><a href="{{route('dashboard.subscriptions.index')}}"> إضافة وتعديل   الاشتركات    </a></li>
                        <li><a href="{{route('dashboard.clients_subscriptions.index')}}">عرض  اشتركات   العملاء    </a></li>
                        <li><a href="{{route('dashboard.visits.index')}}">عرض  سجل زيارات   العملاء    </a></li>
                        <li><a href="{{route('dashboard.types_meal.index')}}">عرض انواع  الوجبات    </a></li>


                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-shopping-cart"></i><span>إدارة المشتريات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.suppliers.index')}}"><i class="zmdi zmdi-view-list"></i>عرض الموردين     </a></li>
                        <li><a href="{{route('dashboard.purchases.index')}}"><i class="zmdi zmdi-view-list"></i>عرض المشتريات     </a></li>

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-shopping-basket"></i><span>نقاط البيع</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li ><a href="{{route('dashboard.sales.index')}}" ><i class="zmdi zmdi-view-list  open-left"></i>عرض فواتير المبيعات     </a></li>
                    </ul>
                </li>



                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-share"></i><span>إدارةالدليل المحاسبى  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.accounts.index')}}"><i class="zmdi zmdi-view-list"></i>عرض   الدليل المحاسبى     </a></li>

                        <li><a href="{{route('dashboard.entries.index')}}"><i class="zmdi zmdi-view-list"></i>  عرض القيود </a></li>

                    </ul>
                </li>


            <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-settings"></i><span>إدارة الاعدادات  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.settings.index')}}"><i class="zmdi zmdi-view-list"></i>عرض    الاعدادات     </a></li>

                    </ul>
            </li>


               <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-money-box"></i><span>إدارة المدفوعات والسندات  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.revenues.index')}}"><i class="zmdi zmdi-view-list"></i>عرض    المدفوعات     </a></li>

                    </ul>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
