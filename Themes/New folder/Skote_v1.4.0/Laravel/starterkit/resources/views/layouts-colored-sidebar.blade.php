@extends('layouts.master')

@section('title')
Colored Sidebar
@endsection

@section('body')
    <body data-sidebar="colored">
@endsection

@section('content')
                   
   @component('common-components.breadcrumb')
         @slot('title') Colored Sidebar  @endslot
         @slot('li_1') Layouts @endslot
         @slot('li_2') Colored Sidebar @endslot
     @endcomponent

@endsection