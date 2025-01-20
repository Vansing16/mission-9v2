@extends('technician.layout.master')
@section('title', 'Tickets')
@section('content')

    <div class="container-fluid">
        <!-- Alert for success messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter Form -->
        <form method="GET" action="{{ route('technician.tickets') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="status" class="form-select">
                        <option value="">-- Select All --</option>
                        <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Ongoing" {{ request('status') == 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed
                        </option>
                        <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tickets</h1>
        </div>

        <!-- Header Row -->
        <div class="d-none d-md-flex row mx-1 mb-2 align-items-center">
            <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Technician</div>
            <div class="col-6 col-md-3 text-xs font-weight-bold text-uppercase">Subject</div>
            <div class="col-6 col-md-3 text-xs font-weight-bold text-uppercase">Status</div>
            <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase">Date Posted</div>
            <div class="col-6 col-md-2 text-xs font-weight-bold text-uppercase text-md-center">Action</div>
        </div>
    

        @php
            $statuses = ['Pending', 'Ongoing', 'Completed', 'Cancelled'];
        @endphp

        <!-- Display Tickets by Status -->
        @foreach ($statuses as $status)
            @php
                $statusTickets = $tickets->where('status', $status);
            @endphp

            @if ($statusTickets->isNotEmpty())
                @foreach ($statusTickets as $ticket)
                    <div class="card shadow mb-2 status-border-{{ strtolower($ticket->status) }}" style="min-height: 75px">
                        <div class="card-body d-flex align-items-center">
                            <div class="row w-100 align-items-center">
                                <div class="col-6 col-md-2 mb-2 mb-md-0 d-flex align-items-center">
                                    <strong class="d-md-none">Customer: </strong>
                                    <span>{{ $ticket->customer->name }}</span>
                                </div>
                                <div class="col-6 col-md-3 mb-2 mb-md-0 d-flex align-items-center">
                                    <strong class="d-md-none">Subject: </strong>
                                    <span>{{ $ticket->subject }}</span>
                                </div>
                                <div class="col-6 col-md-3 mb-2 mb-md-0 d-flex align-items-center">
                                    <!-- Status Indicator Circle -->
                                    <div class="status-circle"
                                        style="background-color: 
                                            @switch($ticket->status)
                                                @case('Pending')
                                                    #F6C23D
                                                    @break
                                                @case('Ongoing')
                                                    #1CC88A
                                                    @break
                                                @case('Completed')
                                                    #4E73DF
                                                    @break
                                                @case('Cancelled')
                                                    #E74A3A
                                                    @break
                                                @default
                                                    black
                                            @endswitch">
                                    </div>
                                    <strong class="d-md-none">Status: </strong>
                                    <span>{{ $ticket->status }}</span>
                                </div>
                                <div class="col-6 col-md-2 mb-2 mb-md-0 d-flex align-items-center">
                                    <strong class="d-md-none">Date Posted: </strong>
                                    <span>{{ $ticket->created_at->format('d-m-Y') }}</span>
                                </div>
                                <div class="col-6 col-md-2 text-md-center d-flex align-items-center justify-content-center">
                                    <strong class="d-md-none">Action: </strong>
                                    <a href="{{ route('technician.view-ticket', ['ticketId' => $ticket->id]) }}"><i
                                            class="bi bi-eye" style="color:blue"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        @endforeach
    </div>

@stop

@section('styles')
    <style>
        /* Style for the status indicator circle */
        .status-circle {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
            /* Adjust spacing as needed */
        }

        /* Status border styles */
        .status-border-pending {
            border-left: 5px solid #F6C23D;
        }

        .status-border-ongoing {
            border-left: 5px solid #1CC88A;
        }

        .status-border-completed {
            border-left: 5px solid #4E73DF;
        }

        .status-border-cancelled {
            border-left: 5px solid #E74A3A;
        }
    </style>
@endsection
