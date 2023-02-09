@extends('layouts.master')

@section('title')
Preloader Layout
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Preloader @endslot
         @slot('li_1') Layouts @endslot
         @slot('li_2') Preloader @endslot
    @endcomponent         

@endsection