@extends('layouts.master')

@section('title') Dashboard @endsection

@section('content')
          
    @component('common-components.breadcrumb')
        @slot('title') Dashboard  @endslot
        @slot('li_1') Welcome to Skote Dashboard @endslot
    @endcomponent
                        
@endsection

