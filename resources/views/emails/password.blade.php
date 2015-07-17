<!-- resources/views/emails/password.blade.php -->
@extends('master')
@section('title','Reset Password')

@section('content')
Click here to reset your password: {{ url('password/reset/'.$token) }}