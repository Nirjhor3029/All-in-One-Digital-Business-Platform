<?php

namespace App\Filament\Resources\LectureResource\Pages;

use App\Filament\Resources\LectureResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLectures extends ListRecords
{
    protected static string $resource = LectureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function updatedTableFilters(): void
    {
        parent::updatedTableFilters();

        $courseId = data_get($this->tableFilters, 'course_id.value');
        $sectionId = data_get($this->tableFilters, 'section_id.value');

        if (blank($courseId) || blank($sectionId)) {
            return;
        }

        if (! \App\Models\Section::whereKey($sectionId)->where('course_id', $courseId)->exists()) {
            $this->removeTableFilter('section_id');
        }
    }
}
