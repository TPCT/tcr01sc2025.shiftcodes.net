    @if(count($faq) > 0)
    <section class="home__features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home__brands_title">
                        <h3>{{__('lang.FAQ')}}</h3>

                    </div>
      
                </div>

                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">
                        @foreach($faq as $f)
                        <div class="card">
                          <div class="card-header" id="headingOne{{$f->id}}">
                            <h2 class="mb-0">
                              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$f->id}}" aria-expanded="true" aria-controls="collapseOne{{$f->id}}">
                                {{$f->question}}
                                <i class="fa fa-angle-down"></i>
                              </button>
                            </h2>
                          </div>
                      
                          <div id="collapseOne{{$f->id}}" class="collapse" aria-labelledby="headingOne{{$f->id}}" data-parent="#accordionExample">
                            <div class="card-body">
                                {{$f->answer}}
                                
                            </div>
                          </div>
                        </div>
                        @endforeach
                    </div>
                </div>

             
            </div>
        </div>
    </section>
    @endif