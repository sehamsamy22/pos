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
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span> مديرالنظام </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        {{-- ------------------ --}}
                        <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span> المستخدمين </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{route('dashboard.users.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  المستخدمين    </a></li>
                            </ul>
                        </li>
                         <li class="has_sub">
                            <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-layers"></i><span> أعدادات المخزون  </span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="{{route('dashboard.categories.index')}}"><i class="zmdi zmdi-view-list"></i>  التصنيفات الرئيسة    </a></li>
                               {{--   <li><a href="{{route('dashboard.categories.create')}}"> <i class="zmdi zmdi-format-playlist-add"></i>إضافة  تصنيف رئيسى     </a></li>--}}
                                <li><a href="{{route('dashboard.subcategories.index')}}"><i class="zmdi zmdi-view-list"></i>عرض   التصنيفات الفرعية    </a></li>

                            </ul>
                        </li>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-settings"></i><span> أعدادات النظام  </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="{{route('dashboard.measurements.index')}}"> القياسات والاطوال</a></li>
                                    <li><a href="{{route('dashboard.subscriptions.index')}}"> الخطط والاشتراكات</a></li>
                                    <li><a href="{{route('dashboard.types_meal.index')}}">أنواع الوجبات</a></li>
                                    <li><a href="{{route('dashboard.settings.index')}}">الاعدادات العامة</a></li>

                                </ul>
                            </li>

                    </ul>
                </li>



                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-money-box"></i><span> الأدارة المالية  </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.accounts.index')}}"><i class="zmdi zmdi-share"></i> شجره الحسابات </a></li>
                        <li><a href="{{route('dashboard.entries.index')}}"><i class="zmdi zmdi-view-list"></i>   القيوداليومية </a></li>
                        <li><a href="{{route('dashboard.revenues.index')}}"><i class="zmdi zmdi-view-list"></i>   سندات القبض  </a></li>
                    </ul>
                </li>




                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-pizza"></i><span>إدارة المخزون </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.products.index')}}"><i class="zmdi zmdi-view-list"></i>قائمةالأصناف</a></li>
                        <li><a href="{{route('dashboard.meals.index')}}"><i class="zmdi zmdi-view-list"></i>قائمة المنتجات </a></li>
                        <li><a href="{{route('dashboard.stores.index')}}"><i class="zmdi zmdi-view-list"></i>عرض  المخزون </a></li>

         
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-shopping-cart"></i><span>إدارة المشتريات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.suppliers.index')}}"><i class="zmdi zmdi-view-list"></i>قائمة الموردين     </a></li>
                        <li><a href="{{route('dashboard.purchases.index')}}"><i class="zmdi zmdi-view-list"></i>فواتير المشتريات     </a></li>

                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-pizza"></i><span>إدارة العمليات </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.stores.purchase_order')}}"><i class="zmdi zmdi-view-list"></i> طلبية شراء المخزن </a></li>
                        <li><a href="{{route('dashboard.stores.cooker_view')}}"><i class="zmdi zmdi-view-list"></i>     تجهيز وتحضيرالوجبات </a></li>
                        <li><a href="{{route('dashboard.stores.operarion_manger_view')}}"><i class="zmdi zmdi-view-list"></i>   توزيع الوجبات على الاكياس</a></li>
                        <li><a href="{{route('dashboard.stores.driver_manger_view')}}"><i class="zmdi zmdi-view-list"></i>      توزيع الوجبات للسائقين</a></li>

                    </ul>
                </li>


                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-accounts"></i><span> الأشتراكات والعضويات   </span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li><a href="{{route('dashboard.clients.index')}}">  العملاء والمشتركين </a></li>
                        <li><a href="{{route('dashboard.clients_subscriptions.index')}}"> اشتركات العملاء </a></li>
                        <li><a href="{{route('dashboard.visits.index')}}">  سجل زيارات العملاء </a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="zmdi zmdi-shopping-basket"></i><span> إدارة المبيعات</span> <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled">
                        <li ><a href="{{route('dashboard.sales.index')}}" ><i class="zmdi zmdi-view-list  open-left"></i> فواتير المبيعات     </a></li>
                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>

</div>
