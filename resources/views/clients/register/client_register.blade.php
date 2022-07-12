@extends('layouts.dashboard')

@section('content')
<!-- MultiStep Form -->
<div class="container-fluid" id="grad1">
    <div class="row justify-content-center mt-0">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2><strong>Sign Up Your User Account</strong></h2>
                <p>Fill all form field to go to next step</p>
                <div class="row">
                    <div class="col-md-12 mx-0">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="progressbar">
                                <li class="active" id="account"><strong>Account</strong></li>
                                <li id="personal"><strong>Personal</strong></li>
                                <li id="payment"><strong>Payment</strong></li>
                                <li id="confirm"><strong>Finish</strong></li>
                            </ul>
                            <!-- fieldsets -->
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Account Information</h2>
                                    <input type="email" name="email" placeholder="Email Id"/>
                                    <input type="text" name="uname" placeholder="UserName"/>
                                    <input type="password" name="pwd" placeholder="Password"/>
                                    <input type="password" name="cpwd" placeholder="Confirm Password"/>
                                </div>
                                <input type="button" name="next" class="next action-button" value="Next Step"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Personal Information</h2>
                                    <input type="text" name="fname" placeholder="First Name"/>
                                    <input type="text" name="lname" placeholder="Last Name"/>
                                    <input type="text" name="phno" placeholder="Contact No."/>
                                    <input type="text" name="phno_2" placeholder="Alternate Contact No."/>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="next" class="next action-button" value="Next Step"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title">Payment Information</h2>
                                    <div class="radio-group">
                                        <div class='radio' data-value="credit"><img src="https://i.imgur.com/XzOzVHZ.jpg" width="200px" height="100px"></div>
                                        <div class='radio' data-value="paypal"><img src="https://i.imgur.com/jXjwZlj.jpg" width="200px" height="100px"></div>
                                        <br>
                                    </div>
                                    <label class="pay">Card Holder Name*</label>
                                    <input type="text" name="holdername" placeholder=""/>
                                    <div class="row">
                                        <div class="col-9">
                                            <label class="pay">Card Number*</label>
                                            <input type="text" name="cardno" placeholder=""/>
                                        </div>
                                        <div class="col-3">
                                            <label class="pay">CVC*</label>
                                            <input type="password" name="cvcpwd" placeholder="***"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3">
                                            <label class="pay">Expiry Date*</label>
                                        </div>
                                        <div class="col-9">
                                            <select class="list-dt" id="month" name="expmonth">
                                                <option selected>Month</option>
                                                <option>January</option>
                                                <option>February</option>
                                                <option>March</option>
                                                <option>April</option>
                                                <option>May</option>
                                                <option>June</option>
                                                <option>July</option>
                                                <option>August</option>
                                                <option>September</option>
                                                <option>October</option>
                                                <option>November</option>
                                                <option>December</option>
                                            </select>
                                            <select class="list-dt" id="year" name="expyear">
                                                <option selected>Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
                                <input type="button" name="make_payment" class="next action-button" value="Confirm"/>
                            </fieldset>
                            <fieldset>
                                <div class="form-card">
                                    <h2 class="fs-title text-center">Success !</h2>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-3">
                                            <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                                        </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                        <div class="col-7 text-center">
                                            <h5>You Have Successfully Signed Up</h5>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script>
            
        hideAgency();

        function showAgency(){
            $("#id_agency").show();
        }

        function hideAgency(){
            $("#id_agency").hide();
        }

        function sendForm(){
            document.getElementById("regForm").submit();
        }

        $("#id_country_received").on('change',function(){
            
            var country_id = $(this).val();
            $("#city").val("");
            getCities(country_id);
        });

        function getCities(country_id){
            
            $.ajax({
                url:"{{ route('cities.list','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    let city = $("#city");
                    let htmlOptions = `<option value='' >Seleccione Ciudad..</option>`;
                    // console.clear();
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,name} = item;
                            htmlOptions += `<option value='${id}' {{ old('City') == '${id}' ? 'selected' : '' }}>${name}</option>`

                        });
                    }
                    //console.clear();
                    // console.log(htmlOptions);
                   city.html('');
                   city.html(htmlOptions);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

        
        $("#id_country").on('change',function(){
            
            var country_id = $(this).val();
            $("#code_phone").val("");
          
            getCodePhone(country_id);
            getMakingCodes(country_id);
        });

        function getCodePhone(country_id){
            
            $.ajax({
                url:"{{ route('countries.listCodePhone','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,name,code_phone} = item;
                            document.getElementById('code_phone_room').value = code_phone;
                            document.getElementById('code_phone_work').value = code_phone;
                            document.getElementById('code_phone_mobile').value = code_phone;
                            document.getElementById('code_phone_fax').value = code_phone;
                        });
                    }
                   
                },
                error:(xhr)=>{
                    alert('No se encontro los datos');
                }
            })
        }

        function getMakingCodes(country_id){
            
            $.ajax({
                url:"{{ route('countries.listMakingCodes','') }}" + '/' + country_id,
                beforSend:()=>{
                    alert('consultando datos');
                },
                success:(response)=>{
                   
                    let code_room = $("#id_code_room");
                    let htmlOptions = `<option value='' >Codigo</option>`;

                    let code_work = $("#id_code_work");
                    let htmlOptions2 = `<option value='' >Codigo</option>`;

                    let code_mobile = $("#id_code_mobile");
                    let htmlOptions3 = `<option value='' >Codigo</option>`;
                    
                    let code_fax = $("#id_code_fax");
                    let htmlOptions4 = `<option value='' >Codigo</option>`;
                    
                    if(response.length > 0){
                        response.forEach((item, index, object)=>{
                            let {id,code} = item;
                            htmlOptions += `<option value='${id}' {{ old('id_code_room') == '${code}' ? 'selected' : '' }}>${code}</option>`
                            htmlOptions2 += `<option value='${id}' {{ old('id_code_work') == '${code}' ? 'selected' : '' }}>${code}</option>`
                            htmlOptions3 += `<option value='${id}' {{ old('id_code_mobile') == '${code}' ? 'selected' : '' }}>${code}</option>`
                            htmlOptions4 += `<option value='${id}' {{ old('id_code_fax') == '${code}' ? 'selected' : '' }}>${code}</option>`

                        });
                    }
                   
                   code_room.html('');
                   code_room.html(htmlOptions);

                   code_work.html('');
                   code_work.html(htmlOptions2);

                   code_mobile.html('');
                   code_mobile.html(htmlOptions3);

                   code_fax.html('');
                   code_fax.html(htmlOptions4);
                
                    
                
                },
                error:(xhr)=>{
                    alert('Presentamos inconvenientes al consultar los datos');
                }
            })
        }

    </script>
@endsection