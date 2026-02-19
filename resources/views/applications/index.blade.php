@extends('layouts.main')

@section('content')
<link rel="stylesheet" href="{{ asset('css/lkapp.css') }}">
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">

<div class="nav-links">
    <a href="{{ route('applications.create') }}" class="{{ request()->routeIs('applications.create') ? 'active' : '' }}">Подать заявку на поступление</a>
    <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.index') ? 'active' : '' }}">Мои заявки</a>
</div>

<main>
    <div class="container">
        @if(session('success'))
            <div class="success-message active" style="grid-column: 1 / -1; background-color: #E8F5E9; color: #2E7D32; padding: 16px; border-radius: 8px; border: 1px solid #C8E6C9; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        @if($applications->count() > 0)
            @foreach($applications as $application)
                @php
                    // Safe logic for ranking and status
                    try {
                        $position = app(\App\Services\RankingService::class)->getPosition($application);
                    } catch (\Throwable $e) {
                        $position = '-';
                        \Log::error('Ranking error: ' . $e->getMessage());
                    }
                    
                    $specialty = $application->specialty;
                    $budget = (int) ($specialty?->budget_places ?? 0);
                    $total = (int) ($specialty?->total_places ?? $budget);
                    
                    $type = 'Не рассчитано';
                    if (is_numeric($position)) {
                        $type = $position <= $budget ? 'Бюджет' : ($position <= $total ? 'Платно' : 'Вне мест');
                    }
                    
                    $typeClass = match($type) {
                        'Бюджет' => 'type-budget',
                        'Платно' => 'type-paid',
                        default => 'type-other'
                    };
                    
                    $statusClass = match($application->status) {
                        'На рассмотрении' => 'status-pending',
                        'Одобрено' => 'status-approved',
                        'Отклонено' => 'status-rejected',
                        default => 'status-pending'
                    };
                @endphp

                <div class="application-card">
                    <!-- Header -->
                    <div class="card-header">
                        <div class="specialty-title">{{ $application->specialty?->name ?? 'Специальность удалена' }}</div>
                        <div class="application-date">
                            <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            {{ $application->created_at?->format('d.m.Y') ?? '-' }}
                        </div>
                    </div>

                    <!-- Body Info -->
                    <div class="card-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Баллы ЕГЭ</span>
                                <span class="info-value">
                                    <svg class="icon-sm" style="color: #FF5A30;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"></path>
                                    </svg>
                                    {{ $application->ege_score }}
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Аттестат</span>
                                <span class="info-value">
                                    <svg class="icon-sm" style="color: #4CAF50;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                    {{ $application->certificate_score }}
                                </span>
                            </div>
                            <div class="info-item" style="grid-column: 1 / -1;">
                                <span class="info-label">Адрес проживания</span>
                                <span class="info-value">
                                    <svg class="icon-sm" style="color: #666;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                    {{ $application->street }}, д. {{ $application->house }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Ranking & Status -->
                    <div class="ranking-section">
                        <div class="rank-badge">
                            <span class="rank-number">{{ $position }}</span>
                            Место в рейтинге
                        </div>
                        <div class="type-badge {{ $typeClass }}">
                            {{ $type }}
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer">
                        <div class="status-badge {{ $statusClass }}">
                            {{ $application->status }}
                        </div>
                        @if($application->qr_code_path)
                            <a href="{{ asset('storage/' . $application->qr_code_path) }}" target="_blank" class="download-link">
                                <svg class="icon-sm" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                PDF Заявление
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="no-applications">
                <div style="margin-bottom: 20px;">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#e0e0e0" stroke-width="1.5">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                </div>
                <h3>У вас пока нет активных заявок</h3>
                <p style="margin-top: 10px; color: #666;">Подайте заявление на поступление, выбрав интересующую специальность.</p>
                <a href="{{ route('applications.create') }}" style="display: inline-block; margin-top: 20px; background: #FF5A30; color: white; padding: 10px 24px; border-radius: 8px; text-decoration: none; font-weight: 600;">Подать заявку</a>
            </div>
        @endif
    </div>
</main>
@endsection
