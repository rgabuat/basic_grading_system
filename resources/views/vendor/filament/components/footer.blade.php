{{ \Filament\Facades\Filament::renderHook('footer.before') }}
 
<div class="filament-footer flex items-center justify-center">
  {{ \Filament\Facades\Filament::renderHook('footer.start') }}
 
  @if (config('filament.layout.footer.should_show_logo'))
    <a
      href="{{ env('APP_URL') }}/admin"
      target="_blank"
      rel="noopener noreferrer"
      class="text-gray-300 transition hover:text-primary-500"
    >
      <img
        src="{{ asset('/images/CICLogo.png') }}"
        alt=""
        class="h-10 dark:hidden"
      >
      <img
        src="{{ asset('/images/CICLogo.png') }}"
        alt=""
        class="hidden h-10 dark:block"
      >
    </a>
  @endif
 
  {{ \Filament\Facades\Filament::renderHook('footer.end') }}
</div>
 
{{ \Filament\Facades\Filament::renderHook('footer.after') }}