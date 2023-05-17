import * as firebase from 'firebase';
import 'firebase/firestore';

const firebaseApp = firebase.initializeApp({
    apiKey: "AIzaSyBif5pT_oUWtsqWsU979cqmZk3UVt_xy1s",
    authDomain: "portalnews-f1d3b.firebaseapp.com",
    databaseURL: "https://portalnews-f1d3b-default-rtdb.firebaseio.com/",
    projectId: "portalnews-f1d3b",
    storageBucket: "portalnews-f1d3b.appspot.com",
    messagingSenderId: "606364399985",
    appId: "1:606364399985:web:e61dc62c1fd77e641aded0"
});

const db = firebase.firestore();

export {db};
