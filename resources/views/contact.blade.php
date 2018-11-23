@extends('layout')

@section('title')
 Contact Us
@endsection

@section('content')

    <h1>Sinterklaas Contact<h1>
        <form>
            <input type="text" name="email" placeholder="email"><br>
            <input type="text" name="subject" placeholder="subject"><br>
            <textarea name="message" placeholder="Your message"></textarea>
            <input type="submit" name="submit" value="Send"><br>
        </form>

@endsection