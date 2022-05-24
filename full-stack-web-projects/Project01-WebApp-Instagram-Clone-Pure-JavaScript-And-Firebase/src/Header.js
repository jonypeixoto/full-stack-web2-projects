import {useEffect, useState} from 'react';
import firebase from 'firebase';
import {auth,storage,db} from './firebase.js';
function Header(props){

    const [progress,setProgress] = useState(0);

    const [file, setFile] = useState(null);

    useEffect(() => {

    }, [])

    function createAccount(e){
        
        e.preventDefault();
        let email = document.getElementById('email-register').value;
        let username = document.getElementById('username-register').value;
        let password = document.getElementById('password-register').value;

        // Create firebase account;
        auth.createUserWithEmailAndPassword(email,password)
        .then((authUser)=>{
            authUser.user.updateProfile({
                displayName: username
            })
            alert('Account created successfully!');
            let modal = document.querySelector('.modalCreateAccount');

            modal.style.display = "none";
        }).catch((error)=>{
            alert(error.message);
        })
        ;



    }

    function log(e){
        e.preventDefault();
        let email = document.getElementById('email-login').value;
        let password = document.getElementById('password-login').value;

        auth.signInWithEmailAndPassword(email,password)
        .then((auth)=>{
            //For know the username of the each user
            props.setUser(auth.user.displayName);
            alert('Successfully logged in!');
            window.location.href = "/";
        }).catch((err)=>{
            alert(err.message);
        })
        
    }

    function openModalCreateAccount(e){
        e.preventDefault();

        let modal = document.querySelector('.modalCreateAccount');

        modal.style.display = "block";
    
    }

    function openModalUpload(e){
        e.preventDefault();

        let modal = document.querySelector('.modalUpload');

        modal.style.display = "block";
    }

    function closeModalCreate(){
        let modal = document.querySelector('.modalCreateAccount');

        modal.style.display = "none";
    }

    function closeModalUpload(){
        let modal = document.querySelector('.modalUpload');

        modal.style.display = "none";
    }

    function logout(e){
        e.preventDefault();
        auth.signOut().then(function(val){
            props.setUser(null);
            window.location.href = "/";
        })
    }

    function uploadPost(e){
        e.preventDefault();
        let titlePost = document.getElementById('title-upload').value;


        const uploadTask = storage.ref(`images/${file.name}`).put(file);

        uploadTask.on("state_changed",function(snapshot){
            const progress = Math.round(snapshot.bytesTransferred/snapshot.totalBytes) * 100;
            setProgress(progress);
        },function(error){

        }, function(){

            storage.ref("images").child(file.name).getDownloadURL()
            .then(function(url){
                db.collection('posts').add({
                    title: titlePost,
                    image: url,
                    userName: props.user,
                    timestamp: firebase.firestore.FieldValue.serverTimestamp()
                })

                setProgress(0);
                setFile(null);

                alert('Successful upload!');

                document.getElementById('form-upload').reset();
                closeModalUpload();

            })

        })

    }

    return (

<div className="header">

    <div className="modalCreateAccount">
        <div className="formCreateAccount">
            <div onClick={()=>closeModalCreate()}className="close-modal-create">X</div>
            <h2>Create Account</h2>
            <form onSubmit={(e)=>createAccount(e)}>
                <input id="email-register" type="text" placeholder="Your e-mail..." />
                <input id="username-register" type="text" placeholder="Your username..." />
                <input id="password-register" type="password" placeholder="Your password..." />
                <input type="submit" value="Create Account!" />
            </form>
        </div>
    </div>

    <div className="modalUpload">
        <div className="formUpload">
            <div onClick={()=>closeModalUpload()} className="close-modal-create">X</div>
            <h2>Upload</h2>
            <form id="form-upload" onSubmit={(e)=>uploadPost(e)}>
                <progress id="progress-upload" value={progress}></progress>
                <input id="title-upload" type="text" placeholder="Name of your photo..." />
                <input onChange={(e)=>setFile(e.target.files[0])} type="file" name="file" />
                <input type="submit" value="Post on Instagram!" />
            </form>
        </div>
    </div>

    <div className="center">
        <div className="header__logo">
            <a href=""><img src="https://www.instagram.com/static/images/web/mobile_nav_type_logo.png/735145cfe0a4.png" /></a>
        </div>
        {
        (props.user)?
        <div className="header__loggedInfo">
            <span>Hello, <b>{props.user}</b></span>
            <a onClick={(e)=>openModalUpload(e)} href="#">Post!</a>
            <a onClick={(e)=>logout(e)}>Log out</a>
        </div>
        :
        <div className="header__loginForm">
            <form onSubmit={(e)=>log(e)}>
                <input id="email-login" type="text" placeholder="Login..." />
                <input id="password-login" type="password" placeholder="Password..." />
                <input type="submit" name="action" value="Log into!" />
            </form>
            <div className="btn__createCccount">
            <a onClick={(e)=>openModalCreateAccount(e)} href="#">Create Account!</a>
            </div>
        </div>
        }
    </div>
    
</div>

)

}


export default Header;