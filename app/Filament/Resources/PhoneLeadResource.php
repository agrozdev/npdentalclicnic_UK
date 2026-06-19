<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhoneLeadResource\Pages;
use App\Models\PhoneLead;
use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PhoneLeadResource extends Resource
{
    protected static ?string $model = PhoneLead::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-phone';

    protected static ?string $navigationLabel = 'Phone Calls';

    protected static ?int $navigationSort = 3;

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Call Details')->schema([
                TextEntry::make('caller_number')->label('Caller Number')->default('—'),
                TextEntry::make('name')->default('—'),
                TextEntry::make('email')->default('—'),
                TextEntry::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'       => 'warning',
                        'contacted' => 'info',
                        'booked'    => 'success',
                    }),
                TextEntry::make('call_started_at')->label('Call Started')->dateTime()->placeholder('—'),
                TextEntry::make('call_ended_at')->label('Call Ended')->dateTime()->placeholder('—'),
                TextEntry::make('ended_reason')->label('Ended Reason')->default('—'),
            ])->columns(3),

            Section::make('Lead Info')->schema([
                TextEntry::make('reason')->label('Reason for Calling')->default('—')->columnSpanFull(),
                TextEntry::make('preferred_time')->label('Preferred Time')->default('—'),
            ])->columns(2),

            Section::make('Recording & Summary')->schema([
                TextEntry::make('name')->label('Customer Name')->default('—'),
                TextEntry::make('caller_number')->label('Customer Phone')->default('—'),
                TextEntry::make('email')->label('Customer Email')->default('—'),
                TextEntry::make('recording_url')
                    ->label('Recording')
                    ->default('—')
                    ->url(fn ($record) => $record->recording_url)
                    ->openUrlInNewTab(),
                TextEntry::make('summary')
                    ->label('AI Summary')
                    ->default('—')
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Transcript')->schema([
                TextEntry::make('transcript')
                    ->label('')
                    ->default('No transcript available.')
                    ->columnSpanFull()
                    ->extraAttributes(['style' => 'white-space: pre-wrap; font-family: monospace; font-size: 13px;']),
            ]),
        ]);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('status')
                ->options([
                    'new'       => 'New',
                    'contacted' => 'Contacted',
                    'booked'    => 'Booked',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('caller_number')->label('Caller')->searchable(),
                TextColumn::make('name')->default('—')->searchable(),
                TextColumn::make('reason')->label('Reason')->limit(50)->default('—'),
                TextColumn::make('preferred_time')->label('Preferred Time')->default('—')->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'new'       => 'warning',
                        'contacted' => 'info',
                        'booked'    => 'success',
                    })
                    ->sortable(),
                TextColumn::make('call_started_at')->label('Called At')->dateTime()->sortable()->placeholder('—'),
            ])
            ->filters([
                SelectFilter::make('status')->options([
                    'new'       => 'New',
                    'contacted' => 'Contacted',
                    'booked'    => 'Booked',
                ]),
            ])
            ->actions([
                ViewAction::make()->label('View Call'),
                Action::make('updateStatus')
                    ->label('Status')
                    ->icon('heroicon-o-arrow-path')
                    ->form([
                        Select::make('status')
                            ->options([
                                'new'       => 'New',
                                'contacted' => 'Contacted',
                                'booked'    => 'Booked',
                            ])
                            ->required(),
                    ])
                    ->action(fn (PhoneLead $record, array $data) => $record->update(['status' => $data['status']])),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPhoneLeads::route('/'),
            'view'  => Pages\ViewPhoneLead::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return false;
    }
}
