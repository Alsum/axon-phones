@extends('layouts.app')

@section('content')
<h1>Phone Numbers</h1>

{{-- Filters --}}
<form method="GET" action="{{ route('phones.index') }}" class="filters">
    <div>
        <label for="country">Country</label>
        <select name="country" id="country">
            <option value="">All countries</option>
            @foreach ($countries as $name)
                <option value="{{ $name }}" @selected($country === $name)>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="state">State</label>
        <select name="state" id="state">
            <option value="">All states</option>
            <option value="valid"   @selected($state === 'valid')>Valid</option>
            <option value="invalid" @selected($state === 'invalid')>Invalid</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Filter</button>

    @if ($country || $state)
        <a href="{{ route('phones.index') }}" class="btn btn-ghost">Clear</a>
    @endif
</form>

{{-- Table --}}
<div class="card">
    @if ($numbers->isEmpty())
        <div class="empty">No phone numbers match the selected filters.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>Country Code</th>
                    <th>Phone Number</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($numbers as $phone)
                    <tr>
                        <td class="country-code">{{ $phone->id }}</td>
                        <td>{{ $phone->customerName }}</td>
                        <td>{{ $phone->country }}</td>
                        <td>
                            <span class="badge {{ $phone->isValid ? 'badge-ok' : 'badge-nok' }}">
                                {{ $phone->state() }}
                            </span>
                        </td>
                        <td class="country-code">{{ $phone->countryCode }}</td>
                        <td>{{ $phone->number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="pagination">
            <span class="summary">
                Showing {{ $numbers->firstItem() }}–{{ $numbers->lastItem() }} of {{ $numbers->total() }} results
            </span>

            {{-- Previous --}}
            @if ($numbers->onFirstPage())
                <span class="disabled">← Prev</span>
            @else
                <a href="{{ $numbers->previousPageUrl() }}">← Prev</a>
            @endif

            {{-- Page numbers --}}
            @foreach (range(1, $numbers->lastPage()) as $pg)
                @if ($pg === $numbers->currentPage())
                    <span class="active">{{ $pg }}</span>
                @else
                    <a href="{{ $numbers->url($pg) }}">{{ $pg }}</a>
                @endif
            @endforeach

            {{-- Next --}}
            @if ($numbers->hasMorePages())
                <a href="{{ $numbers->nextPageUrl() }}">Next →</a>
            @else
                <span class="disabled">Next →</span>
            @endif
        </div>
    @endif
</div>
@endsection
