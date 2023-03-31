<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages\ListCategories;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\categories;
use App\Filament\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MultiSelect;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->columns(1)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('url_slug', str::slug($state));
                    }),

                Forms\Components\TextInput::make('url_slug')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('seo_title')
                    ->required()
                    ->maxLength(255),

                // Forms\Components\TextInput::make('description')
                // ->required()
                // ->maxLength(255),

                RichEditor::make('description')
                    ->required(),

                Select::make('category_id')
                    ->label('category')
                    ->relationship('category', 'category')
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('image')->image()
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('url_slug'),
                Tables\Columns\TextColumn::make('seo_title'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('category.category'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('image'),
                TextColumn::make('name')->searchable()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
