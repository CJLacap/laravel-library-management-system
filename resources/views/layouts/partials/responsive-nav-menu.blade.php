  <!-- Navigation Admin Links -->

  @if(Auth::user()->role === 'admin')
  <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link   :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
          {{ __('Dashboard') }}
      </x-responsive-nav-link >
  </div>

  <div class="pt-2 pb-3 space-y-1">
      <x-responsive-nav-link  :href="route('librarian.accounts')" :active="request()->routeIs('librarian.accounts')">
          {{ __('Librarian Accounts') }}
      </x-responsive-nav-link >
  </div>

  <!-- Navigation Librarian Links -->

  @elseif(Auth::user()->role === 'librarian')
      <div class="pt-2 pb-3 space-y-1">
          <x-responsive-nav-link  :href="route('librarian.dashboard')" :active="request()->routeIs('librarian.dashboard')">
              {{ __('Dashboard') }}
          </x-responsive-nav-link >
      </div>

  <!-- Navigation User Links -->
                  
  @else
      <div class="pt-2 pb-3 space-y-1">
          <x-responsive-nav-link  :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              {{ __('Dashboard') }}
          </x-responsive-nav-link >
      </div>
@endif