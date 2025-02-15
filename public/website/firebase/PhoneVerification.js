
    

    if($(".phone-body").length) {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
        'size': 'invisible',
        'callback': (response) => {}
    });
  }
  
      function sendOTP(phoneNumber) {
        const appVerifier = window.recaptchaVerifier;
        firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
          .then((confirmationResult) => {
            window.confirmationResult = confirmationResult;
            $("#phone-verify-form").hide();
            $("#code-verify-form").show();
          }).catch((error) => {
            alert(error)
          });
      }


      $("#phone-verify-form").on("submit", function(e) {
        e.preventDefault();
        $("#phone-verify-form").find('#sign-in-button').css('opacity', '0.5');
        $("#phone-verify-form").find('#sign-in-button').append('...')
        sendOTP($("#phone-prefix").val() + $("#phone").val());
      })

      $("#code-verify-form").on("submit", function(e) {
            e.preventDefault();
            var code = $("#code").val()
            window.confirmationResult.confirm(code).then((result) => {
                verifyUser();
            }).catch((error) => {
                $(".verification-error").show()
                $("#code").val('')
            });
      });

      function verifyUser() {
        $.ajax({
            url: '/account/verify',
            type: 'get',
            success: function(data) {
                if(data.status == "success") {
                    window.location.href = "/"
                }
            }
        })
      }