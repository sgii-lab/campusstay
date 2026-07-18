<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LandlordResource\Pages;
use App\Filament\Resources\LandlordResource\RelationManagers;
use App\Models\Landlord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User;

class LandlordResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationGroup = 'Management'; // groups tabs together
    protected static ?string $label = 'Landlords';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('email')->email()->required(),
                Forms\Components\TextInput::make('phone')->label('Phone'),
                Forms\Components\TextInput::make('whatsapp')->label('WhatsApp'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required(fn ($record) => $record === null),
            ]);
    }    

// LandlordResource.php
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('whatsapp'),
                Tables\Columns\TextColumn::make('created_at')->date(),
            ]);
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLandlords::route('/'),
            'create' => Pages\CreateLandlord::route('/create'),
            'edit' => Pages\EditLandlord::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'landlord');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = 'landlord';
        return $data;
    }    
}
