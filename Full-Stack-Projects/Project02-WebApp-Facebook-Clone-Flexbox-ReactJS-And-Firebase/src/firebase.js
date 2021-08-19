import firebase from 'firebase';

  // My credentials on firebase platform

    const firebaseApp = firebase.initializeApp({
    apiKey: "AIzaSyD8HPiAc5oEejGSrknZOcmCvPDzOOR3-tI",
    authDomain: "fb-clone-br2021.firebaseapp.com",
    projectId: "fb-clone-br2021",
    storageBucket: "fb-clone-br2021.appspot.com",
    messagingSenderId: "1054414396823",
    appId: "1:1054414396823:web:8fee3ec4d73fb3c6d638d2",
    measurementId: "G-65VBTZPG4S"
});

  //

const db = firebase.firestore();
const auth = firebase.auth();
const storage = firebase.storage();
const functions = firebase.functions();

export {db, auth, storage, functions};