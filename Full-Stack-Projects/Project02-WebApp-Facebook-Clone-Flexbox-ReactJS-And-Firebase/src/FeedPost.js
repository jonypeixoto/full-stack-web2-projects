import profile from './resources/profile.png';
export default function(props){
    return(
        <div className="feedPosts">

            <div className="feedPostSingle">
                <div className="feedPost__profile">
                <img src={profile} />
                <h3>{props.name}<br /><span>{props.hour}</span></h3>
                </div>

                <div className="feedPost__content">
                    <p>{props.content}<br/>
                    https://www.youtube.com/watch?v=J4JAKCtQo6c</p>
                    <img src={props.img} />
                </div>
            </div>

        </div>
      
    );
}