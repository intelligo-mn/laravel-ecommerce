<?php
$DB_PLUGIN_NEWS = getcong('p-buzzynews');
$DB_PLUGIN_LISTS = getcong('p-buzzylists');
$DB_PLUGIN_POLLS =getcong('p-buzzypolls');
$DB_PLUGIN_VIDEOS = getcong('p-buzzyvideos');
$DB_PLUGIN_QUIZS= getcong('p-buzzyquizzes');
$DB_PLUGIN_QUIZS=\App::getLocale();
?>
@extends("main")
@section('content')
     <main id="main">
               <div class="error-holder">
                  <div class="container">
                     <h1 class="wow zoomIn">404</h1>
                     <span class="title">Opps! You have reached the No Man’s Land!</span>
                     <form class="inner-search" action="#">
                        
                        <p>Sorry but the page your are looking for has been removed or had its name changed. Please use the links below to navigate your way out of here. Thank you!</p>
                     </form>
                     <div class="button-holder">
                        <a href="index-2.html" class="btn btn-md btn-white">go to homepage</a>
                        <a href="#" class="btn btn-md btn-white">go to previous page</a>
                     </div>
                  </div>
               </div>
            </main>
@endsection
