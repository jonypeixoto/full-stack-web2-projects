import firebase from 'firebase';

const firebaseApp = firebase.initializeApp({

  // My credentials on firebase platform

    apiKey: "AIzaSyB8bMtzpGMnRZomG8hgG_Lu_6R4NHRVboE",
    authDomain: "instagram-clone-br2021.firebaseapp.com",
    projectId: "instagram-clone-br2021",
    storageBucket: "instagram-clone-br2021.appspot.com",
    messagingSenderId: "598576773658",
    appId: "1:598576773658:web:81f19524062e481eb1efa3",
    measurementId: "G-0SP367TRFM"

  //
  
  });

const db = firebase.firestore();
const auth = firebase.auth();
const storage = firebase.storage();
const functions = firebase.functions();

export {db, auth, storage, functions};