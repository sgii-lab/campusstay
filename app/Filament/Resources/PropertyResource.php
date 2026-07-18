<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->required(),
                Forms\Components\Textarea::make('description')->required(),
                Forms\Components\TextInput::make('location')->required(),
                Forms\Components\TextInput::make('price')->numeric()->required(),
                Forms\Components\Select::make('landlord_id')
                    ->relationship('landlord', 'name')
                    ->required(),


                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('pending')
                    ->required(),

                // ✅ Add this new field
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('properties')   // stored in storage/app/public/properties
                    ->maxSize(2048)             // 2 MB limit
                    ->nullable(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('title')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('location')->searchable(),
                Tables\Columns\TextColumn::make('price')->money('USD')->sortable(),

                Tables\Columns\TextColumn::make('landlord.name')
                    ->label('Landlord')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'secondary' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),

                Tables\Filters\SelectFilter::make('location')
                    ->options(
                        Property::query()
                            ->pluck('location', 'location')
                            ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('landlord_id')
                    ->relationship('landlord', 'name'),

                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\TextInput::make('min')->numeric()->label('Min Price'),
                        Forms\Components\TextInput::make('max')->numeric()->label('Max Price'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['min'], fn ($q) => $q->where('price', '>=', $data['min']))
                            ->when($data['max'], fn ($q) => $q->where('price', '<=', $data['max']));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('approve')
                    ->action(fn (Property $record) => $record->update(['status' => 'approved']))
                    ->visible(fn (Property $record) => $record->status === 'pending')
                    ->color('success'),
                Tables\Actions\Action::make('reject')
                    ->action(fn (Property $record) => $record->update(['status' => 'rejected']))
                    ->visible(fn (Property $record) => $record->status === 'pending')
                    ->color('danger'),
            ]);
    }

    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
