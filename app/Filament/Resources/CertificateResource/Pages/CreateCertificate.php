<?php

namespace App\Filament\Resources\CertificateResource\Pages;

use App\Filament\Resources\CertificateResource;
use App\Models\Enrollment;
use App\Services\CertificateService;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCertificate extends CreateRecord
{
    protected static string $resource = CertificateResource::class;

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $enrollment = Enrollment::where('user_id', $data['user_id'])
            ->where('course_id', $data['course_id'])
            ->first();

        if (!$enrollment) {
            Notification::make()
                ->title('User is not enrolled in this course.')
                ->danger()
                ->send();

            $this->halt();
        }

        $service = app(CertificateService::class);
        return $service->generate($enrollment, auth()->user(), false);
    }
}
