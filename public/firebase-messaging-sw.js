importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.0/firebase-messaging.js');
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
// Initialize Firebase
const messaging = firebase.messaging();