@extends('errors::minimal')

@section('title', __('CD | Acesso Negado'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Acesso Negado'))
