import { IoVideocam } from "react-icons/io5";
import { BsImages } from "react-icons/bs";
import { CgSmileMouthOpen } from "react-icons/cg";
import profile from './resources/profile.png';

export default function(){
    return (
        <div className="feed">
        <div className="feedForm">
            <img src={profile} />
            <input type="text" placeholder="What is on your mind?" />
        </div>
        <div className="feedIcons">
          <div className="iconSingle">
            <IoVideocam />
            <span>Live Video</span>
          </div>
          <div className="iconSingle img">
            <BsImages />
            <span>Photo/Video</span>
          </div>
          <div className="iconSingle emoji">
            <CgSmileMouthOpen />
            <span>Feeling/Activity</span>
          </div>
        </div>

        </div>
    );
}
