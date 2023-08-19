
<h1>Welcome to Dashboard</h1>
<h2>Hi, {{ Auth::user()->name }}</h2>
<h3>Role: {{ Auth::user()->role }}</h3>
<h3>Email: {{ Auth::user()->email }}</h3>
<h3>Created at: {{ Auth::user()->created_at }}</h3>
<a href="{{ route('logout') }}">Logout</a>
