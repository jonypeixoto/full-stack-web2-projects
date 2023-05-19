import * as firebase from 'firebase';
import 'firebase/firestore';
import 'firebase/auth';

const firebaseConfig = {
    apiKey: "AIzaSyB8bMtzpGMnRZomG8hgG_Lu_6R4NHRVboE",
    authDomain: "instagram-clone-br2021.firebaseapp.com",
    projectId: "instagram-clone-br2021",
    storageBucket: "instagram-clone-br2021.appspot.com",
    messagingSenderId: "598576773658",
    appId: "1:598576773658:web:81f19524062e481eb1efa3",
    measurementId: "G-0SP367TRFM"
  };

// Initialize Firebase
const firebaseApp = firebase.initializeApp(firebaseConfig);

const db = firebaseApp.firestore();

const auth = firebase.auth();

export{auth};
export default db;
