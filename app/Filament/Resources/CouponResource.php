<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Resources\CouponResource\RelationManagers;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CouponResource extends Resource
{
    protected static ?string $model = Coupon::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('coupon_code')
                    ->required(),

                Forms\Components\TextInput::make('discount_%')
                    ->required(),

                DatePicker::make('start_coupon')
                    ->minDate(now()->subYears(1)),
                DatePicker::make('expired_coupon')
                    ->minDate(now()->subYears(1)),
                // Forms\Components\TextInput::make('coupon_code')
                //     ->required(),
                // Forms\Components\TextInput::make('discount_%')
                //     ->required(),
                // Forms\Components\DatePicker::make('start_coupon')
                //     ->required(),
                // Forms\Components\DatePicker::make('expired_coupon')
                //     ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('coupon_code'),
                Tables\Columns\TextColumn::make('discount_%'),
                Tables\Columns\TextColumn::make('start_coupon'),
                Tables\Columns\TextColumn::make('expired_coupon'),
                // Tables\Columns\TextColumn::make('default_discount') ,

                // Tables\Columns\TextColumn::make('coupon_code'),
                // Tables\Columns\TextColumn::make('discount_%'),
                // Tables\Columns\TextColumn::make('start_coupon')
                //     ->date(),
                // Tables\Columns\TextColumn::make('expired_coupon')
                //     ->date(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime(),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime(),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            // 'view' => Pages\ViewCoupon::route('/{record}'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
