<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1>Halo, {{ auth()->user()->name }}</h1>
        </div>
        <div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger">
                Logout
            </a>
        </div>
    </div>
    <p>Selamat datang di halaman dashboard member!</p>
</div>