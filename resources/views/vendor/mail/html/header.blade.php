@props(['url'])
<tr>
    <td class="header">
        <a href="omondecanada.com" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
            @else
            <img src="{{ asset('assets/email.png') }}" class="logo" alt="OMONDE CANADA">
            @endif
            </a>
    </td>
</tr>
