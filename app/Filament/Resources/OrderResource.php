<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use App\Models\Orderstatus;
use App\Models\Customer;
use App\Models\Address;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer')
                    ->label('Customer')
                    ->options(Customer::all()->pluck('name', 'name'))
                    ->required()
                    ->searchable(),

                DatePicker::make('date')
                    ->required()
                    ->minDate(now()->subYears(1)),

                Forms\Components\TextInput::make('total')
                    ->required()
                    ->maxLength(255),


                Select::make('shipping_address')
                    ->label('shipping address')
                    ->options(Address::all()->pluck('name', 'city'))
                    ->required()
                    ->searchable(),

                Select::make('orderstatus')
                    ->label('order status')
                    ->options(Orderstatus::all()->pluck('name', 'orderstatus'))
                    ->required()
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('total'),
                Tables\Columns\TextColumn::make('shipping_address'),
                Tables\Columns\TextColumn::make('orderstatus'),
                TextColumn::make('customer')->searchable(['customer']),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),

            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
