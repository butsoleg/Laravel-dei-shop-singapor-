<div class="modal fade" id="change_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel"> Change Card </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="my_address">

                        @foreach(@$cards as $key=>$card)
                            <div class="cards_box card_div @if($key == 0) selected_card @endif">
                                <div class="hiddenCard" style="display:none;">
                                     <div class="row">
                                    <div class="col-md-12 col-sm-12 centerFlex">
                                        <div class="tick d-inline-block">
                                            <input type="hidden" name="card_id" value="{{@$card->id}}"/>

                                              @if($card->brand == 'Visa')
                                                    <img src="{{asset('client/images/visa.png')}}">
                                                @else
                                                    <img src="{{asset('client/images/master_card.png')}}">
                                                @endif
                                            <!-- <img src="{{ asset('client/images/card.png') }}" width="80"> -->
                                        </div>
                                        <div class="card_deatil d-inline-block align-top">
                                            <h5>{{ @$card->brand  }} <span>**** **** **** {{ @$card->last4 }}</span></h5>
                                            <p class="cardAddressname"></p>
                                            
                                            <p>{{ @$card->exp_year }}/{{ @$card->exp_month }}</p>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                                <div class="row">
                                    <div class="col-md-10 col-sm-10">
                                        <div class="tick d-inline-block">
                                             @if($card->brand == 'Visa')
                                                    <img src="{{asset('client/images/visa.png')}}">
                                                @else
                                                    <img src="{{asset('client/images/master_card.png')}}">
                                                @endif
                                        </div>
                                        <div class="card_deatil d-inline-block align-top">
                                              <h5>{{ @$card->brand  }} <span>**** **** **** {{ @$card->last4 }}</span></h5>
                                                <p>{{$card->description}}</p>
                                                <p>{{$card->exp_month}}/{{$card->exp_year}}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-2 text-right">
                                        <div class="tick">
                                            <i class="mdi mdi-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        @endforeach
                      
                        <div class="text-right">
                            <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#add_card"> Add New Card </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>