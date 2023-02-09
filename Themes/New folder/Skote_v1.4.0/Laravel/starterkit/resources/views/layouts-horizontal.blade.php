@extends('layouts.master-layouts')

@section('title')
Horizontal Layout
@endsection

@section('body')
<body data-topbar="dark" data-layout="horizontal">
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Horizontal Layout  @endslot
         @slot('li_1') Layouts @endslot
         @slot('li_2') Horizontal Layout @endslot
    @endcomponent 

@endsection