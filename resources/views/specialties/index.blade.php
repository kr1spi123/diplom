@extends('layouts.main')

@section('title', 'Специальности - Колледж')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/apps.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1 class="page-title">Наши специальности</h1>
        <p class="page-description">Выберите интересующую вас специальность для получения подробной информации</p>

        <div class="specialties-grid">
            @forelse($specialties as $specialty)
                <div class="specialty-card">
                    <div class="specialty-photo">
                        @php
                            $photo = $specialty->photo;
                            if ($photo) {
                                $startsWithSpecialties = strpos($photo, 'specialties/') === 0;
                                $startsWithAssets = strpos($photo, 'assets/') === 0;
                                $path = ($startsWithSpecialties || $startsWithAssets)
                                    ? 'assets/img/' . $photo
                                    : 'assets/img/specialties/' . $photo;
                            }
                        @endphp
                        @if(!empty($photo))
                            <img src="{{ asset($path) }}" alt="{{ $specialty->name }}">
                        @else
                            <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="Нет фото">
                        @endif
                    </div>

                    <div class="specialty-content">
                        <h2 class="specialty-title">{{ $specialty->name }}</h2>
                        <div class="specialty-meta">
                            <span class="duration">Срок обучения: {{ $specialty->duration }}</span>
                            <span class="qualification">Квалификация: {{ $specialty->qualification }}</span>
                        </div>
                        @php
                            $desc = (string) $specialty->description;
                            $short = strlen($desc) > 100 ? substr($desc, 0, 100) . '...' : $desc;
                        @endphp
                        <p class="specialty-description">{{ $short }}</p>
                        <div class="specialty-skills">
                            <h3>Навыки:</h3>
                            <ul>
                                @foreach(explode(',', $specialty->skills) as $skill)
                                    <li>{{ trim($skill) }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <a href="{{ route('specialties.show', $specialty) }}" class="btn-more">Подробнее</a>
                    </div>
                </div>
            @empty
                <div class="no-data">Нет доступных специальностей</div>
            @endforelse
        </div>
    </div>
@endsection
