const firebaseConfig = {
    apiKey: "AIzaSyDD0WhpHeDpr8668FqTpfZ6dX__YDUS58w",
    authDomain: "tajeer-d1fc6.firebaseapp.com",
    projectId: "tajeer-d1fc6",
    storageBucket: "tajeer-d1fc6.appspot.com",
    messagingSenderId: "918314797844",
    appId: "1:918314797844:web:78cd8f41703980fb23d001",
    measurementId: "G-LN8FKZVGSN"
};
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

const registerServiceWorker = () => {
if ('serviceWorker' in navigator) {
  navigator.serviceWorker
    .register('/firebase-messaging-sw.js')
    .then(function (registration) {
      console.log('Registration successful, scope is:', registration.scope);
    })
    .catch(function (err) {
      console.log('Service worker registration failed, error:', err);
    });
}
};

registerServiceWorker();

if($(".is-auth").val() == "true") {


    messaging.getToken().then((currentToken) => {
        if (currentToken) {
            saveUserToken(currentToken)
        } else {
            console.log('No registration token available. Request permission to generate one.');
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
    });

    function saveUserToken(token) {
        $.ajax({
            url : "/account/fcm/register?token="+token,
            type:"get",
            success: function(data) {
                console.log(data)
            }
        })
    }

}