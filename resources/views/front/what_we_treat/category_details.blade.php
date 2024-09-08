@extends('front.layout_blog.master')
@section('main_content')

    <div class="home-banner-section about-banner-section">
        <div class="container">
            <div class="breadcrumb-section">
                <ul>
                    <li><a href="{{url('/')}}">Home <i class="fa fa-angle-right"></i></a> </li>
                    <li><a href="{{url('/')}}/what-we-treat">What We Treat <i class="fa fa-angle-right"></i></a> </li>

                    <li><a class="active" href="#">{{isset($arr_category_details['category_details']['name'])?decrypt_value($arr_category_details['category_details']['name']):''}}</a> </li>
                </ul>

            </div>
            <div class="about-banner-title">{{isset($arr_category_details['category_details']['name'])?decrypt_value($arr_category_details['category_details']['name']):''}}</div>
        </div>
    </div>

    <div class="skin-grey-bck skin-tab-box">
        <div class="container">
            @if(isset($arr_category_details['is_investigation_details']) && $arr_category_details['is_investigation_details']=='Yes')
                <div class="left-tab-main-div">
                    <div data-responsive-tabs>
                        <nav>
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                <div class="left-bar-skin">
                                    <ul>
                                        <li> <a href="#one"><span class="skin-left-img"></span>Common Skin Conditions</a></li>
                                        <li><a href="#two"> <span class="skin-left-img Sym"></span>Symptoms</a></li>
                                        <li><a href="#three"> <span class="skin-left-img com"></span>Causes</a></li>
                                        <li><a href="#four"> <span class="skin-left-img tre"></span>Treatment &amp; Prevention</a></li>
                                    </ul>
                                </div>
                            </div>
                        </nav>

                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <div class="content">

                                <section id="one">
                                    <div class="right-bar-skin">
                                        {!! isset($arr_category_details['common'])?decrypt_value($arr_category_details['common']):'' !!}
                                    </div>
                                </section>

                                <section id="two">
                                    <div class="right-bar-skin">
                                        {!! isset($arr_category_details['symptoms'])?decrypt_value($arr_category_details['symptoms']):'' !!}
                                    </div>
                                </section>

                                <section id="three">
                                    <div class="right-bar-skin">
                                       {!! isset($arr_category_details['causes'])?decrypt_value($arr_category_details['causes']):'' !!}
                                    </div>
                                </section>

                                <section id="four">
                                    <div class="right-bar-skin">
                                        {!! isset($arr_category_details['treatment_prevention'])?decrypt_value($arr_category_details['treatment_prevention']):'' !!}
                                    </div>
                                </section>

                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            @endif

            @if(isset($arr_category_details['is_investigation_details']) && $arr_category_details['is_investigation_details']=='No')
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div class="content">
                        {!! isset($arr_category_details['description'])?decrypt_value($arr_category_details['description']):'' !!}
                    </div>
                </div>
            @endif
        </div>

        @if(isset($arr_subcategory) && sizeof($arr_subcategory)>0)
        <div class="related-category-section">
            <div class="container">
               {{--  <div class="related-category-title">Related {{isset($arr_category_details['category_details']['name'])?decrypt_value($arr_category_details['category_details']['name']):''}}</div> --}}
                <div class="what-we-treat-img-grid">
                    <div class="row">
                        @foreach($arr_subcategory as $subcategory)
                         <div class="what-we-treat-1">    
                            <a href="{{$module_url_path}}/{{$subcategory['slug']}}">
                                
                                    <?php
                                     $image = get_resized_image($subcategory['image'], $subcategory_img_base_path, 233, 263 );
                                    ?>
                                    <img src="{{$image}}" alt="{{isset($subcategory['name'])?decrypt_value($subcategory['name']):'-'}}" />


                                    <p>{{isset($subcategory['name'])?decrypt_value($subcategory['name']):'-'}}</p>
                                  </a>
                                </div>
                          
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    @include('common.responsivetabs')

     <script>
        $(document).ready(function() {
            $(document).on('responsive-tabs.initialised', function(event, el) {
                console.log(el);
            });

            $(document).on('responsive-tabs.change', function(event, el, newPanel) {
                console.log(el);
                console.log(newPanel);
            });

            $('[data-responsive-tabs]').responsivetabs({
                initialised: function() {
                    console.log(this);
                },

                change: function(newPanel) {
                    console.log(newPanel);
                }
            });
        });
    </script>

@endsection