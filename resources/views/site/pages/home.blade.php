@extends('site.master')

@section('title','Home')

@section('content')


    @include('site.pages.homeSections.homeSection')
    @include('site.pages.homeSections.collectionSection')
    @include('site.pages.homeSections.womenSection')
    @include('site.pages.homeSections.dealSection')
    @include('site.pages.homeSections.menSection')
    @include('site.pages.homeSections.blogSection')
    @include('site.pages.homeSections.serviceSection')

@endsection
