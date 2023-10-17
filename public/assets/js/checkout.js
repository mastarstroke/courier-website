$(document).ready(function() {
    $('.razorpay_btn').click(function (e){
        e.preventDefault();

        var name = $('.name').val();
        var email = $('.email').val();
        var gender = $('.gender').val();
        var address = $('.address').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var country = $('.country').val();
        var postcode = $('.postcode').val();
        var phone = $('.phone').val();
        var price = $('.price').val();
        var currency = $('.currency').val();

        if(!name)
        {
            name_error = "Name is required";
            $('#name_error').html('');
            $('#name_error').html(name_error);
        }
        else{
            name_error = "";
            $('#name_error').html('');
        }


        if(!email)
        {
            email_error = "Email is required";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        }
        else{
            email_error = "";
            $('#email_error').html('');
        }


        if(!phone)
        {
            phone_error = "Phone Number is required";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        }
        else{
            phone_error = "";
            $('#phone_error').html('');
        }

        if(!gender)
        {
            gender_error = "Gender is required";
            $('#gender_error').html('');
            $('#gender_error').html(gender_error);
        }
        else{
            gender_error = "";
            $('#gender_error').html('');
        }


        if(!address)
        {
            address_error = "Address is required";
            $('#address_error').html('');
            $('#address_error').html(address_error);
        }
        else{
            address_error = "";
            $('#address_error').html('');
        }


        if(!city)
        {
            city_error = "city is required";
            $('#city_error').html('');
            $('#city_error').html(city_error);
        }
        else{
            city_error = "";
            $('#city_error').html('');
        }


        if(!state)
        {
            state_error = "State is required";
            $('#state_error').html('');
            $('#state_error').html(state_error);
        }
        else{
            state_error = "";
            $('#state_error').html('');
        }


        if(!country)
        {
            country_error = "Country is required";
            $('#country_error').html('');
            $('#country_error').html(country_error);
        }
        else{
            country_error = "";
            $('#country_error').html('');
        }


        if(!postcode)
        {
            postcode_error = "Postcode is required";
            $('#postcode_error').html('');
            $('#postcode_error').html(postcode_error);
        }
        else{
            postcode_error = "";
            $('#postcode_error').html('');
        }

        if(name_error != '' || email_error != '' || phone_error != '' || gender_error != '' || address_error != '' || city_error != '' || state_error != '' || country_error != '' || postcode_error != '')
        {
            return false;
        }
        else
        {

            var data = {
                'name':name, 
                'email':email,
                'phone':phone,
                'gender':gender,
                'address':address,
                'city':city,
                'state':state,
                'country':country,
                'postcode':postcode,
                'price':price,
                'currency':currency
            }

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                url: "/razorpay-payment",
                data: data,
                success: function (response){
                    // alert(response.price)
                    var options = {
                        "key": "rzp_test_9IW0r1pYhkCFAJ", // Enter the Key ID generated from the Dashboard
                        "amount": response.price*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": response.currency,
                        "name": response.name,
                        "description": "Thank you for choosing us",
                        "image": "https://example.com/your_logo",
                        //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (responsea){
                            alert(responsea.razorpay_payment_id);
                            
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                method: "POST",
                                url: "/razorpay/callback",
                                data: {
                                    'name':response.name, 
                                    'email':response.email,
                                    'phone':response.phone,
                                    'gender':response.gender,
                                    'address':response.address,
                                    'city':response.city,
                                    'state':response.state,
                                    'country':response.country,
                                    'postcode':response.postcode,
                                    'payment_mode':"RazorPay",
                                    'payment_id':responsea.razorpay_payment_id,
                                },
                                success: function(responseb){
                                    swal(responseb.success);
                                    // window.location.href = "/myorders";
                                }
                            });
                        },
                        "prefill": {
                            "name": response.name,
                            "email": response.email,
                            "contact": response.phone,
                        },
                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);     
                        rzp1.open();
                }
            });
        }
    });
});