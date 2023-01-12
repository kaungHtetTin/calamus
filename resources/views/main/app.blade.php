@extends('layouts.app-root')

@section('my-header')

<style>

   .app-logo{
        width:100px; 
        height:100px; 
        box-shadow: 2px 2px 2px 2px rgba(229, 229, 229, 0.041); 
        border-radius:10px;
   }

    .page-header {
        background-size: cover !important;
        background: url("{{$app->cover}}") no-repeat center;
    }

    .page-header-overlay {
        background: rgba(21,20,33,.5);
        height: 390px;
        padding-top: 236px;
       
    }

    .page-header h1 {
        font-size: 48px;
        font-weight: 500;
        color: #fff;
        
    }

    .status{
        padding:20px;
        width: 80%;
        margin: auto;
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
<div class="page-header">
    <div class="page-header-overlay">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="align-items-center" style="display: flex">
                            <img class="app-logo" src="{{$app->icon}}"/>
                            <header style="color: white;margin-left:25px;">
                                <h1>{{$app->name}}</h1>
                                <h4>{{$app->description}}</h4>
                            </header><!-- .entry-header -->
                    </div>
                    <a href="{{$app->url}}" style="text-decoration: none;">
                        <span class="flex  align-items-center btn-app-download">
                            <img src="{{asset('public/assets/img/google_play.png')}}" style="width:30px; height:30px;"/>
                            <span style="text-align: center;color:white;">Get it on Google Play</span>
                        </span>
                    </a>
                </div><!-- .col -->
            </div><!-- .row -->
        </div><!-- .container -->
    </div><!-- .page-header-overlay -->
</div><!-- .page-header -->

@endsection


@section('main-content')

     <div class="icon-boxes">
        <div class="container-fluid">
            <div class="flex flex-wrap align-items-stretch">
                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-user"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Students Learning</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>More than {{$app->student_learning}} are learning on this platform.</p>
                    </div><!-- .entry-content -->

                </div><!-- .icon-box -->

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-folder"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Courses</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>{{$app->active_course}} active courses are now available.</p>
                    </div><!-- .entry-content -->

                </div><!-- .icon-box -->

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-book"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Additional Lessons</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>It also freely supports many additional lessons.</p>
                    </div><!-- .entry-content -->

                </div><!-- .icon-box -->

                <div class="icon-box">
                    <div class="icon">
                        <span class="ti-world"></span>
                    </div><!-- .icon -->

                    <header class="entry-header">
                        <h2 class="entry-title">Discussion</h2>
                    </header><!-- .entry-header -->

                    <div class="entry-content">
                        <p>Find new friends and discuss with them.</p>
                    </div><!-- .entry-content -->

                </div><!-- .icon-box -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </div><!-- .icon-boxes -->


    <section class="featured-courses horizontal-column courses-wrap">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <header class="heading flex justify-content-between align-items-center">
                        <h2 class="entry-title">Featured Courses</h2>
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
                                <div class="course-cost">
                                    <span class="free-cost" style="color:{{$course->background_color}}">{{$course->fee}}</span>
                                </div><!-- .course-cost -->
                                <a style="background: {{$course->background_color}};color:white; width:80px;text-align:center; padding:5px; border-radius:3px; text-decoration: none;" href="#">
                                    Detail
                                </a>

                            </footer><!-- .entry-footer -->
                        </div><!-- .course-content-wrap -->
                    </div><!-- .course-content -->
                </div><!-- .col -->
                @endforeach
                
            </div><!-- .row -->
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

 {{-- Pricing --}}

    <section class="latest-news-events">
        <div class="container">
            <header class="heading flex justify-content-between align-items-center">
                <h2 class="entry-title">VIP Registration</h2>
            </header><!-- .heading -->
            <?php echo $pricing ?>
        </div><!-- .container -->
    </section><!-- .latest-news-events -->

@endsection