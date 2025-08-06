@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="{{ asset('frontend/assets/images/logo/LOGO AR.png') }}" class="logo" alt="AR">
            @else
                {!! $slot !!}
            @endif
        </a>
    </td>
</tr>
