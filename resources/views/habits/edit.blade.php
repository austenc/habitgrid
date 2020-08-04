@extends('layouts.app')

@section('content')
    @if (session('message'))
        <div class="mt-6 border border-teal-200 rounded p-6 bg-teal-100 text-teal-700">
            {{ session('message') }}
        </div>
    @endif
    
    
    <div class="mx-auto my-12">
        <livewire:habit-detail :habit="$habit" />
    </div>
@endsection