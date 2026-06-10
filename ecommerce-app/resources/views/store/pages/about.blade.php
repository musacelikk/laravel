@extends('layouts.store')

@section('title', 'Hakkımızda & İletişim')

@section('content')
<section class="border-b border-luxe-ink/10 px-6 py-6">
    <div class="mx-auto max-w-[1400px]">
        <nav class="label-upper !text-luxe-muted">
            <a href="{{ route('home') }}" class="hover:text-luxe-ink">Home</a>
            <span class="mx-2">/</span>
            <span class="text-luxe-ink">Hakkımızda & İletişim</span>
        </nav>
    </div>
</section>

<section class="mx-auto max-w-[1400px] px-6 py-16">
    <div class="grid gap-12 lg:grid-cols-2">
        <div>
            <p class="label-upper">Hakkımızda</p>
            <h1 class="heading-section mt-4">{{ $setting?->company ?? 'E-SHOP' }}</h1>
            <div class="mt-6 text-sm leading-relaxed text-luxe-muted">
                @if ($setting?->aboutus)
                    {!! $setting->aboutus !!}
                @else
                    <p>E-SHOP, zamansız parçalar ve özenle seçilmiş koleksiyonlar sunan bir e-ticaret markasıdır. Kalite, sürdürülebilirlik ve müşteri memnuniyeti önceliğimizdir.</p>
                @endif
            </div>
        </div>
        <div class="bg-luxe-sand p-8">
            <p class="label-upper">İletişim Bilgileri</p>
            <dl class="mt-6 space-y-4 text-sm">
                @if ($setting?->address)
                    <div><dt class="font-semibold text-luxe-ink">Adres</dt><dd class="mt-1 text-luxe-muted">{{ $setting->address }}</dd></div>
                @endif
                @if ($setting?->phone)
                    <div><dt class="font-semibold text-luxe-ink">Telefon</dt><dd class="mt-1 text-luxe-muted">{{ $setting->phone }}</dd></div>
                @endif
                @if ($setting?->email)
                    <div><dt class="font-semibold text-luxe-ink">E-posta</dt><dd class="mt-1 text-luxe-muted">{{ $setting->email }}</dd></div>
                @endif
            </dl>
            @if ($setting?->contact)
                <div class="mt-6 border-t border-luxe-ink/10 pt-6 text-sm text-luxe-muted">{!! $setting->contact !!}</div>
            @endif
        </div>
    </div>
</section>

<section id="contact" class="bg-luxe-sand/50 px-6 py-16">
    <div class="mx-auto max-w-[1400px]">
        <div class="grid gap-12 lg:grid-cols-2">
            <div>
                <p class="label-upper">Bize Ulaşın</p>
                <h2 class="heading-section mt-4">Contact Form</h2>
                <p class="mt-4 text-sm text-luxe-muted">Sorularınız için formu doldurun, size en kısa sürede dönelim.</p>
            </div>
            <form action="{{ route('pages.contact') }}" method="POST" class="space-y-4 bg-white p-8 border border-luxe-ink/10">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label for="first_name" class="label-upper">First Name</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required class="input-field mt-2 w-full border-b border-luxe-ink/20 py-2">
                    </div>
                    <div>
                        <label for="last_name" class="label-upper">Last Name</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required class="input-field mt-2 w-full border-b border-luxe-ink/20 py-2">
                    </div>
                </div>
                <div>
                    <label for="email" class="label-upper">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="mt-2 w-full border-b border-luxe-ink/20 bg-transparent py-2 text-sm focus:border-luxe-ink focus:outline-none">
                </div>
                <div>
                    <label for="phone" class="label-upper">Telephone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-2 w-full border-b border-luxe-ink/20 bg-transparent py-2 text-sm focus:border-luxe-ink focus:outline-none">
                </div>
                <div>
                    <label for="message" class="label-upper">Message</label>
                    <textarea name="message" id="message" rows="4" required class="mt-2 w-full border border-luxe-ink/15 p-3 text-sm focus:border-luxe-ink focus:outline-none">{{ old('message') }}</textarea>
                </div>
                <button type="submit" class="btn-gold w-full sm:w-auto">Send Message</button>
            </form>
        </div>
    </div>
</section>

@if ($recentMessages->isNotEmpty())
<section class="mx-auto max-w-[1400px] px-6 py-12">
    <p class="label-upper">Community</p>
    <h2 class="heading-section mt-2">Recent Messages</h2>
    <div class="mt-8 divide-y divide-luxe-ink/10 border border-luxe-ink/10">
        @foreach ($recentMessages as $msg)
            <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-4 text-sm">
                <div>
                    <p class="font-medium text-luxe-ink">{{ $msg->name }}</p>
                    <p class="text-luxe-muted">{{ Str::limit($msg->message, 80) }}</p>
                </div>
                <span class="text-xs text-luxe-muted">{{ $msg->created_at?->diffForHumans() }}</span>
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection
