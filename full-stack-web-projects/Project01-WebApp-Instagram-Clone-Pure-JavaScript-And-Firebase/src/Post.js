import {db} from './firebase.js';
import firebase from 'firebase';
import {useEffect, useState} from 'react';

function Post(props){

    const [comments,setComments] = useState([]);

    useEffect(() => {
      db.collection('posts').doc(props.id).collection('comments').orderBy('timestamp','desc').onSnapshot(function(snapshot){
        setComments(snapshot.docs.map(function(document){
          return {id:document.id,info:document.data()}
        }))
      })
    
    }, [])

    function comment(id, e){
        e.preventDefault();
       
        let currentComment = document.querySelector('#comment-'+id).value;
        
        db.collection('posts').doc(id).collection('comments').add({
            name:props.user,
            comment: currentComment,
            timestamp: firebase.firestore.FieldValue.serverTimestamp()
        });

        alert('Comment made successfully!');

        document.querySelector('#comment-'+id).value = "";

      }

    return (
        <div className="postSingle">
            <img src={props.info.image} />
            <p><b>{props.info.userName}</b>: {props.info.title}</p>

            <div className="coments">
              <h2>Latest comments:</h2>
              {
                comments.map(function(val){
                  return(
                    <div className="comment-single">
                      <p><b>{val.info.name}</b>: {val.info.comment}</p>
                    </div>
                  )
                })
              }

            </div>

            {
            (props.user)?
            <form onSubmit={(e)=>comment(props.id,e)}>
              <textarea id={"comment-"+props.id}></textarea>
              <input type="submit" value="Comment!" />
            </form>
            :
            <div></div>
            }
          </div>
    )

}

export default Post;