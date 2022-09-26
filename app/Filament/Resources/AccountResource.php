<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AccountResource\Pages;
use App\Filament\Resources\AccountResource\RelationManagers;
use App\Models\Account;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AccountResource extends Resource
{
    protected static ?string $model = Account::class;

    protected static ?string $navigationGroup = 'Resource Management';
    protected static ?int $navigationSort = 5;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('company_id')->relationship('company', 'name')->nullable(),
                Forms\Components\Select::make('department_id')->relationship('department', 'name')->nullable(),
                Forms\Components\Select::make('bank_id')->relationship('bank', 'bank_name')->nullable(),
                Forms\Components\TextInput::make('account_type')->maxLength(255),
                Forms\Components\TextInput::make('account_name')->maxLength(255),
                Forms\Components\TextInput::make('account_number')->maxLength(255),
                Forms\Components\TextInput::make('routing_number_paperless_and_electronic')->maxLength(255),
                Forms\Components\TextInput::make('routing_number_wires')->maxLength(255),
                Forms\Components\TextInput::make('account_opened_date')->maxLength(255),
                Forms\Components\TextInput::make('currency')->maxLength(255),
                Forms\Components\TextInput::make('starting_balance')->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('company.name', 'name'),
                Tables\Columns\TextColumn::make('department.name', 'name'),
                Tables\Columns\TextColumn::make('bank.name', 'bank_name'),
                Tables\Columns\TextColumn::make('account_type'),
                Tables\Columns\TextColumn::make('account_name'),
                Tables\Columns\TextColumn::make('account_number'),
                Tables\Columns\TextColumn::make('routing_number_paperless_and_electronic'),
                Tables\Columns\TextColumn::make('routing_number_wires'),
                Tables\Columns\TextColumn::make('account_opened_date'),
                Tables\Columns\TextColumn::make('currency'),
                Tables\Columns\TextColumn::make('starting_balance'),
                Tables\Columns\TextColumn::make('cards_count')->counts('cards')->label('Cards'),
                Tables\Columns\TextColumn::make('transactions_count')->counts('transactions')->label('Transactions'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListAccounts::route('/'),
            'create' => Pages\CreateAccount::route('/create'),
            'view' => Pages\ViewAccount::route('/{record}'),
            'edit' => Pages\EditAccount::route('/{record}/edit'),
        ];
    }    
}
