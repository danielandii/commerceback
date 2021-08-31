<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">
    

<!-- Sidebar mobile toggler -->
<div class="sidebar-mobile-toggler text-center">
    <a href="#" class="sidebar-mobile-main-toggle">
        <i class="icon-arrow-left8"></i>
    </a>
    Navigation
    <a href="#" class="sidebar-mobile-expand">
        <i class="icon-screen-full"></i>
        <i class="icon-screen-normal"></i>
    </a>
</div>
<!-- /sidebar mobile toggler -->


<!-- Sidebar content -->
<div class="sidebar-content">
    
    <!-- User menu -->
    <div class="sidebar-user">
        <div class="card-body">
            <div class="media">
                <div class="mr-3">
                    <a href="#"><img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                </div>

                <div class="media-body">
                    <div class="media-title font-weight-semibold">Victoria Baker</div>
                    <div class="font-size-xs opacity-50">
                        <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                    </div>
                </div>

                <div class="ml-3 align-self-center">
                    <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /user menu -->

    
    <!-- Main navigation -->
    <div class="card card-sidebar-mobile">
        <ul class="nav nav-sidebar" data-nav-type="accordion">

            <!-- Main -->
            <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
            <li class="nav-item">
                <a href="/admin" class="nav-link active">
                    <i class="icon-home4"></i>
                    <span>
                        Dashboard
                        <span class="d-block font-weight-normal opacity-50">No active orders</span>
                    </span>
                </a>
            </li>
            <li class="nav-item nav-item-submenu nav-item-open">
							<a href="#" class="nav-link"><i class="icon-copy"></i> <span>E-Comerce</span></a>

							<ul class="nav nav-group-sub" data-submenu-title="Layouts" style="display: block;">
                                <li class="nav-item"><a href="/useracc" class="nav-link">User</a></li> 
                                <li class="nav-item"><a href="/rekening" class="nav-link">Rekening</a></li> 
								<li class="nav-item"><a href="/produk" class="nav-link">Produk</a></li>
								<li class="nav-item"><a href="/kategori" class="nav-link">Kategori</a></li>
								<li class="nav-item"><a href="/order" class="nav-link">Order</a></li>
								<li class="nav-item"><a href="/transaksi" class="nav-link">Transaksi</a></li>
								<li class="nav-item"><a href="/kirim" class="nav-link">Pengiriman</a></li>
								<li class="nav-item"><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                       
                                         class="nav-link">Register</a></li>  
								<li class="nav-item"><a href="../../../../layout_6/LTR/default/full/index.html" class="nav-link disabled">Layout 6 <span class="badge bg-transparent align-self-center ml-auto">Coming soon</span></a></li>
                                <li class="nav-item"><a href="/tes" class="nav-link">TES</a></li>
							</ul>
						</li>

                        
         
                
        </ul>
    </div>
    <!-- /main navigation -->

</div>
<!-- /sidebar content -->

</div>