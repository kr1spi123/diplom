<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            [
                'name' => 'Информационные системы и программирование',
                'code' => '09.02.07',
                'duration' => '3 года 10 месяцев',
                'budget_places' => 25,
                'total_places' => 30,
                'description' => 'Разработка программного обеспечения, веб-приложений и баз данных.',
                'qualification' => 'Программист',
                'skills' => 'PHP, JavaScript, SQL, Laravel, Git',
            ],
            [
                'name' => 'Сетевое и системное администрирование',
                'code' => '09.02.06',
                'duration' => '3 года 10 месяцев',
                'budget_places' => 20,
                'total_places' => 25,
                'description' => 'Настройка и администрирование компьютерных сетей и серверов.',
                'qualification' => 'Системный администратор',
                'skills' => 'Linux, Windows Server, Cisco, Network Security',
            ],
            [
                'name' => 'Дизайн (по отраслям)',
                'code' => '54.02.01',
                'duration' => '3 года 10 месяцев',
                'budget_places' => 15,
                'total_places' => 20,
                'description' => 'Графический дизайн, веб-дизайн и создание визуального контента.',
                'qualification' => 'Дизайнер',
                'skills' => 'Adobe Photoshop, Illustrator, Figma, UI/UX',
            ],
            [
                'name' => 'Экономика и бухгалтерский учет',
                'code' => '38.02.01',
                'duration' => '2 года 10 месяцев',
                'budget_places' => 30,
                'total_places' => 35,
                'description' => 'Бухгалтерский учет, налогообложение и анализ хозяйственной деятельности.',
                'qualification' => 'Бухгалтер',
                'skills' => '1C:Предприятие, Excel, Налоговый учет',
            ],
        ];

        foreach ($specialties as $specialty) {
            Specialty::updateOrCreate(
                ['code' => $specialty['code']],
                $specialty
            );
        }
    }
}
