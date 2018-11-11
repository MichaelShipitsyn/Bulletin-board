<ul class="nav nav-tabs mb-3">
    <li class="nav-item"><a class="nav-link{{ $page === '' ? ' active' : '' }}" href="{{ route('admin.home') }}">Dashboard</a></li>
    @can ('manage-adverts')
        <li class="nav-item"><a class="nav-link{{ $page === 'adverts' ? ' active' : '' }}" href="{{ route('admin.adverts.index') }}">Adverts</a></li>
    @endcan
    @can ('manage-banners')
        <li class="nav-item"><a class="nav-link{{ $page === 'banners' ? ' active' : '' }}" href="{{ route('admin.banners.index') }}">Banners</a></li>
    @endcan
    @can ('manage-regions')
        <li class="nav-item"><a class="nav-link{{ $page === 'regions' ? ' active' : '' }}" href="{{ route('admin.regions.index') }}">Regions</a></li>
    @endcan
    @can ('manage-users')
        <li class="nav-item"><a class="nav-link{{ $page === 'users' ? ' active' : '' }}" href="{{ route('admin.users.index') }}">Users</a></li>
    @endcan
</ul>