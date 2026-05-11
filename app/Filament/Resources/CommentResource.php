<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Models\Comment;
use App\Filament\Traits\HasPermissionBasedAccess;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;

class CommentResource extends Resource
{
    use HasPermissionBasedAccess;
    protected static ?string $model = Comment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'Content';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Comment')
                    ->schema([
                        Forms\Components\Placeholder::make('author')
                            ->label('Author')
                            ->content(fn (?Comment $record): string => $record?->user?->name ?? $record?->guest_name ?? '-'),
                        Forms\Components\Placeholder::make('post')
                            ->label('Post')
                            ->content(fn (?Comment $record): string => $record?->post?->title ?? '-'),
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Submitted')
                            ->content(fn (?Comment $record): string => $record?->created_at?->format('M d, Y g:i A') ?? '-'),
                        Forms\Components\Textarea::make('body')
                            ->label('Comment Body')
                            ->disabled()
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_approved')
                            ->label('Approved')
                            ->inline(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('body')
                    ->label('Comment')
                    ->searchable()
                    ->limit(60)
                    ->sortable(),
                Tables\Columns\TextColumn::make('post.title')
                    ->label('Post')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('guest_name')
                    ->label('Guest')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_approved')
                    ->label('Approved')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (Comment $record): bool => ! $record->is_approved)
                    ->action(function (Comment $record) {
                        $record->update(['is_approved' => true]);
                        Notification::make()->title('Comment approved.')->success()->send();
                    })
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('gray')
                    ->visible(fn (Comment $record): bool => $record->is_approved)
                    ->action(function (Comment $record) {
                        $record->update(['is_approved' => false]);
                        Notification::make()->title('Comment rejected.')->success()->send();
                    })
                    ->requiresConfirmation(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageComments::route('/'),
        ];
    }
}
