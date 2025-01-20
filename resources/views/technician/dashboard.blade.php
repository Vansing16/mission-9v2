@extends('technician.layout.master')

@section('title', 'Technician Dashboard')
@section('content')

    <div class="container-fluid">
        @if (session('login_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('login_message') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('register_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('register_message') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @php
            session()->forget('login_message');
            session()->forget('register_message');
        @endphp
        
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Recent Messages Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Recent Messages</h6>
            </div>
            <div class="card-body">
            @if ($messages->isEmpty())
            <p>No recent messages.</p>
            @else
            <div class="list-group">
            @foreach ($messages as $message)
                @if ($message->sender_type === 'customer')
                <a href="{{ route('technician.view-message', ['messageId' => $message->id]) }}"
                class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $message->customer->name  }}</h5>
                    <h5 class="mb-1">{{ $message->ticket->subject ?? 'No Subject' }}</h5>
                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ Str::limit($message->message, 100) }}</p>
                </a>
                @endif
            @endforeach
            </div>
            @endif
            </div>
        </div>

        <!-- Pending Tickets Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-danger">Pending Tickets</h6>
            </div>
            <div class="card-body">
                @if ($pendingTickets->isEmpty())
                    <p>No pending tickets.</p>
                @else
                    <div class="list-group">
                        @foreach ($pendingTickets as $ticket)
                            <a href="{{ route('technician.view-ticket', ['ticketId' => $ticket->id]) }}"
                                class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $ticket->subject }}</h5>
                                    <small>{{ $ticket->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">Status: {{ $ticket->status }}</p>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@stop
