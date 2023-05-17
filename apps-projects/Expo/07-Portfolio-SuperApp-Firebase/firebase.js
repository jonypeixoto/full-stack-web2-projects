import * as firebase from 'firebase';
import 'firebase/firestore';

const firebaseApp = firebase.initializeApp({  
    apiKey: "AIzaSyCkJRgM4xBjcxw6kpANSd9a4hjMeglZvG0",
    authDomain: "superapp-portfolio.firebaseapp.com",
    databaseURL: "https://superapp-portfolio-default-rtdb.firebaseio.com",
    projectId: "superapp-portfolio",
    storageBucket: "superapp-portfolio.appspot.com",
    messagingSenderId: "63468020179",
    appId: "1:63468020179:web:d00c5d51fe329979ba8f26",
    measurementId: "G-RLYNRXHZKN"
});

const db = firebase.firestore();

export {db};

