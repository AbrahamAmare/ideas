<div class="card overflow-hidden">
    <div class="card-body pt-3">
        <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
            <li class="nav-item">
                <a class="{{ Route::is('dashboard') ? 'text-white bg-primary rounded' : '' }} nav-link text-dark"
                    href="{{ route('dashboard') }}">
                    <span>Home</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Explore</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('feed') ? 'text-white bg-primary rounded' : '' }}"
                    href="{{ route('feed') }}">
                    <span>Feed</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Terms</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Support</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <span>Settings</span></a>
            </li>
        </ul>
    </div>
    <div class="card-footer text-center py-2">
        <a class="btn btn-link btn-sm" href="{{ route('profile') }}">View Profile </a>
    </div>

    <hr>
    <h3>Language</h3>
    <a class="btn btn-link btn-sm" href="{{ route('lang', 'en') }}">English</a>

    <a class="btn btn-link btn-sm" href="{{ route('lang', 'es') }}">Spanish</a>
    <a class="btn btn-link btn-sm" href="{{ route('lang', 'am_ET') }}">Amharic</a>
</div>
