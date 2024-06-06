<?php

namespace App\Http\Livewire;

use App\Jobs\TicketCreatedJob;
use App\Models\Ticket;
use App\Models\TicketCategory;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Livewire\Component;

class TicketsDialog extends Component implements HasForms
{
    use InteractsWithForms;

    public $title;
    public $content;
    public $priority;
    public $type;
    public $category;
    public $subcategory;
    public $status;
    public Ticket $ticket;

    protected $listeners = ['showForm', 'hideForm'];

    public function mount(): void
    {
        $this->form->fill([
            'title' => $this->ticket->title,
            'content' => $this->ticket->content,
            'priority' => $this->ticket->priority,
        ]);
    }

    public function render()
    {
        return view('livewire.tickets-dialog');
    }

    /**
     * Form schema definition
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [

            Grid::make()
                ->schema([

                    Select::make('type')
                        ->label(__('Type'))
                        ->required()
                        ->searchable()
                        ->options(types_list()),

                    Select::make('priority')
                        ->label(__('Priority'))
                        ->searchable()
                        ->options(priorities_list())
                        ->disabled(fn()=>auth()->user()->cannot('Manage ticket statuses')),

                    Select::make('category')
                        ->label(__('Category'))
                        ->required()
                        ->searchable()
                        ->options(categories_list()),
                    Select::make('subcategory')
                        ->label(__('Subcategory'))
                        ->required()
                        ->searchable()
                        ->options(search_all_categories()),
                ]),

            TextInput::make('title')
                ->label(__('Ticket title'))
                ->maxLength(255)
                ->required(),

            RichEditor::make('content')
                ->label(__('Content'))
                ->required()
                ->fileAttachmentsDisk(config('filesystems.default'))
                ->fileAttachmentsDirectory('tickets')
                ->fileAttachmentsVisibility('private'),
        ];
    }

    /**
     * Create / Update the ticket
     *
     * @return void
     */
    public function save(): void
    {
        $data = $this->form->getState();
        if(auth()->user()->cannot('Manage ticket statuses')){
        $ticket = Ticket::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'owner_id' => auth()->user()->id,
            'priority' => '',
            'type' => $data['type'],
            'category' => $data['category'],
            'subcategory' => $data['subcategory'],
            'status' => default_ticket_status()
        ]);}else{
            $ticket = Ticket::create([
                'title' => $data['title'],
                'content' => $data['content'],
                'owner_id' => auth()->user()->id,
                'priority' => $data['priority'],
                'type' => $data['type'],
                'category' => $data['category'],
                'subcategory' => $data['subcategory'],
                'status' => default_ticket_status()
            ]);}
        Notification::make()
            ->success()
            ->title(__('Ticket created'))
            ->body(__('The ticket has been successfully created'))
            ->actions([
                Action::make('redirect')
                    ->label(__('See details'))
                    ->color('success')
                    ->button()
                    ->close()
                    ->url(fn() => route('tickets.details', [
                        'ticket' => $ticket,
                        'slug' => Str::slug($ticket->title)
                    ]))
            ])
            ->send();
        $this->dispatch('ticketSaved');
        TicketCreatedJob::dispatch($ticket);
    }
}
