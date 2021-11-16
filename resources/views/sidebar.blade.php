
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

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

		<!-- Main navigation -->
		<div class="card card-sidebar-mobile">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Menu</div> <i class="icon-menu" title="Main"></i></li>

				<li class="nav-item">
					<a href="{{ url('toko') }}" class="nav-link {{ (request()->is('toko')) ? 'active' : '' }}">
						<i class="fas fa-home"></i>
						<span>
							Dasbor
						</span>
					</a>
				</li>
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Produk</div> <i class="icon-menu" title="Produk"></i></li>
				<li class="nav-item">
					<a href="{{ url('kategori') }}" class="nav-link {{ (request()->is('kategori*')) ? 'active' : '' }}">
						<i class="fas fa-dice-d6"></i>
						<span>
							Kategori
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('produk') }}" class="nav-link {{ (request()->is('produk*')) ? 'active' : '' }}">
						<i class="fas fa-archive"></i>
						<span>
							Produk
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('varian') }}" class="nav-link {{ (request()->is('varian*')) ? 'active' : '' }}">
						<i class="fas fa-columns"></i>
						<span>
							Varian
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('ulasan') }}" class="nav-link {{ (request()->is('ulasan*')) ? 'active' : '' }}">
						<i class="far fa-comment-dots"></i>
						<span>
							Ulasan
						</span>
					</a>
				</li>
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Pendapatan</div> <i class="icon-menu" title="Penjualan"></i></li>
				<li class="nav-item">
					<a href="{{ url('transaksi_pesanan') }}" class="nav-link {{ (request()->is('transaksi_pesanan*')) ? 'active' : '' }}">
						<i class="fas fa-shopping-bag"></i>
						<span>
							Pesanan
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ url('transaksi_penjualan') }}" class="nav-link {{ (request()->is('transaksi_penjualan*')) ? 'active' : '' }}">
						<i class="fas fa-shopping-cart"></i>
						<span>
							Penjualan
						</span>
					</a>
				</li>
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Pengguna</div> <i class="icon-menu" title="Pengguna"></i></li>
				<li class="nav-item">
					<a href="{{ url('users') }}" class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}">
						<i class="fas fa-users"></i>
						<span>
							Pengguna
						</span>
					</a>
				</li>
				<li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Pengaturan</div> <i class="icon-menu" title="Pengaturanx`"></i></li>
				<li class="nav-item">
					<a href="{{ route('toko.create') }}" class="nav-link {{ (request()->is('toko/create')) ? 'active' : '' }}">
						<i class="fas fa-cogs"></i>
						<span>
							Pengaturan
						</span>
					</a>
				</li>
			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->
	
</div>