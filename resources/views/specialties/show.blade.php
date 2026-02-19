@extends('layouts.main')

@section('title', $specialty->name . ' - Колледж')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="specialty-header">
            <h1 class="specialty-title">{{ $specialty->name }}</h1>
            <div class="specialty-meta">
                <span class="duration">Срок обучения: {{ $specialty->duration }}</span>
                <span class="qualification">Квалификация: {{ $specialty->qualification }}</span>
            </div>
        </div>

        <div class="specialty-content">
            <div class="specialty-photo">
                @if($specialty->photo)
                    <img src="{{ asset('assets/img/specialties/' . $specialty->photo) }}" alt="{{ $specialty->name }}">
                @else
                    <img src="{{ asset('assets/img/no-photo.jpg') }}" alt="Нет фото">
                @endif
            </div>

            <div class="specialty-info">
                <section class="description-section">
                    <h2>Описание специальности</h2>
                    <p>{!! nl2br(e($specialty->description)) !!}</p>
                </section>

                <section class="skills-section">
                    <h2>Навыки</h2>
                    <ul class="skills-list">
                        @foreach(explode(',', $specialty->skills) as $skill)
                            <li>{{ trim($skill) }}</li>
                        @endforeach
                    </ul>
                </section>

                <section class="job-prospects">
                    <h2>Перспективы трудоустройства</h2>
                    <div class="job-grid">
                        <div class="job-card">
                            <h3>Где работать</h3>
                            <ul>
                                <li>Промышленные предприятия</li>
                                <li>Строительные компании</li>
                                <li>Сервисные центры</li>
                                <li>Частные мастерские</li>
                            </ul>
                        </div>
                        <div class="job-card">
                            <h3>Кем работать</h3>
                            <ul>
                                <li>Специалист по ремонту</li>
                                <li>Техник-эксплуатационник</li>
                                <li>Мастер производственного обучения</li>
                                <li>Инженер-технолог</li>
                            </ul>
                        </div>
                    </div>
                </section>

                <section class="admission-steps">
                    <h2>Как поступить</h2>
                    <div class="steps-grid">
                        <div class="step">
                            <div class="step-number">1</div>
                            <h3>Подача документов</h3>
                            <p>Подготовьте необходимые документы и подайте их в приемную комиссию</p>
                        </div>
                        <div class="step">
                            <div class="step-number">2</div>
                            <h3>Вступительные испытания</h3>
                            <p>Пройдите вступительные испытания по профильным предметам</p>
                        </div>
                        <div class="step">
                            <div class="step-number">3</div>
                            <h3>Зачисление</h3>
                            <p>После успешного прохождения испытаний вы будете зачислены на специальность</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- JavaScript if needed from app.js, but layout usually handles it. Original had js/app.js. -->
    <!-- We might need to check if js/app.js has specific logic for this page. -->
@endsection
