@extends('layouts.root')

@section('my-header')

<style>
   .app-logo{
        width:70px; 
        height:70px; 
        box-shadow: 2px 2px 2px 2px rgb(229, 229, 229); 
        border-radius:10px;
   }

   .btn-app-download{
        background:#475692; 
        border-radius:3px; 
        padding:5px; 
        width:170px;
        float : right;
        font-size:13px;
   }
</style>
    
@endsection

@section('hero-content-overlay')
    <div class="hero-content-overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-content-wrap flex flex-column justify-content-center align-items-start">
                        <header class="entry-header">
                            <h4 style="color: #FF7156">For higher education of Myanmar</h4>
                            <h1>best online<br/>Learning Platform</h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <p>Welcome to Calamus Education. This is the online learning platform for those who want to study a specific subject systematically.
                                Now, we have offered courses for English and Korean Languages. And also, we are trying to offer Janpanese, Chinese and Russian. 
                            </p>
                        </div><!-- .entry-content -->

                        {{-- <footer class="entry-footer read-more">
                            <a href="#">read more</a>
                        </footer><!-- .entry-footer --> --}}
                    </div><!-- .hero-content-wrap -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .hero-content-hero-content-overlay -->

@endsection


@section('main-content')


    <section class="featured-courses  courses-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12" style="padding: 20px; margin-top:20px;">
                    <header class="heading flex justify-content-between align-items-center">
                        <h2 class="entry-title">Our Platforms</h2>
                    </header><!-- .heading -->
                </div><!-- .col -->

               
               <div class="col-12 col-lg-6" style="padding: 20px; margin-top:20px;">
                   <div class="flex ">
                        <div >
                            <img class="app-logo"  src="{{asset('public/images/icon_easy_english.png')}}"/>
                        </div>

                        <div style="margin-left: 20px;">
                             <h4 class="entry-title">English For Myanmar</h4>

                            <div class="flex align-items-center justify-content-between">
                                <div style="text-align: center">
                                    30k+<br>
                                    Students<br> Learning
                                </div>

                                <div style="text-align: center">
                                    3<br>
                                    Active <br>Courses
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>

                    <a href=""> ပိုမိုသိရှိရန် </a>

                    <a href="" style="text-decoration: none;">
                        <span class="flex  align-items-center btn-app-download">
                            <img src="{{asset('public/assets/img/google_play.png')}}" style="width:30px; height:30px;"/>
                            <span style="text-align: center;color:white;">Get it on Google Play</span>
                        </span>
                    </a>
                </div><!-- .col -->

                 
               <div class="col-12 col-lg-6" style="padding: 20px; margin-top:20px;">
                   <div class="flex ">
                        <div >
                            <img class="app-logo"  src="{{asset('public/images/icon_easy_korean.png')}}"/>
                        </div>

                        <div style="margin-left: 20px;">
                             <h4 class="entry-title">Korean For Myanmar</h4>

                            <div class="flex align-items-center justify-content-between">
                                <div style="text-align: center">
                                    60k+<br>
                                    Students<br> Learning
                                </div>

                                <div style="text-align: center">
                                    5<br>
                                    Active <br>Courses
                                </div>

                            </div>
                        </div>
                    </div>
                    <br>
                    <a href=""> ပိုမိုသိရှိရန် </a>
                    <a href="" style="text-decoration: none;">
                        <span class="flex  align-items-center btn-app-download">
                            <img src="{{asset('public/assets/img/google_play.png')}}" style="width:30px; height:30px;"/>
                            <span style="text-align: center;color:white;">Get it on Google Play</span>
                        </span>
                    </a>
                </div><!-- .col -->

            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .latest-news-events -->

    <section class="about-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 align-content-lg-stretch">
                    <header class="heading">
                        <h2 class="entry-title">About Calamus Education</h2>
                        <p>
                           Calamus Education သည် Online Learning Platform တစ်ခုဖြစ်ပြီး အင်္ဂလိပ် နှင့် ကိုရီးယား ဘာသာစကား သင်ခန်းစာများကို
                           သင်ကြားပေးလျက်ရှိပါသည်။ တရုတ်၊ ရုရှားနှင့် ဂျပန် ဘာသာစကားများကိုလည်း သင်ခန်းပေးနိုင်ရန် စီစဉ်‌ဆောင်ရွက်လျက်ရှိပါသည်။
                        </p>

                        <p>
                            အထက်ဖော်ပြပါ mobile application များကို download ရယူပြီး Calamus Education ၏ course များကို တက်ရောက်နိုင်ပါသည်။
                            အခမဲ့ Course များ၊ သင်ခန်းစာများလည်း  များစွာပါဝင်ပါသည်။
                        </p>
                    </header><!-- .heading -->

                    <div class="entry-content ezuca-stats">
                        <div class="stats-wrap flex flex-wrap justify-content-lg-between">
                            <div class="stats-count">
                                90<span>K+</span>
                                <p>STUDENTS LEARNING</p>
                            </div><!-- .stats-count -->

                            <div class="stats-count">
                                8
                                <p>ACTIVE COURSES</p>
                            </div><!-- .stats-count -->

                        </div><!-- .stats-wrap -->
                    </div><!-- .ezuca-stats -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 flex align-content-center mt-5 mt-lg-0">
                    <div class="ezuca-video position-relative">
                        <div class="video-play-btn position-absolute">
                            <img src="{{asset('public/images/video-icon.png')}}" alt="Video Play">
                        </div><!-- .video-play-btn -->

                        <img src="{{asset('public/images/video-screenshot.png')}}" alt="">
                    </div><!-- .ezuca-video -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .about-section -->

    <section class="featured-courses horizontal-column courses-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="heading flex justify-content-between align-items-center">
                        <h2 class="entry-title">Featured Courses</h2>
                        <nav class="courses-menu mt-3 mt-lg-0">
                            <ul class="flex flex-wrap justify-content-md-end align-items-center">
                                <li class="active"><a href="#">All</a></li>
                                <li><a href="#">Korean</a></li>
                                <li><a href="#">English</a></li>
                            </ul>
                        </nav><!-- .courses-menu -->
                    </header><!-- .heading -->
                </div><!-- .col -->
                
                @foreach ($courses as $course)
                    
                
                <div class="col-12 col-lg-6">
                    <div class="course-content">
                        <div style="background: {{$course->background_color}}; height:115px; display:flex">
                            <a href="#"><img src="{{$course->cover_url}}" style="margin-left: 20px; margin-top:15px; height:130px;" alt=""></a>
                            <div>
                                <header class="entry-header">
                                    <br>
                                    <h2 class="entry-title" style="color: white">{{$course->title}}
                                        <span style="font-size: 13px;"> - {{ucfirst ($course->major)}}</span>
                                    </h2>
                                    <div id="{{$course->course_id}}" style="color:white;width:100%;height:31px;">
                                        {{$course->description}} 
                                    </div>
                                        <script>
                                            function isElementOverflowing(element) {
                                                var overflowX = element.offsetWidth < element.scrollWidth,
                                                    overflowY = element.offsetHeight < element.scrollHeight;

                                                return (overflowX || overflowY);
                                            }

                                            function wrapContentsInMarquee(element) {
                                                var marquee = document.createElement('marquee'),
                                                contents = element.innerText;
                                                
                                            marquee.innerText = contents;
                                            element.innerHTML = '';
                                            element.appendChild(marquee);
                                            }

                                            var element = document.getElementById('{{$course->course_id}}');

                                            if (isElementOverflowing(element)) {
                                                wrapContentsInMarquee(element);
                                            }
                                        </script>
                                    <img src="{{asset('public/assets/svg/day_calendar.svg')}}"/> 
                                    <span style="color: white">{{$course->duration}} Days </span>
                                    
                                    {{-- <div class="course-ratings flex align-items-center">
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star-o"></span>

                                        <span class="course-ratings-count">(4 votes)</span>
                                    </div><!-- .course-ratings --> --}}
                                </header><!-- .entry-header -->
                            </div>
                        </div>
            
                        <div class="course-content-border">
                            <footer class="entry-footer flex justify-content-between align-items-center">
                                <div></div>
                                <a style="background: {{$course->background_color}};color:white; width:80px;text-align:center; padding:5px; border-radius:3px; text-decoration: none;" href="#">
                                    Detail
                                </a>

                            </footer><!-- .entry-footer -->
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->
                @endforeach
                
            </div><!-- .row -->
            <br><br>
            <div class="col-12 px-25 flex justify-content-center">
                <a class="btn" href="#">view all courses</a>
            </div><!-- .col -->
        </div><!-- .container -->
    </section><!-- .courses-wrap -->

   
    <section class="testimonial-section">
        <!-- Swiper -->
        <div class="swiper-container testimonial-slider">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="{{asset('public/images/user-1.jpg')}}" alt="">
                                </figure><!-- .user-avatar -->
                            </div><!-- .col -->

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>Together as teachers, students and universities we can help make this education available for everyone.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Russell Stephens - <span>University in UK</span></h3>
                                </div><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .swiper-slide -->

                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 order-2 order-lg-1 flex align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="{{asset('public/images/user-2.jpg')}}" alt="">
                                </figure><!-- .user-avatar -->
                            </div><!-- .col -->

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">Robert Stephens - <span>University in Oxford</span></h3>
                                </div><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .swiper-slide -->

                <div class="swiper-slide">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-lg-6 flex order-2 order-lg-1 align-items-center mt-5 mt-lg-0">
                                <figure class="user-avatar">
                                    <img src="{{asset('public/images/user-3.jpg')}}" alt="">
                                </figure><!-- .user-avatar -->
                            </div><!-- .col -->

                            <div class="col-12 col-lg-6 order-1 order-lg-2 content-wrap h-100">
                                <div class="entry-content">
                                    <p>Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                </div><!-- .entry-content -->

                                <div class="entry-footer">
                                    <h3 class="testimonial-user">James Stephens - <span>University in Cambridge</span></h3>
                                </div><!-- .entry-footer -->
                            </div><!-- .col -->
                        </div><!-- .row -->
                    </div><!-- .container -->
                </div><!-- .swiper-slide -->
            </div><!-- .swiper-wrapper -->

            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                        <div class="swiper-pagination position-relative flex justify-content-center align-items-center"></div>
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .testimonial-slider -->
    </section><!-- .testimonial-section -->

    
    <section class="latest-news-events">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="heading flex justify-content-between align-items-center">
                        <h2 class="entry-title">Latest News & Events</h2>
                    </header><!-- .heading -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6">
                    <div class="featured-event-content">
                        <figure class="event-thumbnail position-relative m-0">
                            <a href="#"><img src="{{asset('public/images/event-1.jpg')}}" alt=""></a>

                            <div class="posted-date position-absolute">
                                <div class="day">23</div>
                                <div class="month">mar</div>
                            </div><!-- .posted-date -->
                        </figure><!-- .event-thumbnail -->

                        <header class="entry-header flex flex-wrap align-items-center">
                            <h2 class="entry-title"><a href="#">The Complete Financial Analyst Training & Investing Course</a></h2>

                            <div class="event-location"><i class="fa fa-map-marker"></i>40 Baria Sreet 133/2 NewYork City, US</div>

                            <div class="event-duration"><i class="fa fa-calendar"></i>10 Dec - 12 dec</div>
                        </header><!-- .entry-header -->
                    </div><!-- .featured-event-content -->
                </div><!-- .col -->

                <div class="col-12 col-lg-6 mt-5 mt-lg-0">
                    <div class="event-content flex flex-wrap justify-content-between align-content-stretch">
                        <figure class="event-thumbnail">
                            <a href="#"><img src="{{asset('public/images/event-2.jpg')}}" alt=""></a>
                        </figure><!-- .course-thumbnail -->

                        <div class="event-content-wrap">
                            <header class="entry-header">
                                <div class="posted-date">
                                    <i class="fa fa-calendar"></i> 22 Mar 2018
                                </div><!-- .posted-date -->

                                <h2 class="entry-title"><a href="#">Personalized online learning experience</a></h2>

                                <div class="entry-meta flex flex-wrap align-items-center">
                                    <div class="post-author"><a href="#">Ms. Lara Croft </a></div>

                                    <div class="post-comments">02 Comments  </div>
                                </div><!-- .entry-meta -->
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                            </div><!-- .entry-content -->
                        </div><!-- .event-content-wrap -->
                    </div><!-- .event-content -->

                    <div class="event-content flex flex-wrap justify-content-between align-content-lg-stretch">
                        <figure class="event-thumbnail">
                            <a href="#"><img src="{{asset('public/images/event-3.jpg')}}" alt=""></a>
                        </figure><!-- .course-thumbnail -->

                        <div class="event-content-wrap">
                            <header class="entry-header">
                                <div class="posted-date">
                                    <i class="fa fa-calendar"></i> 22 Mar 2018
                                </div><!-- .posted-date -->

                                <h2 class="entry-title"><a href="#">Which investment project should my company choose?</a></h2>

                                <div class="entry-meta flex flex-wrap align-items-center">
                                    <div class="post-author"><a href="#">Ms. Lara Croft </a></div>

                                    <div class="post-comments">02 Comments  </div>
                                </div><!-- .entry-meta -->
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                            </div><!-- .entry-content -->
                        </div><!-- .event-content-wrap -->
                    </div><!-- .event-content -->
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .latest-news-events -->

@endsection