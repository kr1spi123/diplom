@extends('layouts.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/lkform.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

    <div class="nav-links">
        <a href="{{ route('applications.create') }}" class="{{ request()->routeIs('applications.create') ? 'active' : '' }}">Подать заявку на поступление</a>
        <a href="{{ route('applications.index') }}" class="{{ request()->routeIs('applications.index') ? 'active' : '' }}">Мои заявки</a>
    </div>

    <div class="container">
        <form class="application-form" method="POST" action="{{ route('applications.store') }}" enctype="multipart/form-data">
                @csrf
                
                @if ($errors->any())
                    <div class="alert alert-danger" style="background-color: rgba(255, 90, 48, 0.1); color: #FF5A30; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-wrapper">
                    <!-- Первая строка -->
                    <div class="form-row">
                        <div class="form-block personal-data">
                            <h3>Личные данные</h3>
                            <div class="input-grid">
                                <div class="input-column">
                                    <div class="input-wrapper">
                                        <input type="text" name="name" placeholder="Введите имя" class="text-input" required pattern="[А-Яа-яЁё\s-]{2,50}" value="{{ old('name') }}">
                                        <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <div class="error-message">Введите корректное имя (только русские буквы)</div>
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="text" name="surname" placeholder="Введите фамилию" class="text-input" required pattern="[А-Яа-яЁё\s-]{2,50}" value="{{ old('surname') }}">
                                        <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <div class="error-message">Введите корректную фамилию (только русские буквы)</div>
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="date" name="birthdate" placeholder="Дата рождения" class="text-input" required min="1900-01-01" value="{{ old('birthdate') }}">
                                        <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <div class="error-message">Выберите корректную дату рождения</div>
                                    </div>
                                </div>
                                <div class="input-column">
                                    <div class="input-wrapper">
                                        <input type="tel" name="phone" placeholder="Номер телефона" class="text-input" required pattern="\+7\s?\(?\d{3}\)?\s?\d{3}[-\s]?\d{2}[-\s]?\d{2}" value="{{ old('phone') }}">
                                        <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <div class="error-message">Введите телефон в формате +7(XXX)XXX-XX-XX</div>
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="email" name="email" placeholder="Email" class="text-input" required value="{{ old('email') }}">
                                        <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                            <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                        <div class="error-message">Введите корректный email адрес</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-block address">
                            <h3>Адрес проживания</h3>
                            <div class="input-grid">
                                <div class="input-wrapper">
                                    <input type="text" name="street" placeholder="Улица" class="text-input" required pattern="[А-Яа-яЁё\s-\.]{2,100}" value="{{ old('street') }}">
                                    <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <div class="error-message">Введите корректное название улицы</div>
                                </div>
                                <div class="input-wrapper">
                                    <input type="text" name="house" placeholder="Дом" class="text-input" required pattern="[0-9А-Яа-яЁё\s-\./]{1,10}" value="{{ old('house') }}">
                                    <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <div class="error-message">Введите корректный номер дома</div>
                                </div>
                                <div class="input-wrapper">
                                    <input type="text" name="postal_code" placeholder="Почтовый индекс" class="text-input" required pattern="[0-9]{6}" value="{{ old('postal_code') }}">
                                    <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <div class="error-message">Введите корректный почтовый индекс (6 цифр)</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Вторая строка -->
                    <div class="form-row">
                        <div class="form-block education">
                            <h3>Образование</h3>
                            <div class="input-grid">
                                <div class="input-wrapper">
                                    <input type="text" name="school" placeholder="Учебное заведение" class="text-input" required pattern="[А-Яа-яЁё\s-\.]{2,100}" value="{{ old('school') }}">
                                    <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <div class="error-message">Введите корректное название учебного заведения</div>
                                </div>
                                <div class="input-wrapper">
                                    <input type="text" name="graduation_year" placeholder="Год окончания" class="text-input" required pattern="[0-9]{4}" min="1900" max="2024" value="{{ old('graduation_year') }}">
                                    <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <div class="error-message">Введите корректный год окончания (1900-2024)</div>
                                </div>
                                
                                <!-- New Fields for Ranking (Added to Education block to fit) -->
                                <div class="input-wrapper">
                                    <input type="number" name="ege_score" placeholder="Баллы ЕГЭ (0-300)" class="text-input" required min="0" max="300" value="{{ old('ege_score') }}">
                                    <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <div class="error-message">Введите баллы ЕГЭ (0-300)</div>
                                </div>
                                <div class="input-wrapper">
                                    <input type="number" step="0.1" name="certificate_score" placeholder="Средний балл (3.0-5.0)" class="text-input" required min="3.0" max="5.0" value="{{ old('certificate_score') }}">
                                    <svg class="validation-icon success" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <svg class="validation-icon error" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 18.3333C14.6024 18.3333 18.3334 14.6024 18.3334 10C18.3334 5.39763 14.6024 1.66667 10 1.66667C5.39765 1.66667 1.66669 5.39763 1.66669 10C1.66669 14.6024 5.39765 18.3333 10 18.3333Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M10 6.66667V10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        <path d="M10 13.3333H10.0083" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                    </svg>
                                    <div class="error-message">Введите средний балл (3.0-5.0)</div>
                                </div>
                                <div class="input-wrapper checkbox-wrapper" style="margin-top: 10px;">
                                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                                        <input type="checkbox" name="has_achievements" value="1" {{ old('has_achievements') ? 'checked' : '' }}>
                                        <span style="font-size: 14px; color: #424551;">Есть индивидуальные достижения (олимпиады, ГТО и др.)</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-block documents">
                            <h3>Документы</h3>
                            <div class="file-upload">
                                <input type="file" name="certificate_file" id="certificate" class="file-input" accept=".pdf,.jpg,.jpeg,.png" required>
                                <label for="certificate" class="file-label">
                                    <span class="upload-icon">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 16L12 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                            <path d="M9 11L12 8L15 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M8 16H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </span>
                                    <span class="upload-text">ЗАГРУЗИТЬ АТТЕСТАТ</span>
                                </label>
                                <div class="file-info">
                                    <div class="file-preview">
                                        <svg class="file-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" stroke="#FF5A30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M14 2V8H20" stroke="#FF5A30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16 13H8" stroke="#FF5A30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M16 17H8" stroke="#FF5A30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M10 9H8" stroke="#FF5A30" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <span class="file-name"></span>
                                    </div>
                                    <button type="button" class="remove-file" style="display: none;">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 5L5 15" stroke="#9A9CA5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 5L15 15" stroke="#9A9CA5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <p class="file-hint">Допустимые форматы: PDF, JPG, PNG. Максимальный размер: 5MB</p>
                        </div>
                    </div>

                    <!-- Третья строка -->
                    <div class="form-block specialties">
                        <h3>Специальности</h3>
                        <div class="specialties-content">
                            <div class="specialties-list">
                                @foreach($specialties as $specialty)
                                    <label class="specialty-item" data-description="{{ $specialty->description }}">
                                        <span class="specialty-name">{{ $specialty->name }}</span>
                                        <input type="checkbox" name="specialty[]" value="{{ $specialty->id }}" class="specialty-checkbox" {{ is_array(old('specialty')) && in_array($specialty->id, old('specialty')) ? 'checked' : '' }}>
                                        <span class="custom-checkbox"></span>
                                    </label>
                                @endforeach
                                @if($specialties->isEmpty())
                                    <p class="no-specialties">Нет доступных специальностей</p>
                                @endif
                            </div>
                            <div class="specialty-description">
                                <p>Выберите специальность, чтобы увидеть её описание. <br> Можно выбрать до 3-х специальностей.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-button">ПОДАТЬ ЗАЯВКУ</button>
            </form>
        </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const MAX_SELECTIONS = 3;
        const specialtyItems = document.querySelectorAll('.specialty-item');
        const descriptionBox = document.querySelector('.specialty-description p');
        let selectedCount = 0;

        // Обработка клика по чекбоксу
        document.querySelectorAll('.specialty-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function(e) {
                const currentSelected = document.querySelectorAll('.specialty-checkbox:checked').length;
                const specialtyItem = this.closest('.specialty-item');
                
                if (currentSelected > MAX_SELECTIONS) {
                    e.preventDefault();
                    this.checked = false;
                    return;
                }

                // Добавляем/удаляем класс selected при изменении состояния чекбокса
                if (this.checked) {
                    specialtyItem.classList.add('selected');
                } else {
                    specialtyItem.classList.remove('selected');
                }

                selectedCount = currentSelected;

                // Если достигнут максимум выборов, отключаем остальные чекбоксы
                if (selectedCount >= MAX_SELECTIONS) {
                    specialtyItems.forEach(item => {
                        const cb = item.querySelector('.specialty-checkbox');
                        if (!cb.checked && !item.classList.contains('already-applied')) {
                            item.classList.add('disabled');
                            cb.disabled = true;
                        }
                    });
                } else {
                    // Если меньше максимума, включаем все чекбоксы кроме тех, на которые уже подана заявка
                    specialtyItems.forEach(item => {
                        const cb = item.querySelector('.specialty-checkbox');
                        if (!item.classList.contains('already-applied')) {
                            item.classList.remove('disabled');
                            cb.disabled = false;
                        }
                    });
                }
            });
        });

        // Обработка клика по названию специальности
        document.querySelectorAll('.specialty-name').forEach(name => {
            name.addEventListener('click', function(e) {
                e.preventDefault();
                const description = this.closest('.specialty-item').getAttribute('data-description');
                if (descriptionBox) {
                    descriptionBox.textContent = description;
                    
                    // Добавляем анимацию для привлечения внимания
                    descriptionBox.style.opacity = '0';
                    setTimeout(() => {
                        descriptionBox.style.opacity = '1';
                    }, 100);
                }
            });
        });

        // File upload handling
        const fileInput = document.getElementById('certificate');
        const fileInfo = document.querySelector('.file-info');
        const fileName = document.querySelector('.file-name');
        const removeButton = document.querySelector('.remove-file');
        const maxSize = 5 * 1024 * 1024; // 5MB in bytes

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = this.files[0];
                if (file) {
                    if (file.size > maxSize) {
                        alert('Файл слишком большой. Максимальный размер: 5MB');
                        this.value = '';
                        fileInfo.classList.remove('active');
                        return;
                    }
                    fileName.textContent = file.name;
                    fileInfo.classList.add('active');
                    removeButton.style.display = 'flex';
                } else {
                    fileInfo.classList.remove('active');
                    removeButton.style.display = 'none';
                }
            });
        }

        if (removeButton) {
            removeButton.addEventListener('click', function() {
                fileInput.value = '';
                fileInfo.classList.remove('active');
                this.style.display = 'none';
            });
        }

        const inputs = document.querySelectorAll('.text-input');
        
        inputs.forEach(input => {
            // Валидация при вводе
            input.addEventListener('input', function() {
                validateInput(this);
            });

            // Валидация при потере фокуса
            input.addEventListener('blur', function() {
                validateInput(this);
            });

            // Валидация при получении фокуса
            input.addEventListener('focus', function() {
                // Убираем классы valid/invalid при фокусе
                this.classList.remove('valid', 'invalid');
                // Скрываем сообщение об ошибке
                const errorMessage = this.parentElement.querySelector('.error-message');
                if (errorMessage) errorMessage.classList.remove('visible');
            });
        });

        function validateInput(input) {
            const wrapper = input.parentElement;
            const errorMessage = wrapper.querySelector('.error-message');
            let isValid = true;

            // Очищаем предыдущие состояния
            input.classList.remove('valid', 'invalid');
            if (errorMessage) errorMessage.classList.remove('visible');

            // Проверяем заполненность
            if (input.required && !input.value) {
                isValid = false;
            }

            // Проверяем паттерны для разных типов полей
            if (input.value) {
                switch (input.type) {
                    case 'text':
                        if (input.pattern && !new RegExp(input.pattern).test(input.value)) {
                            isValid = false;
                        }
                        break;
                    case 'email':
                        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                        if (!emailPattern.test(input.value)) {
                            isValid = false;
                        }
                        break;
                    case 'tel':
                        if (input.pattern && !new RegExp(input.pattern).test(input.value)) {
                            isValid = false;
                        }
                        break;
                    case 'date':
                        const date = new Date(input.value);
                        const minDate = new Date(input.min || '1900-01-01');
                        const today = new Date();
                        if (isNaN(date.getTime()) || date < minDate || date > today) {
                            isValid = false;
                        }
                        break;
                    case 'number':
                         if (input.min && parseFloat(input.value) < parseFloat(input.min)) isValid = false;
                         if (input.max && parseFloat(input.value) > parseFloat(input.max)) isValid = false;
                         break;
                }
            }

            // Применяем соответствующие классы и показываем/скрываем сообщение об ошибке
            if (input.value) {
                input.classList.add(isValid ? 'valid' : 'invalid');
                if (!isValid && errorMessage) {
                    errorMessage.classList.add('visible');
                }
            }
        }

        // Маска для телефона
        const phoneInput = document.querySelector('input[name="phone"]');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length > 0 && value[0] !== '7') {
                    value = '7' + value;
                }
                let formattedValue = '';
                if (value.length > 0) {
                    formattedValue = '+' + value[0];
                    if (value.length > 1) {
                        formattedValue += '(' + value.substring(1, 4);
                    }
                    if (value.length > 4) {
                        formattedValue += ')' + value.substring(4, 7);
                    }
                    if (value.length > 7) {
                        formattedValue += '-' + value.substring(7, 9);
                    }
                    if (value.length > 9) {
                        formattedValue += '-' + value.substring(9, 11);
                    }
                }
                e.target.value = formattedValue;
            });
        }
    });
    </script>
@endsection
